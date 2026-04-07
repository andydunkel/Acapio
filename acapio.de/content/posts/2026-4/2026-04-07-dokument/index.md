---
title: "Dokument wurde Ihnen zur Genehmigung zugewiesen - Phishing von E-Mail-Daten 🦠"
params:
  author: Andy
date: "2026-04-07"
featured: true
toc: true
tags:
  -  "Phishing"
categories:
  - "Phishing"
thumbnail: "hacker.webp"
url: "posts/2026-04-07-document"
summary: "Aktuell landet eine besonders tückische Phishing-Welle in den Postfächern. Die Angreifer tarnen sich als interner Dokumenten-Service und versuchen mit einer perfiden Masche, an die Zugangsdaten von E-Mail-Konten zu gelangen. Wir haben den Angriff analysiert."
---

Aktuell landet eine besonders tückische Phishing-Welle in den Postfächern. Die Angreifer tarnen sich als interner Dokumenten-Service und versuchen mit einer perfiden Masche, an die Zugangsdaten von E-Mail-Konten zu gelangen. Wir haben den Angriff analysiert.

## Die Masche: Druck durch Dringlichkeit

Alles beginnt mit einer E-Mail, die eine dringende „Unterzeichnung interner Dateien“ fordert. Um Vertrauen zu erwecken, wird die E-Mail-Adresse des Opfers direkt in den Text eingebaut und sogar der Firmenname (in diesem Fall „Ekiwi“) in Klammern gesetzt.

* **Betreff:** Ekiwi, Dokument wurde Ihnen zur Genehmigung zugewiesen `DOC_ID_HLIXIVJMLO3`
* **Der Köder:** Ein blauer Button mit der Aufschrift **„DOKUMENT ÜBERPRÜFEN“**.

![Die E-Mail](/posts/2026-04-07-document/dokument_1.webp)

## Die Landeseite: Perfekte Kopie auf Google-Infrastruktur

Klickt das Opfer auf den Link, landet es auf einer täuschend echt aussehenden Login-Seite. In diesem Fall wurde das Webmail-Interface von **ALL-INKL** fast eins zu eins kopiert.

![Das vermeintliche Login-Formular](/posts/2026-04-07-document/dokument_2.webp)

Dabei nutzen die Betrüger zwei psychologische und technische Tricks:
1.  **Personalisierung:** Die E-Mail-Adresse des Opfers wird per URL-Parameter übergeben und ist im Login-Feld bereits vorausgefüllt. Das vermindert Misstrauen.
2.  **Vertrauenswürdiges Hosting:** Die Seite wird auf `storage.googleapis.com` gehostet. Da dies eine offizielle Google-Domain ist, schlagen viele einfache Phishing-Filter keinen Alarm, und das grüne Schloss (SSL) im Browser suggeriert Sicherheit.

## Hinter den Kulissen: Datenabfluss via Telegram

Das Spannendste passiert im Hintergrund, sobald das Opfer sein Passwort eingibt. Ein Blick in die Netzwerk-Analyse des Browsers (Developer Tools) zeigt, dass die Daten nicht etwa an einen Webserver geschickt werden, sondern direkt an die **Telegram-API**.

![Der Datenabfluss, die Daten gehen via Telegram an die Scammer](/posts/2026-04-07-document/dokument_3.webp)

Die Angreifer nutzen einen **Telegram-Bot**, um die gestohlenen Daten in Echtzeit zu empfangen. Im Datensatz enthalten sind:

* Die E-Mail-Adresse und das **Passwort im Klartext**.
* Die IP-Adresse des Opfers.
* Zeitstempel und die URL, von der die Daten stammen.

Dadurch müssen die Täter keine eigene Datenbank betreiben, die leicht von Sicherheitsbehörden abgeschaltet werden könnte – sie lassen sich die Beute einfach „chatten“. Wir kennen die [Vorgehensweise bereits](/posts/2026-04-03-mailbox-update/).

## Woran erkennt man den Betrug?

1.  **Die URL prüfen:** Ein Dokumenten-Service oder Webmail-Provider wird niemals auf einer Google-Storage-URL (`storage.googleapis.com/...`) nach einem Passwort fragen.
2.  **Unlogischer Ablauf:** Warum sollte man sich bei seinem E-Mail-Provider anmelden müssen, um ein bereits (angeblich) intern zugewiesenes Dokument zu sehen?
3.  **Absender-Check:** Meist stammen diese E-Mails von kompromittierten Konten fremder Firmen, die nichts mit dem angeblichen Inhalt zu tun haben.

### Fazit
Geben Sie niemals Ihre Zugangsdaten auf Seiten ein, die Sie über einen Link in einer unangeforderten E-Mail erreicht haben. Sollten Sie bereits Daten eingegeben haben, **ändern Sie umgehend Ihr Passwort** und aktivieren Sie (wo immer möglich) die **Zwei-Faktor-Authentifizierung (2FA)**. Diese hätte den Angreifern hier trotz Passwort-Diebstahls den Zugriff verwehrt.

---

**Sicherheitshinweis:** Wir haben diesen Fall in einer geschützten Laborumgebung analysiert. Klicken Sie niemals leichtfertig auf Links in verdächtigen E-Mails!
