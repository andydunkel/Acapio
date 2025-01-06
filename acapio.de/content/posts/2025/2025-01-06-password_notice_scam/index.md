---
title: "Passwort der E-Mail-Adresse abgelaufen"
params:
  author: Andy
date: "2025-01-06"
featured: true
toc: true
tags: 
  -  "phishing"
categories:
    - "Phishing"
    - "Security"
thumbnail: "hacker.webp"
url: "posts/2025-01-05_password_expired"
summary: "Das Passwort für unsere E-Mail-Adresse ist abgelaufen... wir müssen schnell handeln"
---

Schreck lass nach, dass E-Mail-Passwort läuft ab. Hier ist alles dabei, was Phishing ausmacht, Dringlichkeit, Grammatik und Rechtschreibfehler und ungewöhnliche Links. Die Absenderadresse ist passenderweise unsere Domain mit "noreply" for dem @!

> Password Expiration Notice  
>   
> Your password will expires today 1/2/2025 6:56:10 p.m. Please update your password to ensure continued access to your email account.  
>   
> Password Status: Expiring today 1/2/2025 6:56:10 p.m.  

![Eine typische E-Mail](/posts/2025-01-05_password_expired/notice_1.webp)

## Was passiert, wenn wir den Link klicken?

Wir werfen die virtuelle Maschine an und schauen mal, was passiert. Im Link steckt unsere E-Mail-Addresse. Diese wird übergeben, damit können beliebige E-Mail-Adressen übergeben werden.

Tragen wir eine andere E-Mail-Adresse ein, wird dieser übernommen. Es erscheint ein Login-Formular, sogar an das Logo haben die Phisher gedacht. Geben wir eine Firmenadresse an, wird das Logo angezeigt.

![Aufbau des Links](/posts/2025-01-05_password_expired/email_scam_1.webp)

Tragen wir Daten ein und schicken das Formular ab, werden die Daten an einen anderen Server übermittelt. Vermutlich handelt es sich hierbei um einen gehackten Server, auf dem die Phisher das Script abgelegt haben. Dieses sammelt die Daten und leitet diese an die Scammer weiter.

![Datenübermittel an externen Server](/posts/2025-01-05_password_expired/email_scam_2.webp)

E-Mail-Adresse und Passwort werden übermittelt. In unserem Fall, Zufallsdaten.

![Übermittelte Daten](/posts/2025-01-05_password_expired/email_scam_3.webp)


## Was sind die Folgen? 

Die Folgen können dramatisch sein. Sobald die Bösewichte die Zugangsdaten haben, können diese sich einloggen und als erste Maßnahme wird das Kennwort geändert. Neben Zugriff auf die Mails können sie mit der E-Mail-Adresse von anderen Webseiten Kennwörter zurücksetzen und so weitere Accounts übernehmen.

**Sollten Sie auf sowas reinfallen, versuchen Sie umgehend versuchen das Kennwort zurück zu setzen. Ansonsten kontaktieren Sie ihren Provider, damit dieser die E-Mail-Adresse sperren oder das Kennwort zurücksetzen kann.**

## Gehackter Server?

Die Daten laufen über einen anderen Webserver. Hier wurde vermutlich eine Sicherheitslücke in WordPress genutzt, um eine PHP-Datei im Ordner "wp-includes" ablegen zu können:

    https://mtmdesignbd.com/wp-includes/ceoupdate.php

Die Besitzer der Webseite wissen vermutlich nichts von ihrem Glück.

### Wir kontaktieren die Webseitenbesitzer

Natürlich kontaktieren wir die Webseitenbesucher, die ihre WordPress-Installation überprüfen sollen. Fragen auch nach einer Kopie der PHP-Datei, sofern möglich.

## Weitere Beispiele

Hier sind weitere Beispiele. Mal sehen wir wichtige Nachrichten, welche auf uns warten.

![](/posts/2025-01-05_password_expired/notice_2.webp)

Oder nur der Hinweis in etwas anderer Form.

![](/posts/2025-01-05_password_expired/notice_3.png)

