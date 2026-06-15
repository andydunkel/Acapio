---
title: "Die magische .tpdf-Datei: Wenn die Stromrechnung plötzlich laufen lernt"
params:
  author: Andy
date: "2026-06-15"
featured: true
toc: true
tags:
  - "Virus"
  - "Malware"
  - "Phishing"
  - "Ekovoltis"
categories:
  - "Virus"
  - "Malware"
thumbnail: "virus.webp"
url: "posts/2026-06-15-tpdf"
summary: "Ein neues Meisterwerk der Phishing-Kunst: Wie aus einer angeblichen PDF-Rechnung von Ekovoltis dank der Endung .tpdf nahtlos ein Windows-Trojaner wird."
---

Man muss den kreativen Köpfen in den digitalen Schattenredaktionen dieser Welt einfach mal ein Kompliment aussprechen. Wer glaubt, dass Phishing-Mails im Jahr 2026 langweilig geworden sind, der wurde heute Morgen eines Besseren belehrt. Ein besonders schönes Prachtexemplar flatterte frisch in das Postfach – getarnt als wichtige Stromrechnung des polnischen Energieversorgers *Ekovoltis*. 

Schauen wir uns dieses Kunstwerk moderner Schadsoftware-Verteilung einmal genauer an.

![](/posts/2026-06-15-tpdf/mail_1.webp)

## Der Köder: Exklusivität wird hier großgeschrieben

Die E-Mail glänzt durch eine tadellose optische Aufmachung. Schickes Tabellendesign, offiziell wirkende Kontaktdaten im Footer und ein stolzer Rechnungsbetrag von **36.520,54 PLN**. Da rutscht dem Sachbearbeiter doch kurz das Herz in die Hose – perfekter psychologischer Druck.

Wer allerdings einen Blick hinter die schöne Fassade wirft, entdeckt schnell die handwerklichen Fehler:
* **Der Absender:** Die Adresse lautet `rozliczenia.ekovoltis.pl@balanceurbano.info`. Natürlich, welches polnische Energieunternehmen hostet seine Rechnungsstelle nicht auf einer komplett fremden Domain namens *balanceurbano.info*? 
* **Die Empfänger:** Gesendet wurde das Ganze an `undisclosed-recipients`. Ein Massenschreiben als persönliche Mahnung – persönlicher Kundenservice sieht anders aus.
* **Die Dateiendung:** Im Anhang befindet sich eine Datei namens `FVEE06244260006.tpdf`. Ein `.tpdf`? Ist das ein "Turbo-PDF"? Ein "Total-PDF"? Oder vielleicht doch eher ein handfester Betrugsversuch?

## Die Analyse: Ein Blick unter die Haube (mit VirusTotal)

Weil uns das ".tpdf" so gut gefiel, wanderte die Datei direkt auf die digitale Hebebühne von VirusTotal. Und siehe da: Die Sicherheits-Community ist begeistert (wenn auch bisher nur ein kleiner Teil).

![](/posts/2026-06-15-tpdf/mail_2.webp)

Mit einer Erkennungsrate von aktuell **6/59** ist der Schlingel noch ziemlich frisch gebacken und schlüpft an den meisten Standard-Filtern vorbei. Die technischen Tags verraten uns aber sofort, womit wir es wirklich zu tun haben: `tar` und `contains-pe`. 

Hinter der kreativen Endung `.tpdf` versteckt sich also kein Dokument, sondern ein TAR-Archiv, das eine ausführbare Windows-Datei (`PE` für *Portable Executable*) beinhaltet. Die Skan-Labels wie `trojan.nsisex` oder `Malware-Cryptor.NSISex.Heur` zeigen, dass die Angreifer den Code in ein NSIS-Installer-Skript (Nullsoft Scriptable Install System) verpackt haben. Das tarnt den Schadcode vor signaturbasierten Scannern. Sobald man die Datei ausführt, agiert sie als `Injector` und injiziert den eigentlichen Schadcode (oft Infostealer oder Banking-Trojaner) in legitime Windows-Prozesse.

## Die Demaskierung: Linux sei Dank

Um den letzten Schleier zu lüften, werfen wir einen Blick in das Archiv. Unter Linux lässt sich so etwas wunderbar gefahrlos erledigen, da Windows-Schadcode hier ohnehals nur müde lächeln kann.

![](/posts/2026-06-15-tpdf/mail_3.webp)

Sobald man das vermeintliche PDF mit dem Archivmanager öffnet, fällt die Maske endgültig: Vorschein kommt eine **771,7 kB** große Datei mit der unmissverständlichen Endung **`.exe`**. 

Wie praktisch! Die Rechnung ist gar kein dröges Dokument, sondern ein eigenständiges Programm. Vielleicht baut es nach dem Doppelklick die Solaranlage virtuell im System auf? Spoiler: Wohl eher nicht. Es räumt eher die Zugangsdaten ab.

## Was lernen wir daraus?

1. **Dateiendungen genau prüfen:** Wenn eine Datei `.tpdf`, `.pdf.exe` oder anders merkwürdig heißt -> Finger weg. Angreifer nutzen diese Tricks permanent, um Mail-Filter zu überlisten.
2. **Die Absender-Domain ist entscheidend:** Der Anzeigename im Mail-Programm kann gefälscht werden, aber die echte Absender-Domain (alles nach dem `@`) entlarvt den Betrug fast immer.
3. **Sicher analysieren:** Verdächtige Anhänge niemals auf dem Produktivsystem (und schon gar nicht unter Windows per Doppelklick) öffnen. Tools wie VirusTotal oder eine isolierte Linux-Umgebung sind die Lebensversicherung für Ihre Daten.