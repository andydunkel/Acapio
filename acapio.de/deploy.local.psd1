@{
    # KAS -> Tools -> SSH-Zugaenge
    HostName = 'w019af5f.kasserver.com'
    UserName = 'ssh-w019af5f'
    Port = 22

    # Bestehendes Zielverzeichnis der Domain. Das Skript legt es absichtlich
    # nicht selbst an, damit ein Tippfehler keine zweite Website erzeugt.
    TargetPath = '/www/htdocs/w019af5f/acapio.de'

    # Optional. Leer lassen, um den SSH-Agenten bzw. den Standardschluessel
    # unter %USERPROFILE%\.ssh zu verwenden.
    IdentityFile = '~/.ssh/id_ed25519'
}
