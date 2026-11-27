---
title: "PayPal-Betrugsanruf: IP-Check und AnyDesk als Falle"
params:
  author: Andy
date: "2026-11-27"
draft: false
featured: true
toc: true
tags:
  - "Scam"
  - "Telefonbetrug"
  - "PayPal"
  - "AnyDesk"
  - "Fernzugriff"
categories:
  - "Scam"
thumbnail: "paypal.webp"
url: "posts/2026-11-27-paypal-betrugsanruf-ip-check-anydesk"
summary: "PayPal-Betrugsanruf mit Taste 1: Auf die Suche nach ‚check my ip address private‘ folgt die Fernwartungsfalle. So geraten Konten und Sicherheitscodes in Gefahr."
---

Angeblich meldet sich **PayPal wegen einer unautorisierten Zahlung**. Es folgen ein irreführender IP-Check und die Aufforderung, eine Fernwartungs-App aufs Smartphone zu laden. Nach rund fünf Minuten breche ich vor der Installation ab. Einen Hack hatte der angebliche Support nicht nachgewiesen. Zugriff wollte er trotzdem. 📞

![Illustration zu PayPal-Betrug: Smartphone mit gefälschter Login-Seite, Warnsymbolen und einem Papagei](/paypal.webp)

## PayPal-Anruf mit Taste 1: private Nummer, große Sorgen

Der Anruf kommt mit **unterdrückter Rufnummer**. Eine automatische Ansage behauptet, es gebe eine unautorisierte PayPal-Zahlung. Ich soll **die 1 drücken**. Anschließend übernimmt ein vermeintlicher Mitarbeiter: Ich sei wohl gehackt worden, PayPal sei offen.

Deutschen Kunden in holprigem Englisch einen Sicherheitsnotfall verkaufen zu wollen, ist schon sportlich. Die Rufnummer bleibt vorsichtshalber privat. Vertrauen muss offenbar auch ohne Absender funktionieren.

