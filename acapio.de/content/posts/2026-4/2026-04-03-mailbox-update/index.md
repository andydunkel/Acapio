---
title: "Phishing-Analyse: Wie Scammer Telegram-Bots zur Daten-Exfiltration nutzen"
params:
  author: Andy
date: "2026-04-03"
featured: true
toc: true
tags:
  -  "Phishing"
categories:
  - "Phishing"
  - "Security"
  - "Investigativ"
thumbnail: "phishing.webp"
url: "posts/2026-04-03-mailbox-update"
summary: "**Ein Klick, ein API-Call – und das Passwort ist weg**. Wir haben eine aktuelle Phishing-Welle seziert und zeigen, wie Angreifer Telegram-Bots als effiziente Relaisstation für gestohlene E-Mail-Daten nutzen."
---

**Ein Klick, ein API-Call – und das Passwort ist weg**. Wir haben eine aktuelle Phishing-Welle seziert und zeigen, wie Angreifer Telegram-Bots als effiziente Relaisstation für gestohlene E-Mail-Daten nutzen.
## Die Phishing-E-Mail: Der Köder

Die Nachricht tarnt sich als dringendes System-Update („Mandatory Update“). Das Ziel: Den Nutzer zur Bestätigung seines Kontostatus zu bewegen.

**Die Red Flags auf einen Blick:**
* **Absender-Mismatch:** Hinter dem Namen „IT Support“ verbirgt sich eine völlig fachfremde Absender-Domain (`robessportswear.shop`).
* **Automatisierte Personalisierung:** Die E-Mail-Adresse des Opfers wird direkt im Betreff und Text eingebunden, um Seriosität vorzutäuschen.
* **Psychologischer Druck:** Begriffe wie „Mandatory“ und „Confirm Account“ sollen eine schnelle, unüberlegte Reaktion provozieren.

> Mailbox Mandatory Update  
>   
> Hi andy.dunkel,  
>   
> Please update your mailbox information below to confirm the account's active status.  
>   
> Confirm Account  
>   
> ekiwi.de Administrator  

![Klingt wichtig, die Mail mit dem Link](/posts/2026-04-03-mailbox-update/mail_1.webp)

Sobald der Nutzer auf „Confirm Account“ klickt, beginnt der technische Teil des Scams. Er landet nicht bei seinem E-Mail-Provider, sondern auf einer präparierten Seite. 

## Die Ziel-URL: Tarnung im Cloud-Speicher

Nach dem Klick auf den Link landet das Opfer auf einer präparierten Webseite. Ein Blick auf die URL verrät viel über die Strategie der Angreifer:

* **Hosting auf S3-Storage:** Die Nutzung von `contabostorage.com` (S3-kompatibler Cloud-Speicher) ist ein gezielter Schachzug. Da Cloud-Speicher-Domains von großen Anbietern oft als vertrauenswürdig eingestuft werden, umgehen diese Links häufig einfache Reputationsfilter und Firewalls.
* **Verschleierte Pfade:** Die extrem lange, kryptische Zeichenfolge im Pfad dient dazu, die Seite vor automatisierten Scannern zu verbergen und eine eindeutige Zuordnung zu einer Kampagne zu ermöglichen.
* **Der „Anker“-Trick zur Personalisierung:** Am Ende der URL steht ein Fragment (`#jan.pillmann@otze.de`). Ein Skript auf der Phishing-Seite liest diesen Teil aus und trägt die E-Mail-Adresse automatisch in das Anmeldefeld ein. Das erhöht die Glaubwürdigkeit massiv, da der Nutzer direkt namentlich (bzw. per Mailadresse) „begrüßt“ wird.

![Die URL, auf irgendeinem Cloud-Speicher](/posts/2026-04-03-mailbox-update/mail_2.webp)


## Das Formular: Minimalismus als Falle

Die eigentliche Landingpage ist auffallend schlicht gehalten – und genau das macht sie gefährlich. Statt aufwendiger Grafiken setzt der Angreifer auf ein generisches Webmail-Design, das Professionalität suggeriert.

**Auffällige Details des Formulars:**

* **Vorausgefüllte Felder:** Dank des URL-Ankers ist der Nutzername bereits eingetragen. Das reduziert die Hürde für das Opfer: Man muss „nur noch kurz“ das Passwort eingeben.
* **Generisches Branding:** Das Logo und der Schriftzug „Welcome to Webmail“ sind so neutral gehalten, dass sie für fast jeden E-Mail-Dienst glaubwürdig erscheinen.
* **Die bizarre Hintergrund-Tarnung:** Besonders perfide ist der Hintergrund der Seite. Er zeigt eine gefälschte Firefox-Fehlermeldung („Firefox Can’t Open This Page“). Dies soll den Nutzer verwirren oder den Eindruck erwecken, dass das Login-Fenster eine notwendige „Sicherheits-Alternative“ aufgrund eines technischen Problems sei.

![Das Phishing-Formular](/posts/2026-04-03-mailbox-update/mail_3.webp)

Sobald der Nutzer hier auf **„CONTINUE“** klickt, verlassen wir die optische Täuschung und tauchen tief in den technischen Datenabfluss ein.


## Hinter den Kulissen: Die technische Exfiltration via Telegram

Sobald der Nutzer im Formular auf „CONTINUE“ klickt, geschieht im Hintergrund etwas, das für den normalen Anwender unsichtbar bleibt. Ein Blick in die Netzwerkanalyse der Browsertools entlarvt den Prozess als hocheffiziente Daten-Exfiltration.

