---
title: "Finanzamt Offizielle Mitteilung: Umsatzsteuer 2024"
params:
  author: Andy
date: "2026-03-10"
featured: true
toc: true
tags:
  -  "Scam"
  -  "Malware"
  -  "Virus"
categories:
  - "Scam"
  - "Malware"
thumbnail: "finanzamt.webp"
url: "posts/2026-03-10-finanzamt"
summary: "**Mahnung wegen rückständiger Steuern**: Eine E-Mail mit dem Betreff „Finanzamt Offizielle Mitteilung: Umsatzsteuer 2024“ sorgt aktuell für Verunsicherung. In der Nachricht wird eine angeblich überfällige Steuerzahlung angemahnt und ein Download-Link zu den „Unterlagen“ bereitgestellt. ⚠️📧"
---

Eine E-Mail mit dem Betreff **„Finanzamt Offizielle Mitteilung: Umsatzsteuer 2024“** sorgt aktuell für Verunsicherung. In der Nachricht wird eine angeblich überfällige Steuerzahlung angemahnt und ein Download-Link zu den „Unterlagen“ bereitgestellt. Tatsächlich handelt es sich jedoch um einen klassischen Phishing-Versuch, der darauf abzielt, Empfänger zum Öffnen einer schädlichen Datei zu verleiten. Wir zeigen, woran man die Betrugs-Mail erkennt. ⚠️📧

## Die E-Mail vom "Finanzamt"

> Mahnung wegen rückständiger Steuern  
>   
> Sehr geehrte Damen und Herren,  
>   
> Wir möchten Sie daran erinnern, dass Ihre Steuerzahlung überfällig ist. Bitte begleichen Sie den ausstehenden Betrag umgehend, um zusätzliche Gebühren zu vermeiden.  
> Für weitere Informationen und zur Einsichtnahme Ihrer Steuerunterlagen können Sie die Datei hier herunterladen

![Die E-Mail vom vermeintlichen Finanzamt](/posts/2026-03-10-finanzamt/mail.webp)

Auf den ersten Blick wirkt die Nachricht wie eine klassische Mahnung: kurzer Text, ein wenig Druck („überfällige Steuerzahlung“) und ein praktischer Download-Link zu den angeblichen Unterlagen. Genau so sollen Empfänger dazu gebracht werden, möglichst schnell zu klicken, bevor sie genauer nachdenken.

Schaut man sich die Mail jedoch etwas genauer an, fallen sofort mehrere Ungereimtheiten auf. Das angebliche Finanzamt spricht den Empfänger lediglich mit **„Sehr geehrte Damen und Herren“** an, ohne Namen, ohne Steuernummer, ohne Aktenzeichen. Auch der angeblich offene Betrag wird nicht genannt. Für eine echte Mahnung einer Behörde wäre das äußerst ungewöhnlich.

## Der „Download“ entpuppt sich als JavaScript-Datei

Wer in der Mail auf **„Datei herunterladen“** klickt, bekommt keinen Steuerbescheid, keine PDF und auch kein Formular vom Finanzamt. Stattdessen landet eine **`.js`-Datei** auf dem Rechner. Das ist kein Dokument, sondern ein **ausführbares Skript** für den Windows Script Host.

Ein Blick in den Code zeigt sofort, dass hier niemand versucht hat, etwas Lesbares zu schreiben. Der Inhalt besteht aus wirren Funktionsnamen, langen Zahlen- und Zeichenketten sowie mehreren Routinen zur **Entschlüsselung von Strings zur Laufzeit**. Solche Techniken werden häufig verwendet, um den eigentlichen Zweck der Datei zu verschleiern und automatische Sicherheitsprüfungen zu umgehen.

![Download des Schadcodes](/posts/2026-03-10-finanzamt/js.webp)

Besonders auffällig sind Funktionen wie **`GetObject()`** sowie mehrere **Create-Aufrufe**, mit denen unter Windows COM-Objekte erstellt werden können. In legitimen Web-JavaScripts tauchen solche Konstrukte praktisch nie auf, sie sind typisch für **Schadskripte**, die auf dem System weitere Aktionen ausführen sollen.

Kurz gesagt:
Der angebliche „Steuerbescheid“ ist in Wahrheit ein **stark verschleierter Script-Loader**, der nach dem Öffnen Code auf dem Rechner ausführen kann. Wer die Datei doppelklickt, startet nicht etwa ein Dokument, sondern ein Programm.

Der beste Umgang damit ist simpel: **nicht öffnen, löschen und abhaken**. Ein echtes Finanzamt verschickt seine Post weiterhin ganz altmodisch, per **ELSTER oder Brief**, nicht als mysteriöse JavaScript-Datei im Mailanhang. 📬💀

Immerhin erkennt der Windows-Defender den Kram und warnt.

![Windows Defender schlägt Alarm](/posts/2026-03-10-finanzamt/js1.webp)

## Fazit

Die „Offizielle Mitteilung zur Umsatzsteuer 2024“ ist natürlich keine Mitteilung vom Finanzamt, sondern ein ziemlich plumper Phishing-Versuch. Statt eines Steuerbescheids bekommt man beim Klick auf den Download-Link eine **JavaScript-Datei**, also ein ausführbares Skript für Windows.

Mit anderen Worten: Kein Dokument, kein Formular, sondern **Schadcode mit Tarnmantel**.

Immerhin zeigt der **Windows Defender** hier sofort die rote Karte und erkennt die Datei als Malware. Verlassen sollte man sich darauf trotzdem nicht, morgen kommt die gleiche Mail einfach mit leicht verändertem Code wieder.

Die einfache Faustregel:
**Wenn das „Finanzamt“ plötzlich JavaScript zum Download anbietet, ist es garantiert nicht das Finanzamt.** 💀📧


