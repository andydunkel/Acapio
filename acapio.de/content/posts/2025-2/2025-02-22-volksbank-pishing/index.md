---
title: "Volksbank-Phishing 2025: Mit Bitcoin bezahlt, mit Daten geklaut"
params:
  author: Andy
date: "2025-02-22"
featured: true
toc: true
tags:
  -  "Phishing"
  -  "Hosting"
categories:
  - "Phishing"
thumbnail: "evil_badger.webp"
url: "posts/2025-02-22_volksbank-phishing"
summary: "Phishing-Seiten schießen wie Pilze aus dem Boden, besonders, wenn sie auf anonymen Bitcoin-Hostern betrieben werden. Ein aktueller Fall zeigt, wie Cyberkriminelle mit gefälschten Volksbank-Logins ahnungslose Kunden ins Netz locken."
---

Phishing-Seiten schießen wie Pilze aus dem Boden, besonders, wenn sie auf anonymen Bitcoin-Hostern betrieben werden. Ein aktueller Fall zeigt, wie Cyberkriminelle mit gefälschten Volksbank-Logins ahnungslose Kunden ins Netz locken. 

Während klassische Hosting-Anbieter solche Machenschaften schnell unterbinden, bieten einige Krypto-finanzierte Plattformen einen sicheren Hafen für Betrüger. Doch wer steckt dahinter, und wie kann man sich schützen? Wir haben uns die dubiose Infrastruktur hinter diesem Scam genauer angesehen.

## Die Nachricht kommt per SMS  

Dieses Mal erreicht die potenziellen Opfer eine SMS mit der altbekannten Masche: **"Ihre Volksbank SecureGo App läuft ab. Bitte aktualisieren Sie sie über diesen Link."** Ein scheinbar harmloser Klick genügt, besonders, wenn man müde oder abgelenkt ist. Ehe man sich versieht, öffnet sich eine täuschend echte Login-Seite, und aus reiner Gewohnheit gibt man nichtsahnend die eigenen Zugangsdaten ein. Ein Moment der Unachtsamkeit, der teuer werden kann.

![Die Fake-SMS](/posts/2025-02-22_volksbank-phishing/sms.webp)

## Nur Windows-Nutzer willkommen  

Wer den Phishing-Link unter Linux öffnet, bekommt, nichts. Statt einer gefälschten Volksbank-Seite erscheint lediglich eine weiße Seite. Offensichtlich sind die Betrüger misstrauisch: Wer mit Linux unterwegs ist, könnte ein Sicherheitsforscher oder Journalist sein.  

Unter Windows hingegen sieht die Sache ganz anders aus. Hier präsentiert sich eine täuschend echt wirkende Webseite, die den Anschein erweckt, die offizielle Online-Banking-Seite der Volksbank zu sein. Perfekt darauf ausgelegt, ahnungslose Nutzer in die Falle zu locken.

![Linux-User bekommen nur eine leere Seite](/posts/2025-02-22_volksbank-phishing/linux_vs_windows.webp)

Das gleiche passiert, wenn wir mehrfach auf die Domain zugreifen. Auch hier werden wir am Ende nur mit einer weißen Seite belohnt. Hier wollen die Scammer sicherstellen, dass wir nicht zu oft hinschauen.

## Wo Betrüger ihre Domains registrieren  

Natürlich werfen wir auch einen Blick darauf, wo die Betrüger ihre Webseite **166009.com** registriert haben. Das Muster ist immer dasselbe: Eine beliebige Domain wird angemeldet, und sobald sie gesperrt wird, taucht die nächste auf. Ein endloses Katz-und-Maus-Spiel, bei dem die Kriminellen stets einen Schritt voraus sein wollen.

![Whois der Domain](/posts/2025-02-22_volksbank-phishing/whois.webp)

### Nicenic.com  

Die Domain **166009.com** ist bei **Nicenic.com** registriert, und ein Blick auf deren Webseite erklärt sofort, warum sich Betrüger dort wohlfühlen. Die Zahlung ist in Kryptowährungen möglich, und der Anbieter wirbt damit, dass er Domains nicht vorschnell sperrt.  

> *"No worries, we will not suspend your domain or account without proofs!"*  

