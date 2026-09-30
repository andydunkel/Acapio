---
title: "Copyright-Phishing mit Google-Weiterleitung: Der Fall Stephanie Lara"
params:
  author: Andy
date: "2026-09-30"
draft: false
featured: true
toc: true
tags:
  - "Scam"
  - "Phishing"
  - "Urheberrecht"
  - "Social Engineering"
categories:
  - "Scam"
thumbnail: "badger_surprise.webp"
url: "posts/2026-09-30-stimme-lizenz"
summary: "Stephanie Lara fragt nach einer Lizenz für eine angeblich fremde Stimme. Die zweite Mail führt über einen Google-Link zu einer am selben Tag registrierten und bereits als gefährlich gemeldeten Domain."
---

Braucht man eine Lizenz für die eigene Stimme? Eigentlich nicht. Trotzdem erreichte uns eine rätselhafte E-Mail, in der genau diese Frage aufgeworfen wird – nur leider ohne zu verraten, um welches Video, welchen Track oder welche Stimme es überhaupt gehen soll.

## Die E-Mail von Stephanie Lara

Die Absenderin nennt sich **Stephanie Lara** und schreibt von `spinerexon1972@libero.it`:

> Respected eKiwi-Blog Tutorials,
> I'd like to ask if you actually have obtained a proper license for the voice as the track?
> Just wondering since it was performed by the original owner.

Das Englisch klingt etwas holprig, der Vorwurf bleibt nebulös. Eine URL, ein Titel, eine Zeitangabe und der Name des angeblichen Rechteinhabers fehlen komplett. Auch erklärt Stephanie Lara nicht, in welcher Beziehung sie zu diesem „original owner“ stehen soll.

Besonders kurios: Die Stimme in unseren Videos nehmen wir selbst auf. Einen fremden Sprecher haben wir dafür weder heimlich im Keller versteckt noch aus dem Internet ausgeliehen. 🎙️

## Ein Köder für die nächste Mail?

Noch enthält die Nachricht keinen gefährlichen Link, keinen Anhang und keine Geldforderung. Das macht sie aber nicht automatisch harmlos. Bei mehrstufigem E-Mail-Betrug beginnt die Unterhaltung häufig mit einer kurzen und bewusst vagen Frage. Erst nach einer Antwort folgen angebliche Beweise, Zahlungsforderungen oder Links zu Phishing-Seiten.