![Die übertragenen Daten](/posts/2026-04-03-mailbox-update/mail_4.webp)

### Schritt 1: Das Profiling (ipapi.co)

Bevor die Daten an den Angreifer gesendet werden, kontaktiert das Phishing-Skript den Dienst `ipapi.co`. Hierbei werden Informationen über den Standort, den Internetanbieter (ISP) und die exakten Koordinaten des Opfers abgefragt. Diese Metadaten sind für Scammer wertvoll, um spätere Login-Versuche so zu tarnen, dass sie Sicherheitssysteme (z. B. „Login aus einer fremden Stadt“) nicht sofort alarmieren.

### Schritt 2: Der Datenabfluss (Telegram API)

Der entscheidende Moment ist ein `POST`-Request an `api.telegram.org`. Moderne Phishing-Kits nutzen die Telegram Bot API als „Backend-Ersatz“. Das hat für den Angreifer zwei große Vorteile:

1. **Kein eigener Server nötig:** Er muss keine Datenbank verwalten, die entdeckt oder gehackt werden könnte.
2. **Echtzeit-Push:** Der Scammer erhält die gestohlenen Daten sofort als Push-Nachricht auf sein Smartphone.

### Schritt 3: Analyse des Payloads

Der im Screenshot sichtbare JSON-Payload zeigt die Detailtiefe des Angriffs. Der Bot sendet nicht nur die E-Mail und das Passwort, sondern ein komplettes Log-Paket:

* **Chat ID (`8279351688`):** Der digitale Briefkasten des Angreifers.
* **Credentials:** E-Mail-Adresse und Passwort im Klartext.
* **Fingerprinting:** IP-Adresse, ISP (hier Vodafone GmbH), der verwendete Browser (User Agent) und der genaue Zeitstempel.

Durch die Verwendung der `parse_mode: "HTML"`-Option wird das Log im Telegram-Chat des Scammers sogar formatiert mit Emojis angezeigt, was die „Arbeit“ für den Kriminellen noch komfortabler macht.

---

## OpSec-Fail: Der Angreifer enttarnt sich selbst

Der wohl größte Fehler der Scammer liegt in der Implementierung des Phishing-Kits: Da die Daten direkt vom Browser des Opfers an Telegram gesendet werden, ist der **Bot-Token** im Quellcode der Seite (JavaScript) für jeden sichtbar hinterlegt. Dieser Token fungiert wie ein Generalschlüssel.

![Die Daten des Empfängers](/posts/2026-04-03-mailbox-update/mail_5.webp)

### Wer ist der Empfänger?

Mit dem extrahierten Token lässt sich die Telegram-API nutzen, um Details über den Empfänger der Beutedaten abzufragen. In unserem Fall liefert die API ein klares Bild des Hintermanns:

* **Pseudonym:** Der Angreifer nennt sich selbst **„Zeus🏦 Zeus💼“**.
* **Symbolik:** Die Wahl des Namens „Zeus“ (in Anlehnung an das berüchtigte Banking-Botnetz) kombiniert mit Emojis für Bankgebäude und Aktentaschen unterstreicht die kriminelle Motivation.
* **Account-Details:** Es handelt sich um ein privates Profil mit der ID `8279351688`. 

Dieser „Operational Security Fail“ (OpSec-Fail) macht die Operation angreifbar. Anstatt anonym im Hintergrund zu bleiben, liefert der Scammer seine Identität und seinen „Briefkasten“ direkt mit dem Phishing-Kit aus. Dies ermöglicht eine präzise Meldung und Abschaltung der gesamten Infrastruktur.

---

## Den Spieß umdrehen: Der Bot als Bumerang

Der im Quellcode hinterlegte Bot-Token ist für den Angreifer ein technischer Totalschaden. Da die API keine Authentifizierung des Absenders prüft, konnten wir den Spieß umdrehen und direkt in den privaten Kanal des Scammers eingreifen.

![Wir senden dem Scammer hunderte Nachrichten](/posts/2026-04-03-mailbox-update/mail_6.webp)

**Die Aktion:**
Mittels eines einfachen API-Aufrufs haben wir dem „Chef-Scammer“ eine Nachricht direkt auf sein Endgerät geschickt: **„YOU_HAVE_BEEN_...“**.

Eine? Wir haben ihn ordentlich zugespammt. Gleichzeitig ging eine [Abuse-Meldung](/posts/2025-02-17_scam-webseiten-sperren-lassen/?query=melden) an Telegram und den Cloud-Hoster raus.

---

## Fazit

Ein herzliches Dankeschön an „**Zeus**“ für diesen Crashkurs in angewandter Inkompetenz. Wer seine Beute-Pipeline so diskret absichert wie ein blinkendes Neonschild in einer dunklen Gasse, hat den Titel „Cyber-Mastermind“ redlich verdient. Den API-Token direkt in das Frontend-Script zu klatschen, ist in etwa so clever, wie den Haustürschlüssel unter die Fußmatte zu legen – und dann ein Schild mit der Aufschrift „Schlüssel hier!“ daneben zu stellen. 

Dass wir dem „Gott des Olymps“ über seinen eigenen Bot noch ein freundliches „YOU_HAVE_BEEN_...“ direkt ins private Wohnzimmer schicken konnten, war das digitale Sahnehäubchen auf diesem eher traurigen Scam-Versuch. 

**Fazit:** Phishing bleibt eine ernsthafte Gefahr, aber solange die Angreifer ihre eigenen Werkzeuge so sicher beherrschen wie ein betrunkener Seiltänzer, bleibt uns wenigstens der Humor. 

