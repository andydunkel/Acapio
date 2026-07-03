---
title: "Phishing-Warnung: Gefälschte Twilio SendGrid „JSON Payload Error“ E-Mails"
params:
  author: Andy
date: "2026-07-03"
featured: true
toc: true
tags:
  - "Phishing"
categories:
  - "Phishing"
thumbnail: "phishing.webp"
url: "posts/2026-07-03-twilio-sendgrid-phishing"
summary: "Vorsicht vor gefälschten Fehlermeldungen: Eine aktuelle Phishing-Mail im Namen von Twilio SendGrid versucht mit angeblichen „JSON Payload Errors“ Entwickler-Logins abzugreifen."
---

Aktuell ist eine Phishing-Welle im Umlauf, die sich gezielt an Entwickler und Administratoren richtet, die den E-Mail-Dienst **Twilio SendGrid** nutzen. Mit einer gefälschten Systemmeldung wird versucht, Panik zu schüren und sensible Zugangsdaten abzugreifen.

## Die Masche: Der angebliche API-Fehler

Die Phishing-E-Mail kommt mit einem technischen Vorwand daher:
* **Betreff:** `JSON Payload Error Pausing Email Delivery`
* **Inhalt:** Es wird behauptet, dass ausgehende E-Mails aufgrund eines fehlerhaften JSON-Payloads gestoppt wurden (`400 Bad Request - Malformed JSON` am Endpoint `/send/message`).
* **Call-to-Action:** Ein auffälliger Button mit der Aufschrift **„View Error Logs“** soll den Nutzer dazu verleiten, den Fehler schnellstmöglich zu überprüfen.

![Die Phishing Mail](/posts/2026-07-03-twilio-sendgrid-phishing/mail.webp)

## Die gefälschte Login-Seite

Wer auf den Button klickt, landet auf einer täuschend echt nachgebauten Login-Maske im SendGrid-Design. Schaut man jedoch genauer hin, erkennt man den Betrug sofort in der Adresszeile des Browsers:
* **Gefälschte URL:** `login.sendgrid.co/en/login.php` (Die Betrüger nutzen hier die Top-Level-Domain `.co` statt `.com`).
* **Echte URL:** Der legitime Login von SendGrid läuft standardmäßig über `app.sendgrid.com`.

![Die Login-Seite](/posts/2026-07-03-twilio-sendgrid-phishing/webseite.webp)

## Was passiert, wenn man sich dort einloggt?

Gibt man seine Zugangsdaten auf dieser präparierten Seite ein, passiert Folgendes:
1. **Credential Harvesting:** Die Login-Daten (Benutzername und Passwort) werden direkt an die Server der Angreifer übermittelt.
2. **Konto-Übernahme (Account Takeover):** Die Kriminellen kapern den SendGrid-Account.
3. **Missbrauch als Spam-Schleuder:** Da es sich um einen professionellen Mail-Dienst handelt, nutzen Angreifer diese verifizierten Konten sofort aus, um massenhaft eigenen Spam, Malware oder weitere Phishing-Mails zu versenden.
4. **Folgeschäden:** Die eigene Domain-Reputation bricht ein (Blacklisting), legitime Kunden-Mails kommen nicht mehr an, und es können unerwartet hohe Nutzungskosten durch das verbrauchte E-Mail-Kontingent entstehen.

### Worauf sollte man achten?

* **Absenderadresse prüfen:** Im vorliegenden Fall stammt die E-Mail von einer völlig unbeteiligten Adresse (`messaging-service@sisterhoodwomentravel.com.au`). Twilio verschickt Systembenachrichtigungen niemals über fremde Reise-Websites.
* **URL-Check vor dem Login:** Vor der Eingabe von Passwörtern immer die Domain in der Adresszeile prüfen.
* **2FA aktivieren:** Eine aktivierte Zwei-Faktor-Authentifizierung (2FA) verhindert in den meisten Fällen die Übernahme des Kontos, selbst wenn das Passwort in die falschen Hände geraten ist.