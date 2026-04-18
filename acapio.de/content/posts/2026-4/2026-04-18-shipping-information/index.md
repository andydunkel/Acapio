---
title: "Your Order #[ID-145128] has been Shipped! - Virus im Anflug"
params:
  author: Andy
date: "2026-04-18"
featured: true
toc: true
tags:
  -  "Virus"
  -  "Malware"
categories:
  - "Malware"
thumbnail: "virus.webp"
url: "posts/2026-04-18-shipping-information"
summary: "**Paket-Info oder Hacker-Termin?** Eine neue Calendly-Masche nutzt legitime Profi-Software, um Ihren PC heimlich komplett zu übernehmen. Wir zeigen Ihnen, wie dieser Angriff unter dem Radar der meisten Virenscanner schlüpft."
---

Aktuell macht eine besonders perfide Phishing-Welle die Runde. Sie nutzt das Vertrauen in bekannte Marken und legitime Software, um Ihren Rechner komplett unter fremde Kontrolle zu bringen. Wir haben den Angriff analysiert.

## Die Masche: Termin mit dem Trojaner

Alles beginnt mit einer täuschend echten E-Mail von **Calendly**. Der Betreff spricht von einem „Meeting“, doch im Text geht es plötzlich um eine Paketlieferung. Die Angreifer nutzen die Neugier: Wer wissen will, wo sein Paket bleibt, klickt auf den Link – und landet auf einer professionell gestalteten Download-Seite mit Countdown.

![Die E-Mail mit Link](/posts/2026-04-18-shipping-information/mail.webp)

## Die technische Falle: Legitim, aber tödlich

Anstatt einer Versandinformation lädt der Browser eine Datei namens **`ScreenConnect.ClientSetup.msi`** herunter. 

![](/posts/2026-04-18-shipping-information/download_2.webp)

Hier liegt der Clou:
* **Kein klassischer Virus:** Die Angreifer nutzen die Profi-Fernwartungssoftware der Firma **ConnectWise**. Da das Programm an sich legal ist, schlagen viele Virenscanner nicht an. Eine Analyse bei VirusTotal ergab: Nur **7 von 63 Scannern** erkannten die Gefahr sofort.

![](/posts/2026-04-18-shipping-information/download_2.webp)

* **Gefälschtes Vertrauen:** Beim Ausführen zeigt Windows einen „verifizierten Herausgeber“ an. Viele Nutzer wiegen sich dadurch in Sicherheit und bestätigen die Installation.

## Das Ziel: Voller Zugriff

Sobald die Installation abgeschlossen ist, wartet die Anwendung im Hintergrund. Ziel dürfte sein, dass sich irgendwann ein Supportmitarbeiter meldet, der Zugriff auf das System will.

![](/posts/2026-04-18-shipping-information/download_3.webp)


## Wie Sie sich schützen

1.  **Dateiendungen prüfen:** Eine Versandbestätigung ist niemals eine `.msi`- oder `.exe`-Datei. Erwarten Sie ein Dokument (PDF/JPG), installieren Sie niemals ein Programm.
2.  **UAC-Warnungen ernst nehmen:** Wenn Windows nach Administratorrechten fragt, obwohl Sie nur ein Dokument öffnen wollten: **Abbrechen!**
3.  Falls Sie doch etwas herunterladen, immer zuerst mit [VirusTotal prüfen](https://ekiwi-blog.de/22006/dateien-online-auf-viren-pruefen/).











