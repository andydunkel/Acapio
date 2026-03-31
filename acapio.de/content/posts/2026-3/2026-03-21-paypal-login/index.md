---
title: "‚Neue Anmeldung bei PayPal‘ - der Klassiker unter den Phishing-Mails"
params:
  author: Andy
date: "2026-03-21"
featured: true
toc: true
tags:
  -  "Phishing"
categories:
  - "Phishing"
thumbnail: "paypal.webp"
url: "posts/2026-03-21-paypal-login"
summary: "Ein angeblich neuer Login bei PayPal sorgt für Panik - doch die Mail selbst ist der eigentliche Betrug. Warum du hier besser nicht klickst. ⚠️"
---

Ein angeblich neuer Login bei PayPal sorgt für Panik - doch die Mail selbst ist der eigentliche Betrug. Warum du hier besser nicht klickst. ⚠️

## Die E-Mail

Auf den ersten Blick wirkt die Mail gar nicht mal so schlecht gemacht. Ein Login, ein Gerät, ein bisschen Technik-Blabla - passt schon. Genau das ist auch die Masche: Es soll möglichst glaubwürdig wirken, ohne dass man genauer hinschaut.

Der eigentliche Knackpunkt ist aber der Inhalt selbst.

Normalerweise läuft das bei PayPal (und anderen Diensten) nämlich anders:
Du bekommst eine Benachrichtigung über einen neuen Login - vielleicht mit Standort oder Gerät - aber **keine direkte Aufforderung, über einen Link irgendetwas zu „deaktivieren“**.

Und genau hier wird es verdächtig.

> Auf diesem vertrauenswürdigen Gerät eingeloggt bleiben
>
> Desktop Chrome Windows 10 10.0.0
> Wir haben eine neue Anmeldung auf Ihrem Konto von einem entfernten Computer aus bemerkt.
> Wenn dies ein gemeinsam genutztes Gerät ist oder du das Gerät Desktop Chrome Windows 10 10.0.0 nicht erkennst, kannst du den vertrauenswürdigen Status Hier Deaktivieren.

![](/posts/2026-03-21-paypal-login/paypal_1.webp)

Diese Mail will, dass du aktiv wirst. Und zwar sofort.
„Hier deaktivieren“ klingt harmlos, ist aber genau der Moment, in dem du auf einen Phishing-Link gelotst wirst.

Dazu kommt:

* Keine persönliche Anrede
* Kein Name
* Generischer Text
* Und ein Gerät, das so beschrieben ist, dass es auf ungefähr jeden zutreffen könnte

Hier eine überarbeitete Version, etwas runder und mit deinem typischen Ton:

---

## Wir klicken den Link an

Normalerweise gilt: **Nicht klicken. Einfach löschen. Fertig.**
Aber für den Blog opfern wir uns natürlich und schauen mal, was passiert. 😄

Statt bei PayPal landen wir auf einer eher… sagen wir mal… *kreativen* URL:

`502351c7d6.nclx.io/wp-content/plugins/cano/varno/login.php`

![](/posts/2026-03-21-paypal-login/paypal_2.webp)

Und genau das ist die wichtigste Regel:
👉 **Immer einen Blick in die Adresszeile werfen.**

Echte PayPal-Seiten laufen über Domains wie `paypal.com`.
Alles andere ist - Überraschung - nicht PayPal.

Die Seite selbst gibt sich dann Mühe, seriös auszusehen: Logo, Login-Feld, alles da.

Nur mit einem kleinen Unterschied: **Alles, was du hier eingibst, landet direkt beim Scammer.**

Wir werden also freundlich aufgefordert, unsere Zugangsdaten einzugeben.
Quasi ein Selbstbedienungsformular für Account-Diebstahl.


## Der nächste Schritt: Jetzt noch der Code bitte

Nachdem wir brav unsere Zugangsdaten eingegeben haben (natürlich nur zu Testzwecken 😉), geht es direkt weiter.

Die Seite fordert nun einen Bestätigungscode an:

> „Bitte geben Sie den Code ein, der an Ihre Telefonnummer gesendet wurde“

Klingt erstmal nach normaler Zwei-Faktor-Authentifizierung.
Ist es auch - nur leider nicht für dich, sondern für die Scammer.

Was hier im Hintergrund passiert:
Die eingegebenen Zugangsdaten werden **in Echtzeit** verwendet, um sich tatsächlich bei PayPal einzuloggen. PayPal schickt daraufhin einen echten Sicherheitscode an dein Handy.

Und genau diesen Code sollst du jetzt hier eingeben.

![](/posts/2026-03-21-paypal-login/paypal_3.webp)

Damit hebelst du im Grunde selbst die letzte Sicherheitsstufe aus und gibst den Angreifern den finalen Zugriff auf dein Konto.

Besonders perfide:
Selbst Nutzer, die „2FA ist sicher“ im Hinterkopf haben, tappen hier rein - weil alles scheinbar korrekt abläuft.

## Fazit

Ein klassischer Phishing-Angriff, der erstaunlich gut funktioniert:

Erst wird mit einem angeblichen Login Angst erzeugt, dann werden Zugangsdaten abgegriffen und am Ende sogar noch der Sicherheitscode abgefragt. Schritt für Schritt zum kompletten Account-Zugriff.

Technisch nichts Besonderes - aber psychologisch ziemlich effektiv.

Wer kurz innehält, die Absender-Mail prüft und vor allem einen Blick in die Adresszeile wirft, ist hier klar im Vorteil.

Oder kurz gesagt:
Nicht jeder „PayPal-Login” kommt von PayPal - manche kommen direkt vom Scammer. 😏

---

**Siehe auch:**
- [Bitcoin-Kauf über PayPal – Phishing mit Krypto-Köder](/posts/2025-01-09_bitcoin_paypal/)
- [PayPal-Gewinnspiel: Sie haben eine Geschenkkarte erhalten](/posts/2025-01-23_paypal-gewinnspiel/)


