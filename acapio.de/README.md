# Acapio.de bauen

Voraussetzungen:

- Hugo Extended
- Node.js mit npm

Einmalig die Abhängigkeiten installieren:

```powershell
npm install
```

Produktions-Build inklusive Suchindex:

```powershell
npm run build
```

Der Befehl baut zuerst die Hugo-Seite und erzeugt anschließend mit Pagefind den
segmentierten Suchindex unter `public/pagefind/`. Zum lokalen Prüfen der fertig
gebauten Seite inklusive Suche:

```powershell
npm run preview
```

`hugo server` allein aktualisiert den Pagefind-Index nicht.

## Lokal auf ALL-INKL veroeffentlichen

Das lokale Deployment baut die Website, uebertraegt ein komprimiertes Archiv
per SSH und synchronisiert es auf dem Server mit `rsync`. Es wird weder GitHub
Actions noch zusaetzliche Windows-Software benoetigt.

Einmalig einrichten:

1. `deploy.example.psd1` nach `deploy.local.psd1` kopieren.
2. In `deploy.local.psd1` SSH-Host, SSH-Benutzer und das bestehende
   Domain-Zielverzeichnis aus dem ALL-INKL-KAS eintragen.
3. Optional unter `IdentityFile` den Pfad zu einem eigenen SSH-Schluessel
   eintragen. Ohne diese Angabe verwendet OpenSSH den Agenten bzw. seine
   Standardschluessel und fragt bei Bedarf nach dem Passwort.
4. Den ersten Abgleich als Testlauf starten:

```powershell
.\deploy.cmd -DryRun
```

Der Testlauf baut und uebertraegt die Seite, veraendert das Zielverzeichnis
aber nicht. Die angezeigten Aenderungen sorgfaeltig pruefen. Danach normal
veroeffentlichen:

```powershell
.\deploy.cmd
```

Vor der Synchronisierung zeigt das Skript Server und Zielverzeichnis an und
fragt nach einer Bestaetigung. Dateien, die nicht mehr im Build vorhanden sind,
werden auf dem Server entfernt. Der dynamische Zertifikatsordner
`.well-known/acme-challenge/` bleibt dabei unangetastet. Andere lokal unter
`static/.well-known/` verwaltete Dateien, beispielsweise `security.txt`, werden
normal in `public/.well-known/` gebaut und mit dem Webspace synchronisiert.
