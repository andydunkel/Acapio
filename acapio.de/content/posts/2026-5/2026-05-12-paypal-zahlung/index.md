---
title: "Analyse einer Phishing-Welle: Der Fall ‚Convenity UAB‘ & PayPal"
params:
  author: Andy
date: "2026-05-12"
featured: true
toc: true
tags:
  -  "Phishing"
categories:
  - "Phishing"
thumbnail: "virus.webp"
url: "posts/2026-05-12-paypal-zahlung"
summary: "Eine angebliche Zahlung über 99,91 € an „Convenity UAB“ führt derzeit viele Nutzer auf täuschend echte Login-Seiten. Wir sezieren diese besonders professionelle Phishing-Welle und zeigen dir die versteckten Details, die den Betrug trotz perfekter Optik verraten."
---

## Der Schreckmoment: 99,91 Euro für "Convenity UAB"?

Man öffnet morgens sein Postfach und das Erste, was einem ins Auge springt, ist eine offizielle Zahlungsbestätigung von PayPal. Knapp 100 Euro wurden abgebucht. Der Empfänger: **Convenity UAB**. Wer ist das? Habe ich das bestellt?

Genau auf diesen Moment der Panik setzen Betrüger. In dieser Sekunde klicken viele Menschen ungeprüft auf den Button „Zahlung anzeigen oder verwalten“, um das vermeintliche Problem zu lösen. Doch genau hier beginnt die Falle.

### Die Anatomie einer (fast) perfekten Täuschung

Was diese Mail so gefährlich macht, ist die visuelle Präzision. Die Betrüger nutzen das exakte Corporate Design von PayPal: Schriftarten, Logos, Abstände und sogar die typische rechtliche Fußzeile sind vorhanden.


![Die E-Mail, sieht täuschend echt aus](/posts/2026-05-12-paypal-zahlung/mail.webp)

**Die cleveren Details:**

* **Der psychologische Trick:** Die Mail enthält echte Sicherheitstipps von PayPal am Ende. Das wirkt so absurd ehrlich, dass es das Vertrauen der Opfer stärkt.
* **Die Transaktionsnummer:** Eine generierte ID erzeugt den Eindruck einer realen Datenbankbuchung.
* **Die Support-Mail:** Eine Adresse wie `paypalsupport@convenity.com` wirkt für Laien seriöser als eine kryptische Zeichenfolge.

### Der Blick hinter die Kulisse (Die Red Flags)

Trotz der Optik gibt es bei genauem Hinsehen klare Warnsignale:

1. **Der Absender:** Ein Blick in den Header verrät die Adresse `hello@getagrid.de`. PayPal würde niemals über eine fremde Domain wie "getagrid" kommunizieren.
2. **Die Anrede:** „Hallo“ – mehr nicht. PayPal spricht Kunden in Deutschland grundsätzlich mit dem im Konto hinterlegten Vor- und Zunamen an.
3. **Die Währung:** Die Angabe „€99,91 EUR“ ist redundant (doppelte Währungsbezeichnung), ein kleiner Schönheitsfehler im Skript der Betrüger.

---

## Die Endstation: Eine gekapte Website

Wer den Link in der Mail anklickt, landet nicht bei PayPal, sondern auf einer täuschend echten Login-Maske.

![Phishing, vermutlich gehackte Seite](/posts/2026-05-12-paypal-zahlung/phishing.webp)

Hier wird es technisch interessant: Die URL lautet `buerger-fuer-swisttal.de`. Es ist ein klassisches Muster – die Angreifer hacken schlecht gesicherte, legitime Websites (oft auf WordPress-Basis) und nisten dort ihre Phishing-Verzeichnisse ein. Das hat für die Betrüger zwei Vorteile:

1. Die Domain existiert schon lange und hat eine gewisse „Reputation“ bei Sicherheitsfiltern.
2. Ein SSL-Zertifikat ist meist vorhanden, sodass das grüne Schloss im Browser fälschlicherweise Sicherheit suggeriert.

## Fazit: Was tun?

Wenn du eine solche Mail erhältst: **Niemals über die Links in der E-Mail einloggen.** Gehe immer manuell auf `paypal.com` oder nutze die offizielle App. Wenn dort keine Aktivität in deinen Aktivitäten auftaucht, kannst du die Mail getrost löschen – oder noch besser: als Anhang an `spoof@paypal.com` weiterleiten.