[Proofpoint beschreibt solche „Lure“-Mails](https://www.proofpoint.com/us/blog/threat-insight/bec-taxonomy-lures-and-tasks) als Test, ob ein Postfach aktiv und die angeschriebene Person zu einer Unterhaltung bereit ist. Auch die [Watchlist Internet dokumentiert eine Copyright-Masche](https://www.watchlist-internet.at/news/copyright-verletzung-betrugsversuch/), bei der Webseitenbetreiber zunächst mit einem angeblichen Urheberrechtsverstoß konfrontiert und später zur Zahlung einer erfundenen Gebühr aufgefordert werden.

Ob das hier ebenfalls der Plan ist, konnten wir nach der ersten Nachricht noch nicht sicher sagen. Die fehlenden Angaben und die merkwürdige Formulierung lieferten jedenfalls genügend Gründe für eine gesunde Portion Misstrauen.

## Unsere Antwort

Wir haben kurz nachgefragt:

> What do you mean? I have licensed the voice.

Damit war der Ball wieder bei Stephanie Lara. Und tatsächlich kam die nächste Nachricht.

## Die angebliche Beschwerdeplattform

Statt das betroffene Video, den vermeintlichen Künstler oder auch nur den Titel des Musikstücks zu nennen, schickt uns Stephanie auf ein unbekanntes Portal:

> Please explain why you would use music from another person without crediting the original artist?
> Please go to our website, search for your channel, find the registered claim, and submit your response directly on the site. The appeal must be submitted through the portal.
> Visit the website and enter @channel in the search bar:
> [Link aus Sicherheitsgründen entfernt]
> Please be advised that submissions made via any other method will not be accepted or reviewed.
> We await your response at your earliest convenience.

Die Forderung wird nun bestimmter, der angebliche Verstoß aber keinen Deut konkreter. Wer der „original artist“ sein soll, welches Musikstück betroffen ist und an welcher Stelle wir es verwendet haben sollen, bleibt weiterhin geheim. Diese Informationen gebe es angeblich erst auf der verlinkten Website. Praktisch – zumindest für den Betreiber der Falle.

## Google steht nur vorne auf dem Link

Der Link in der E-Mail beginnt tatsächlich mit `https://www.google.com/`. Das sieht auf den ersten Blick vertrauenswürdig aus. Dahinter steckt jedoch eine Weiterleitungsadresse mit einem langen, nicht lesbaren Parameter. Google ist hier nicht Betreiber der Beschwerdeplattform, sondern lediglich die erste Station.

Bei unserem Aufruf führte die Weiterleitung schließlich zu:

```text
hxxps://channel-info[.]icu/
```

Den vollständigen Link aus der E-Mail veröffentlichen wir nicht. Er sollte keinesfalls auf einem normalen Arbeitsrechner aufgerufen werden.

Bei einer späteren technischen Prüfung am selben Tag zeigte derselbe Google-Link bereits auf eine andere Domain und dort auf eine belanglose spanische Seite über Server-Uptime. Ob das Ziel ausgetauscht wurde oder abhängig vom Aufruf unterschiedliche Inhalte ausgeliefert werden, lässt sich daraus allein nicht bestimmen. Es zeigt aber, wie wenig der sichtbare Google-Link über das tatsächliche Ziel verrät.

## Domain frisch registriert, Firefox schlägt Alarm 🚨

Die öffentliche [RDAP-Auskunft](https://rdap.centralnic.com/icu/domain/channel-info.icu) für `channel-info.icu` ist ziemlich eindeutig:

```text
Registriert:  30. September 2026, 00:26:59 UTC
Geändert:     30. September 2026, 00:27:05 UTC
Ablaufdatum:  30. September 2027
Registrar:    Hosting Concepts B.V. / Registrar.eu
```

Die angebliche Plattform für bereits „registrierte“ Urheberrechtsansprüche wurde somit ausgerechnet am Tag der E-Mail registriert. Bei unserem Test war die Seite kurz darauf nicht mehr erreichbar. Firefox blendete zudem eine Warnung vor einer betrügerischen beziehungsweise gefährlichen Website ein.

Solche Warnungen erscheinen laut der [Mozilla-Dokumentation](https://support.mozilla.org/en-US/kb/firefox-privacy-and-security-features), wenn eine Seite als Phishing-Seite, Quelle unerwünschter Software oder Malware-Angriffsseite gemeldet wurde. Welcher konkrete Schadcode oder welches Phishing-Formular auf dieser Domain ausgeliefert wurde, können wir wegen der inzwischen nicht mehr erreichbaren Seite nicht bestimmen.

## Fazit: Der vage Vorwurf war nur der Türöffner

Aus der harmlos wirkenden Frage nach einer Stimmlizenz wurde in der zweiten Mail eine angebliche Beschwerde wegen fremder Musik. Belege gab es weiterhin keine. Stattdessen sollten wir einem verschleierten Google-Link auf eine taufrische und bereits als gefährlich gemeldete Domain folgen.

Damit hat sich der Verdacht bestätigt: Die erste Nachricht sollte vor allem eine Antwort provozieren. Anschließend kam der eigentliche Köder – ein angebliches Copyright-Portal, das mit Google und YouTube nichts zu tun hat.

Bei echten Urheberrechtsproblemen auf YouTube führt der sichere Weg direkt ins YouTube Studio. Dort lassen sich Anspruchsteller, betroffenes Material und gegebenenfalls die beanstandete Audiospur prüfen. Offizielle Hinweise zu Copyright-Strikes kommen laut [YouTube-Hilfe](https://support.google.com/youtube/answer/2814000?hl=de) von `no-reply@youtube.com`, nicht von Stephanie Lara über ein italienisches Freemail-Postfach.

Kurz gesagt: keine Belege, keine nachvollziehbare Identität, eine brandneue Domain und eine Browserwarnung. Mehr rote Flaggen passen kaum in zwei E-Mails. 🚩
