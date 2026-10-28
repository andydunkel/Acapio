[CmdletBinding()]
param(
    [switch]$DryRun,
    [switch]$Yes
)

Set-StrictMode -Version Latest
$ErrorActionPreference = 'Stop'

trap {
    Write-Host ''
    Write-Host ("FEHLER: {0}" -f $_.Exception.Message) -ForegroundColor Red
    exit 1
}

$projectDirectory = $PSScriptRoot
$configurationPath = Join-Path $projectDirectory 'deploy.local.psd1'
$publicDirectory = Join-Path $projectDirectory 'public'

function Get-RequiredSetting {
    param(
        [hashtable]$Settings,
        [string]$Name
    )

    if (-not $Settings.ContainsKey($Name) -or [string]::IsNullOrWhiteSpace([string]$Settings[$Name])) {
        throw "Die Einstellung '$Name' fehlt in deploy.local.psd1."
    }

    return [string]$Settings[$Name]
}

function Invoke-NativeCommand {
    param(
        [string]$Executable,
        [string[]]$Arguments,
        [string]$FailureMessage
    )

    & $Executable @Arguments
    if ($LASTEXITCODE -ne 0) {
        throw "$FailureMessage (Exitcode $LASTEXITCODE)"
    }
}

if (-not (Test-Path -LiteralPath $configurationPath -PathType Leaf)) {
    throw @"
Die lokale Konfiguration fehlt.

1. deploy.example.psd1 als deploy.local.psd1 kopieren
2. HostName, UserName und TargetPath eintragen
3. deploy.cmd -DryRun ausfuehren
"@
}

$settings = Import-PowerShellDataFile -LiteralPath $configurationPath
$hostName = Get-RequiredSetting -Settings $settings -Name 'HostName'
$userName = Get-RequiredSetting -Settings $settings -Name 'UserName'
$targetPath = (Get-RequiredSetting -Settings $settings -Name 'TargetPath').TrimEnd('/')
$port = 22
if ($settings.ContainsKey('Port')) {
    $port = [int]$settings.Port
}

if ($hostName -notmatch '^[A-Za-z0-9.-]+$') {
    throw 'HostName enthaelt ungueltige Zeichen.'
}
if ($userName -notmatch '^[A-Za-z0-9._-]+$') {
    throw 'UserName enthaelt ungueltige Zeichen.'
}
if ($targetPath -notmatch '^/[A-Za-z0-9._/-]+$' -or $targetPath -match '(^|/)\.\.(/|$)') {
    throw 'TargetPath muss ein absoluter Pfad ohne Leerzeichen oder ".." sein.'
}
if ($port -lt 1 -or $port -gt 65535) {
    throw 'Port muss zwischen 1 und 65535 liegen.'
}

$identityFile = ''
if ($settings.ContainsKey('IdentityFile')) {
    $identityFile = [string]$settings.IdentityFile
}
if (-not [string]::IsNullOrWhiteSpace($identityFile)) {
    $identityFile = (Resolve-Path -LiteralPath $identityFile).Path
}

$npm = Get-Command 'npm.cmd' -ErrorAction SilentlyContinue
$tar = Get-Command 'tar.exe' -ErrorAction SilentlyContinue
$ssh = Get-Command 'ssh.exe' -ErrorAction SilentlyContinue
$scp = Get-Command 'scp.exe' -ErrorAction SilentlyContinue

foreach ($tool in @{
        'npm.cmd' = $npm
        'tar.exe' = $tar
        'ssh.exe' = $ssh
        'scp.exe' = $scp
    }.GetEnumerator()) {
    if ($null -eq $tool.Value) {
        throw "Das benoetigte Programm '$($tool.Key)' wurde nicht gefunden."
    }
}

$identityArguments = @()
if (-not [string]::IsNullOrWhiteSpace($identityFile)) {
    $identityArguments = @('-i', $identityFile)
}

$sshArguments = @('-p', [string]$port, '-o', 'ServerAliveInterval=15', '-o', 'ServerAliveCountMax=3') + $identityArguments
$scpArguments = @('-P', [string]$port, '-o', 'ServerAliveInterval=15', '-o', 'ServerAliveCountMax=3') + $identityArguments
$remote = '{0}@{1}' -f $userName, $hostName

