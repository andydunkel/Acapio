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
