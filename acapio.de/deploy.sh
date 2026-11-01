#!/usr/bin/env bash

set -Eeuo pipefail

script_dir=$(cd -- "$(dirname -- "${BASH_SOURCE[0]}")" && pwd)
configuration_path="$script_dir/deploy.local.psd1"
public_directory="$script_dir/public"
dry_run=false
assume_yes=false
local_archive=''

fail() {
    printf '\nFEHLER: %s\n' "$*" >&2
    exit 1
}

cleanup() {
    if [[ -n "$local_archive" && -f "$local_archive" ]]; then
        rm -f -- "$local_archive"
    fi
}

trap cleanup EXIT

for argument in "$@"; do
    case "$argument" in
        -DryRun|--dry-run)
            dry_run=true
            ;;
        -Yes|--yes|-y)
            assume_yes=true
            ;;
        -h|--help)
            printf 'Verwendung: %s [-DryRun|--dry-run] [-Yes|--yes]\n' "$0"
            exit 0
            ;;
        *)
            fail "Unbekanntes Argument: $argument"
            ;;
    esac
done

[[ -f "$configuration_path" ]] || fail "Die lokale Konfiguration deploy.local.psd1 fehlt."

read_string_setting() {
    local name=$1
    local value

    value=$(sed -nE "s/^[[:space:]]*${name}[[:space:]]*=[[:space:]]*'([^']*)'[[:space:]]*(#.*)?$/\\1/p" "$configuration_path")
    [[ -n "$value" ]] || fail "Die Einstellung '$name' fehlt in deploy.local.psd1."
    printf '%s' "$value"
}

read_optional_string_setting() {
    local name=$1
    sed -nE "s/^[[:space:]]*${name}[[:space:]]*=[[:space:]]*'([^']*)'[[:space:]]*(#.*)?$/\\1/p" "$configuration_path"
}

host_name=$(read_string_setting HostName)
user_name=$(read_string_setting UserName)
target_path=$(read_string_setting TargetPath)
target_path=${target_path%/}
identity_file=$(read_optional_string_setting IdentityFile)
port=$(sed -nE 's/^[[:space:]]*Port[[:space:]]*=[[:space:]]*([0-9]+)[[:space:]]*(#.*)?$/\1/p' "$configuration_path")
port=${port:-22}

[[ "$host_name" =~ ^[A-Za-z0-9.-]+$ ]] || fail 'HostName enthaelt ungueltige Zeichen.'
[[ "$user_name" =~ ^[A-Za-z0-9._-]+$ ]] || fail 'UserName enthaelt ungueltige Zeichen.'
[[ "$target_path" =~ ^/[A-Za-z0-9._/-]+$ && ! "$target_path" =~ (^|/)\.\.(/|$) ]] || \
    fail 'TargetPath muss ein absoluter Pfad ohne Leerzeichen oder ".." sein.'
[[ "$port" =~ ^[0-9]+$ && "$port" -ge 1 && "$port" -le 65535 ]] || \
    fail 'Port muss zwischen 1 und 65535 liegen.'

if [[ "${identity_file:0:2}" == \~/ ]]; then
    identity_file="$HOME/${identity_file#\~/}"
fi
if [[ -n "$identity_file" ]]; then
    [[ -f "$identity_file" ]] || fail "Der SSH-Schluessel wurde nicht gefunden: $identity_file"
    identity_file=$(realpath -- "$identity_file")
fi

for tool in npm tar ssh scp realpath; do
    command -v "$tool" >/dev/null 2>&1 || fail "Das benoetigte Programm '$tool' wurde nicht gefunden."
done

identity_arguments=()
if [[ -n "$identity_file" ]]; then
    identity_arguments=(-i "$identity_file")
fi

ssh_arguments=(-p "$port" -o ServerAliveInterval=15 -o ServerAliveCountMax=3 "${identity_arguments[@]}")
scp_arguments=(-P "$port" -o ServerAliveInterval=15 -o ServerAliveCountMax=3 "${identity_arguments[@]}")
remote="$user_name@$host_name"

printf '\nAcapio lokal veroeffentlichen\n'
printf '  Server: %s:%s\n' "$remote" "$port"
printf '  Ziel:   %s\n' "$target_path"
if $dry_run; then
    printf '  Modus:  Testlauf; auf dem Webspace wird nichts geaendert.\n'
fi

if ! $dry_run && ! $assume_yes; then
    read -r -p 'Build erstellen und auf diesem Ziel veroeffentlichen? [j/N] ' answer
    if [[ ! "$answer" =~ ^(j|ja|y|yes)$ ]]; then
        printf 'Abgebrochen.\n'
        exit 0
    fi
fi

printf '\n1/3 Produktions-Build mit Hugo und Pagefind ...\n'
(
    cd -- "$script_dir"
    npm run build
) || fail 'Der Produktions-Build ist fehlgeschlagen. Es wurde nichts hochgeladen.'

[[ -f "$public_directory/index.html" ]] || \
    fail 'public/index.html fehlt nach dem Build. Es wurde nichts hochgeladen.'

local_archive=$(mktemp "${TMPDIR:-/tmp}/acapio-XXXXXXXXXX.tar.gz")
deployment_id=$(basename -- "$local_archive")
deployment_id=${deployment_id#acapio-}
deployment_id=${deployment_id%.tar.gz}
remote_archive=".acapio-$deployment_id.tar.gz"
remote_stage=".acapio-$deployment_id"

printf '\n2/3 Build komprimieren und per SSH uebertragen ...\n'
tar -czf "$local_archive" -C "$public_directory" . || fail 'Das Build-Archiv konnte nicht erstellt werden.'
scp "${scp_arguments[@]}" "$local_archive" "$remote:$remote_archive" || \
    fail 'Das Build-Archiv konnte nicht hochgeladen werden.'

rsync_options='-rlt --chmod=D755,F644 --delete-after --exclude=/.well-known/acme-challenge/ --itemize-changes'
if $dry_run; then
    rsync_options+=' --dry-run'
fi

# Die eingesetzten Remote-Pfade sind oben auf einen engen Zeichensatz begrenzt
# oder werden von mktemp erzeugt.
remote_command="set -eu; archive='$remote_archive'; stage='$remote_stage'; target='$target_path'; cleanup() { rm -rf -- \"\$stage\" \"\$archive\"; }; trap cleanup EXIT HUP INT TERM; command -v rsync >/dev/null 2>&1 || { echo 'rsync ist auf dem Server nicht verfuegbar.' >&2; exit 21; }; test -d \"\$target\" || { echo \"Das Zielverzeichnis existiert nicht: \$target\" >&2; exit 22; }; mkdir -- \"\$stage\"; tar -xzf \"\$archive\" -C \"\$stage\"; chmod -R u=rwX,go=rX \"\$stage\"; rsync $rsync_options \"\$stage/\" \"\$target/\""

printf '\n3/3 Webspace mit dem Build synchronisieren ...\n'
# Der lokal zusammengesetzte Befehl enthaelt ausschliesslich validierte Werte.
# shellcheck disable=SC2029
ssh "${ssh_arguments[@]}" "$remote" "$remote_command" || \
    fail 'Die Synchronisierung auf dem Webspace ist fehlgeschlagen.'

printf '\n'
if $dry_run; then
    printf 'Testlauf abgeschlossen. Oben stehen die geplanten Aenderungen.\n'
    printf 'Zum Veroeffentlichen anschliessend ./deploy.sh starten.\n'
else
    printf 'Acapio wurde erfolgreich veroeffentlicht.\n'
fi