Write-Host ''
Write-Host 'Acapio lokal veroeffentlichen' -ForegroundColor Cyan
Write-Host "  Server: $remote`:$port"
Write-Host "  Ziel:   $targetPath"
if ($DryRun) {
    Write-Host '  Modus:  Testlauf; auf dem Webspace wird nichts geaendert.' -ForegroundColor Yellow
}

if (-not $DryRun -and -not $Yes) {
    $answer = Read-Host 'Build erstellen und auf diesem Ziel veroeffentlichen? [j/N]'
    if ($answer -notmatch '^(j|ja|y|yes)$') {
        Write-Host 'Abgebrochen.'
        exit 0
    }
}

Write-Host ''
Write-Host '1/3 Produktions-Build mit Hugo und Pagefind ...' -ForegroundColor Cyan
Push-Location $projectDirectory
try {
    & $npm.Source 'run' 'build'
    $buildExitCode = $LASTEXITCODE
}
finally {
    Pop-Location
}
if ($buildExitCode -ne 0) {
    throw "Der Produktions-Build ist fehlgeschlagen (Exitcode $buildExitCode). Es wurde nichts hochgeladen."
}
if (-not (Test-Path -LiteralPath (Join-Path $publicDirectory 'index.html') -PathType Leaf)) {
    throw 'public/index.html fehlt nach dem Build. Es wurde nichts hochgeladen.'
}

$deploymentId = [Guid]::NewGuid().ToString('N')
$localArchive = Join-Path ([IO.Path]::GetTempPath()) "acapio-$deploymentId.tar.gz"
$remoteArchive = ".acapio-$deploymentId.tar.gz"
$remoteStage = ".acapio-$deploymentId"

try {
    Write-Host ''
    Write-Host '2/3 Build komprimieren und per SSH uebertragen ...' -ForegroundColor Cyan
    Invoke-NativeCommand -Executable $tar.Source -Arguments @('-czf', $localArchive, '-C', $publicDirectory, '.') -FailureMessage 'Das Build-Archiv konnte nicht erstellt werden.'
    $destination = '{0}:{1}' -f $remote, $remoteArchive
    Invoke-NativeCommand -Executable $scp.Source -Arguments ($scpArguments + @($localArchive, $destination)) -FailureMessage 'Das Build-Archiv konnte nicht hochgeladen werden.'

    $rsyncOptions = '-rlt --chmod=D755,F644 --delete-after --exclude=/.well-known/acme-challenge/ --itemize-changes'
    if ($DryRun) {
        $rsyncOptions += ' --dry-run'
    }

    # Alle eingesetzten Pfade wurden oben auf einen engen Zeichensatz begrenzt
    # oder werden aus einer zufaelligen hexadezimalen ID erzeugt.
    $remoteCommands = @(
        'set -eu'
        "archive='$remoteArchive'"
        "stage='$remoteStage'"
        "target='$targetPath'"
        'cleanup() { rm -rf -- "$stage" "$archive"; }'
        'trap cleanup EXIT HUP INT TERM'
        'command -v rsync >/dev/null 2>&1 || { echo "rsync ist auf dem Server nicht verfuegbar." >&2; exit 21; }'
        'test -d "$target" || { echo "Das Zielverzeichnis existiert nicht: $target" >&2; exit 22; }'
        'mkdir -- "$stage"'
        'tar -xzf "$archive" -C "$stage"'
        'chmod -R u=rwX,go=rX "$stage"'
        ('rsync {0} "$stage/" "$target/"' -f $rsyncOptions)
    )
    $remoteCommand = $remoteCommands -join '; '

    Write-Host ''
    Write-Host '3/3 Webspace mit dem Build synchronisieren ...' -ForegroundColor Cyan
    Invoke-NativeCommand -Executable $ssh.Source -Arguments ($sshArguments + @($remote, $remoteCommand)) -FailureMessage 'Die Synchronisierung auf dem Webspace ist fehlgeschlagen.'
}
finally {
    if (Test-Path -LiteralPath $localArchive) {
        Remove-Item -LiteralPath $localArchive -Force
    }
}

Write-Host ''
if ($DryRun) {
    Write-Host 'Testlauf abgeschlossen. Oben stehen die geplanten Aenderungen.' -ForegroundColor Green
    Write-Host 'Zum Veroeffentlichen anschliessend deploy.cmd starten.'
}
else {
    Write-Host 'Acapio wurde erfolgreich veroeffentlicht.' -ForegroundColor Green
}