Für Cyberkriminelle ist das ein gefundenes Fressen: Ein Hoster, der nicht allzu genau hinsieht und erst bei eindeutigen Beweisen handelt. Natürlich unterstellen wir **Nicenic.com** nichts, schließlich wird die Seite bei klaren Beweisen sicher offline genommen. 😉

![Der Domainregistrar](/posts/2025-02-22_volksbank-phishing/hoster.webp)

Die [Bewertungen bei Trustpilot](https://www.trustpilot.com/review/nicenic.net) sprechen ihre eigene Sprache. Aber natürlich schicken wir eine Abuse-Meldung an den Hoster und schauen was passiert.

![Bewertungen für Nicenic](/posts/2025-02-22_volksbank-phishing/trust.webp)


## Das Phishing  

Die Phishing-Seite macht auf den ersten Blick einen professionellen Eindruck, keine offensichtlichen Fehler, keine schlampige Umsetzung. Hier wurde offenbar hochwertige Software eingesetzt, um die Betrugsmasche möglichst überzeugend wirken zu lassen.  

Der Ablauf ist simpel: Zunächst wählt das Opfer die Bank aus, anschließend werden Benutzername, Passwort und sogar die Telefonnummer abgefragt.  

![Phishing, Eingabe der Daten](/posts/2025-02-22_volksbank-phishing/phishing.webp)  

Was dann im Hintergrund passiert, lässt sich nur vermuten, doch die Indizien sind eindeutig: Die eingegebenen Daten könnten in Echtzeit genutzt werden, um sich beim echten Online-Banking-Konto des Opfers anzumelden. Sobald die Bank eine Bestätigung über die Sicherheits-App anfordert, erhält das Opfer eine Anfrage, und wenn diese leichtfertig akzeptiert wird, haben die Betrüger vollen Zugriff auf das Konto.  

Ein weiteres Detail spricht für diese Theorie: Die Phishing-Sitzung läuft nach einiger Zeit automatisch ab, und die eingegebenen Daten werden gelöscht. Falls das Opfer nicht schnell genug reagiert, tritt ein Timeout ein.  

![Timeout, nach Wartezeit](/posts/2025-02-22_volksbank-phishing/timeout.webp)  

Ein klarer Hinweis darauf, dass hier live mitgeschnitten und mit den gestohlenen Zugangsdaten gearbeitet wird.

## **Fazit**

Dieser Fall zeigt einmal mehr, wie professionell und raffiniert Cyberkriminelle mittlerweile vorgehen. Die Betrüger setzen nicht nur auf täuschend echt wirkende Phishing-Seiten, sondern nutzen auch gezielt Hosting-Dienste, die Zahlungen in Kryptowährungen akzeptieren und Sperrungen nur widerwillig durchführen.  

Die Wahl eines registrierfreundlichen Domain-Providers und die bewusste Blockade von Linux-Nutzern deuten darauf hin, dass hier nicht einfach Amateur-Betrüger am Werk sind, sondern gut organisierte Kriminelle mit einer ausgeklügelten Strategie.  

Für Nutzer bleibt die wichtigste Regel: **Kein Klick auf verdächtige Links, besonders nicht aus SMS!** Offizielle Banken fordern nie per SMS zur Eingabe sensibler Daten auf. Wer unsicher ist, sollte sich direkt bei seiner Bank melden oder die offizielle Webseite manuell aufrufen. Und für all jene, die sich fragen, ob ihre Daten bereits in falsche Hände geraten sind, ein Blick ins Online-Banking-Log oder ein Anruf bei der Bank kann schnell Klarheit schaffen.  

Wir halten euch auf dem Laufenden, ob die Phishing-Seite durch unsere Meldung tatsächlich offline genommen wird. 🚨 Aber selbst wenn, die nächste Domain ist nur wenige Klicks entfernt!

---

**Siehe auch:**
- [ING-Phishing: Telefonnummer fehlt – Daten her!](/posts/2025-02-28_ing-phishing/)
- [Trade Republic Phishing: Identitätsprüfung als Falle](/posts/2026-01-08-traderepublic/)
- [Klarna Phishing: Der offene Betrag als Vorwand](/posts/2026-03-15-klarna/)
