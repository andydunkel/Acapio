---
title: "Phishing im Klarna-Namen: „Der offene Betrag wartet noch auf Begleichung"
params:
  author: Andy
date: "2026-03-15"
featured: true
toc: true
tags:
  -  "Phishing"
categories:
  - "Phishing"
thumbnail: "invoice.webp"
url: "posts/2026-03-15-klarna"
summary: "Eine E-Mail behauptet, ein offener Betrag müsse dringend beglichen werden, sonst drohe eine Einschränkung des Klarna-Kontos. Klingt offiziell, ist aber höchst verdächtig."
---

Eine E-Mail behauptet, ein offener Betrag müsse dringend beglichen werden, sonst drohe eine Einschränkung des Klarna-Kontos. Klingt offiziell, ist aber höchst verdächtig. 

## Die E-Mail

Die Mail arbeitet mit einem klassischen Druckmittel: **angeblich offene Rechnung, drohende Kontoeinschränkung und eine „Deadline“**. Genau diese Mischung soll Empfänger dazu bringen, möglichst schnell auf den Zahlungs-Button zu klicken – ohne groß nachzudenken.

> Der offene Betrag wartet noch auf Begleichung.  
> Unsere vorherigen Nachrichten blieben ohne Antwort, daher melden wir uns erneut. Bis heute ist der Betrag noch nicht bei uns eingegangen.  
> Um deinen vollen Zugang zu Klarna zu erhalten, Um eine Einschränkung deines Klarna-Kontos zu vermeiden, bitten wir dich, die offene Rechnung bis zur angegebenen Deadline zu begleichen.  
> Nach Eingang der Zahlung kannst du Klarna wie gewohnt weiter nutzen.  

![](/posts/2026-03-15-klarna/mail.webp)


Auffällig ist außerdem der **sehr generische Text**. Es fehlen konkrete Angaben wie Bestellnummer, Händler, Rechnungsdetails oder überhaupt ein nachvollziehbarer Bezug zu einer tatsächlichen Bestellung. Stattdessen wird nur allgemein von einem „offenen Betrag“ gesprochen.

Auch sprachlich wirkt die Nachricht eher zusammengeschustert: Der Satz *„Um deinen vollen Zugang zu Klarna zu erhalten, Um eine Einschränkung deines Klarna-Kontos zu vermeiden“* ist ein schönes Beispiel für Copy-&-Paste mit Stolperfallen. 🪤

## Der Link verrät den Scam

Spätestens beim Blick auf den eigentlichen Link wird klar, dass hier etwas nicht stimmt. Der Button **„Zahlung finalisieren“** führt nämlich nicht zu einer Klarna-Domain, sondern zu einer kryptischen Adresse auf einem **Amazon-S3-Server**:

`mfc2fwoqit2simhjqyn9t.s3.ap-southeast-1.amazonaws.com/...`

![](/posts/2026-03-15-klarna/link.webp)

Solche Links haben mit Klarna natürlich nichts zu tun. Statt einer offiziellen Domain wie `klarna.com` landet man auf einem zufällig wirkenden Speicherbereich in der Cloud. Genau dort legen Betrüger häufig ihre **Phishing-Seiten** ab, weil sich diese schnell erstellen und ebenso schnell wieder austauschen lassen.

Kurz gesagt: **Wenn ein angeblicher Zahlungslink nicht auf die offizielle Domain des Unternehmens führt, sollte man ihn grundsätzlich nicht anklicken.** 🚨


## Fazit

Die Mail folgt einem bekannten Muster: **Zeitdruck, angeblich offene Rechnung und ein großer Zahlungsbutton**. Konkrete Informationen zur Bestellung fehlen jedoch komplett. Spätestens der Blick auf den Link zeigt, dass hier etwas faul ist – statt zur Klarna-Webseite führt er zu einer zufälligen Cloud-Adresse.

Die wichtigste Regel bei solchen Nachrichten: **Keine Links anklicken und keine Zahlungen durchführen.** Wer unsicher ist, sollte sich direkt über die offizielle Klarna-App oder die echte Webseite einloggen und dort prüfen, ob tatsächlich eine Rechnung offen ist.

In den meisten Fällen lautet die Antwort: **Nein – nur wieder ein weiterer Phishing-Versuch.** 🎣

---

**Siehe auch:**
- [ING-Phishing: Telefonnummer fehlt – Daten her!](/posts/2025-02-28_ing-phishing/)
- [Volksbank-Phishing: Mit Bitcoin bezahlt, mit Daten geklaut](/posts/2025-02-22_volksbank-phishing/)
- [Trade Republic Phishing: Identitätsprüfung als Falle](/posts/2026-01-08-traderepublic/)