Diesen Einstieg beschreibt auch die [Verbraucherzentrale als bekannte PayPal-Betrugsmasche](https://www.verbraucherzentrale.de/wissen/digitale-welt/phishingradar/warnung-vor-falschen-amazon-und-paypalanrufen-86727).

## „check my ip address private“: VPN-Werbung als Diagnose

Ich soll bei Google **`check my ip address private`** eingeben und die Seite mit dem grünen Schloss aufrufen. Gemeint ist der [IP-Check von Private Internet Access](https://www.privateinternetaccess.com/what-is-my-ip), kurz **PIA**. Dort steht:

> Unprotected
>
> You are not connected to PIA

Außerdem erscheinen IP-Adresse, Internetanbieter, ungefährer Standort, Browser, Betriebssystem und Bildschirmauflösung. Das lässt sich aus der normalen Verbindung und Browserinformationen ermitteln. Ein Beleg für einen Einbruch ist es nicht.

**PIA ist ein echter VPN-Anbieter.** Ein VPN leitet die Verbindung durch einen verschlüsselten Tunnel zu einem anderen Server. „Unprotected“ bedeutet laut [PIA-Dokumentation](https://helpdesk.privateinternetaccess.com/hc/en-us/articles/46818784057115-How-Do-I-Know-If-My-VPN-Is-Working) lediglich, dass die Seite keine Verbindung über PIA erkennt. Sie prüft weder mein PayPal-Konto noch mein Smartphone auf Schadsoftware.

Der Anrufer deutet „Unprotected“ prompt als Handlungsbedarf. Eine Verkaufsanzeige wird zur Sicherheitsdiagnose befördert. Der Regenschirmhändler hat festgestellt, dass ich seinen Schirm nicht besitze. Sofortiger Katastrophenalarm. ☂️

Es gibt keinen Anhaltspunkt, dass die Anrufer die PIA-Seite betreiben. Sie benutzen deren Anzeige als Kulisse für ihre Geschichte.

## Vermutlich AnyDesk: zur Rettung bitte die Fernbedienung

Als Nächstes soll ich eine App aus dem **Google Play Store** installieren, vermutlich **AnyDesk**. Den diktierten Namen hatte ich zunächst anders verstanden; ein überprüfter Store-Eintrag liegt nicht vor. Hier breche ich ab.

AnyDesk ist eine legitime Fernwartungssoftware. Sie kann einen Bildschirm übertragen und unter passenden Voraussetzungen die Bedienung aus der Ferne ermöglichen. Auf Android erfordert Fernsteuerung zusätzliche Berechtigungen und häufig ein Zusatzmodul, wie die [AnyDesk-Dokumentation](https://support.anydesk.com/anydesk-for-android) erläutert. **Die bloße Installation bedeutet also noch keinen vollständigen Zugriff.**

Praktisch für Betrüger: Die App kommt aus einem offiziellen Store, die Freigaben lassen sie sich erteilen. Der Play Store überprüft schließlich nicht, wer am anderen Ende der Leitung sitzt.

## Fernzugriff aufs Smartphone: E-Mail, PayPal und der zweite Faktor

Je nach Berechtigungen, Geräteschutz und geöffneten Apps können Bildschirmübertragung oder Fernsteuerung Folgendes gefährden:

* **E-Mail:** Ein zugängliches Postfach enthält persönliche Nachrichten und möglicherweise Links oder Codes zum Zurücksetzen weiterer Konten.
* **PayPal und andere Konten:** Bereits angemeldete Apps können interessant sein, auch ohne Kenntnis des Passworts. Zusätzliche Freigaben können den Zugriff begrenzen.
* **Passwörter:** Sichtbare Zugangsdaten oder Eingaben können gefährdet sein. Ein gesperrter Passwortmanager wird durch Fernwartung allerdings nicht automatisch geöffnet.
* **Zwei-Faktor-Authentifizierung:** Der zusätzliche Sicherheitsnachweis ist etwa ein SMS- oder App-Code. Wird er auf dem übertragenen Bildschirm sichtbar, kann er möglicherweise mitgelesen werden. Auch können Betroffene zur Bestätigung einer Anmeldung oder Zahlung überredet werden.

Besonders praktisch für den falschen Retter: Auf demselben Smartphone liegen womöglich das Konto **und der Code, der es schützen soll**.

Automatischen Zugriff auf sämtliche Apps bedeutet das nicht: Apps können PIN oder Biometrie verlangen und sensible Inhalte bei Bildschirmübertragungen ausblenden. [Google beschreibt solche Schutzfunktionen für Android](https://developer.android.com/security/fraud-prevention/activities). Zwei-Faktor-Schutz bleibt sinnvoll; Fernzugriff oder erschlichene Freigaben können ihn jedoch unterlaufen.

## Was tun bei einem angeblichen PayPal-Sicherheitsanruf?

**Auflegen, PayPal selbst öffnen und die Aktivitäten prüfen.** Keine Fernwartung auf Zuruf installieren, keine Bildschirmfreigabe erteilen und keine Sicherheitscodes weitergeben.

Wer bereits Zugriff gewährt hat, sollte die Internetverbindung des betroffenen Geräts trennen und die Fernwartungs-App samt Zusatzmodulen entfernen. Über ein anderes vertrauenswürdiges Gerät betroffene Konten sichern: Passwörter ändern, aktive Sitzungen beenden und Aktivitäten prüfen. Zahlungsanbieter beziehungsweise Bank umgehend über den möglichen Zugriff informieren; bei Schaden Anzeige erstatten. Die [Cybersicherheitsbehörde ACSC empfiehlt nach betrügerischem Fernzugriff ebenfalls schnelle Kontosicherung und Bankkontakt](https://www.cyber.gov.au/advisory/protect-yourself-from-remote-access-scams).

## Fazit: Den Zugriff hätte ich selbst liefern sollen

Der **PayPal-Betrugsanruf** hatte eine VPN-Anzeige zum Notfall erklärt. Den gefährlichen Zugriff sollte ich selbst ermöglichen. **Wer am Telefon vor Hackern warnt und dafür die Kontrolle über dein Smartphone verlangt, bekommt am besten ein aufgelegtes Telefon.**
