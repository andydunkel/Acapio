---
title: "YouTube-Copyright-Phishing: Der Fall Stephanie Lara"
params:
  author: Andy
date: "2026-09-30"
draft: false
featured: true
toc: true
tags:
  - "Scam"
  - "Phishing"
  - "YouTube"
  - "Urheberrecht"
  - "Passwortdiebstahl"
  - "Social Engineering"
categories:
  - "Phishing"
thumbnail: "badger_surprise.webp"
url: "posts/2026-09-30-stimme-lizenz"
summary: "Stephanie Lara lockt mit einem erfundenen Copyright-Verstoß auf eine gefälschte YouTube-Seite. Am Ende sollen die Google-Zugangsdaten des Kanalbetreibers gestohlen werden."
---

Braucht man eine Lizenz für die eigene Stimme? Mit dieser merkwürdigen Frage begann eine mehrstufige Phishing-Attacke auf unseren YouTube-Kanal. Zunächst fehlten jeder Link und jeder konkrete Vorwurf. Nach mehreren Nachrichten schickte uns die angebliche Stephanie Lara schließlich auf ein gefälschtes Copyright-Portal.

Inzwischen lässt sich das Ziel der Masche klar belegen: Die Seite erfindet einen Copyright-Strike, baut das YouTube Studio nach und fordert am Ende zur Anmeldung mit dem Google-Konto auf. Die eingegebenen Zugangsdaten landen jedoch nicht bei Google, sondern bei den Betrügern.

*Update vom 1. Oktober 2026: Die Absenderin hat uns eine neue Adresse geschickt. Dieses Mal waren die Phishing-Seiten erreichbar. Wir haben den Artikel deshalb um den vollständigen Ablauf und zwei Screenshots ergänzt.*

## Die erste E-Mail von Stephanie Lara

Die Absenderin nennt sich **Stephanie Lara** und schreibt von `spinerexon1972@libero.it`:

> Respected eKiwi-Blog Tutorials,
> I'd like to ask if you actually have obtained a proper license for the voice as the track?
> Just wondering since it was performed by the original owner.

Das Englisch klingt etwas holprig, der Vorwurf bleibt nebulös. Eine URL, ein Titel, eine Zeitangabe und der Name des angeblichen Rechteinhabers fehlen komplett. Auch erklärt Stephanie Lara nicht, in welcher Beziehung sie zu diesem „original owner“ stehen soll.

Besonders kurios: Die Stimme in unseren Videos nehmen wir selbst auf. Einen fremden Sprecher haben wir dafür weder heimlich im Keller versteckt noch aus dem Internet ausgeliehen. 🎙️

## Der harmlose Einstieg ist Teil der Masche

Noch enthielt die erste Nachricht keinen gefährlichen Link, keinen Anhang und keine Geldforderung. Das machte sie aber nicht harmlos. Bei mehrstufigem E-Mail-Betrug beginnt die Unterhaltung häufig mit einer kurzen und bewusst vagen Frage. Die erste Antwort bestätigt den Betrügern, dass das Postfach aktiv ist und jemand auf den Vorwurf reagiert.

[Proofpoint beschreibt solche „Lure“-Mails](https://www.proofpoint.com/us/blog/threat-insight/bec-taxonomy-lures-and-tasks) als Köder, auf den nach einer Antwort die eigentliche Aufgabe folgt. Auch die [Watchlist Internet dokumentiert eine Copyright-Masche](https://www.watchlist-internet.at/news/copyright-verletzung-betrugsversuch/), bei der Webseitenbetreiber zunächst mit einem angeblichen Urheberrechtsverstoß konfrontiert und später zur Zahlung einer erfundenen Gebühr aufgefordert werden.

Wir haben kurz nachgefragt:

> What do you mean? I have licensed the voice.

Damit war der Ball wieder bei Stephanie Lara – und der Vorwurf wechselte prompt von einer fremden Stimme zu angeblich nicht gekennzeichneter Musik.

## Erst ein verschleierter, dann ein direkter Link

In ihrer nächsten Nachricht sollten wir unseren Kanal auf einem unbekannten Portal suchen und dort Einspruch einlegen. Der Link begann mit `https://www.google.com/`, führte über eine Google-Weiterleitung aber tatsächlich zu einer fremden Domain:

```text
hxxps://channel-info[.]icu/
```

Die Domain war am Tag der E-Mail frisch registriert worden und wurde von Firefox bereits als gefährlich gemeldet. Kurz darauf war die Seite nicht mehr erreichbar. Der sichtbare Google-Link sollte lediglich Vertrauen schaffen; mit Google oder YouTube hatte das Ziel nichts zu tun.

Am nächsten Tag erhielten wir eine weitere Nachricht:

> Visit the website and enter @channel in the search bar:
> hxxps://channel-review[.]netlify[.]app/
> Please be advised that submissions made via any other method will not be accepted or reviewed.
> We await your response at your earliest convenience.

Dieses Mal funktionierte die Seite. Die Adresse liegt zwar unter `netlify.app`, das macht den Inhalt aber nicht offiziell: Netlify ist ein Hosting-Dienst, auf dem Nutzer eigene Websites bereitstellen können. Entscheidend ist, dass die Adresse weder zu `youtube.com` noch zu `google.com` gehört.

## Stufe 1: Die erfundene Copyright-Warnung

Nach der Suche nach einem Kanalnamen behauptet die Seite pauschal, ein YouTube-Video enthalte urheberrechtlich geschütztes Material. Welches Video, welches Werk und welcher Rechteinhaber gemeint sein sollen, verrät sie weiterhin nicht.

![Gefälschte Copyright-Warnung nach der Suche nach einem YouTube-Kanal](/posts/2026-09-30-stimme-lizenz/phishing_1.webp)

Der grüne Button „Submit Application“ klingt nach einem Einspruchsformular. Tatsächlich verlässt man damit die erste Website und landet auf einer zweiten fremden Domain:

```text
hxxps://dmca-alert[.]org/
```

Dieser Domainwechsel ist im normalen Ablauf leicht zu übersehen. Keine der beiden Adressen gehört zu YouTube oder Google.

## Stufe 2: Eine gefälschte YouTube-Studio-Ansicht

Die zweite Seite fragt den Kanalnamen beziehungsweise die Kanaladresse ab. Anschließend präsentiert sie ein nachgebautes „Channel Dashboard“ im Stil von YouTube Studio. In unserem Test übernahm die Seite den echten Namen und das Profilbild des ausgewählten Kanals.

![Gefälschtes YouTube-Studio-Dashboard mit angeblichem Copyright-Strike und Google-Anmeldung](/posts/2026-09-30-stimme-lizenz/phishing_2.webp)

Die echten Kanaldaten sind kein Beweis für einen Copyright-Verstoß. Sie sind öffentlich über YouTube abrufbar und werden von der Phishing-Seite lediglich in die vorbereitete Kulisse eingesetzt. Die angebliche Fallnummer, der Status „Pending Review“ und der Copyright-Strike werden dagegen von der Seite selbst erzeugt.

Mehrere Elemente sollen das Opfer unter Druck setzen und gleichzeitig Vertrauen schaffen:

* **„Active Copyright strikes: 1“:** Eine rote Warnung behauptet, es liege bereits ein aktiver Strike vor.
* **Erfundene Fallnummer:** Eine Zeichenfolge im Format `YT-CR-…` sieht offiziell aus, ist aber kein Nachweis für ein echtes YouTube-Verfahren.
* **Zeitdruck:** Ohne rechtzeitige Antwort werde der Strike angeblich dauerhaft.
* **Vertraute Gestaltung:** YouTube-Logo, Farben und das Layout des YouTube Studios täuschen eine offizielle Seite vor.
* **„Sign in with Google“:** Der bekannte Google-Schriftzug soll den entscheidenden Klick legitim erscheinen lassen.

## Stufe 3: Die Google-Zugangsdaten sollen gestohlen werden

Der Button „Sign in with Google“ führt nicht zu einem echten Google-OAuth-Dialog. Stattdessen erzeugt die Website selbst ein Anmeldefenster, das wie „Google Accounts“ aussieht. Sogar `accounts.google.com` wird innerhalb der nachgebauten Fensteroberfläche angezeigt. Die echte Browser-Adresszeile bleibt jedoch auf der fremden Domain.

Eine Prüfung des ausgelieferten Quellcodes bestätigt den Datendiebstahl. Das Skript lädt die gefälschte Anmeldung von der Angreifer-Domain, lauscht auf die dort eingegebenen Kontodaten und bereitet deren Übertragung an die Betreiber vor. Im Code wird der Datensatz unmissverständlich als „GOOGLE ACCOUNT DATA RECEIVED“ bezeichnet. Zusätzlich erfasst die Seite unter anderem IP-Adresse, Browser, Betriebssystem und den eingegebenen YouTube-Kanal.

Damit handelt es sich nicht nur um eine verdächtige Drittanbieter-Seite, sondern um klassisches **Credential-Phishing**: Gestohlen werden sollen die Zugangsdaten des Google-Kontos, das mit dem YouTube-Kanal verbunden ist. Mit diesem Konto könnten Angreifer je nach Kontoschutz den Kanal übernehmen, Videos austauschen, Livestreams starten oder weitere Personen im Namen des Opfers täuschen.

## Woran lässt sich der Betrug erkennen?

Der gesamte Ablauf enthält zahlreiche Warnzeichen:

* Der erste Vorwurf nennt weder Video noch Musikstück, Zeitpunkt oder Rechteinhaber.
* Die Geschichte ändert sich von einer angeblich fremden Stimme zu nicht gekennzeichneter Musik.
* Die Absenderin nutzt ein italienisches Freemail-Postfach und weist keine Verbindung zu YouTube oder einem Rechteinhaber nach.
* Die Links führen zu wechselnden, fremden Domains statt zu YouTube oder Google.
* Ein **beliebiger Kanalname** genügt, um angeblich einen Copyright-Strike zu „finden“.
* Details sollen erst nach einer Google-Anmeldung sichtbar werden.
* Die Seite zeigt eine gefälschte Adressleiste mit `accounts.google.com`, obwohl der Browser die Angreifer-Domain aufgerufen hat.

Ein HTTPS-Schloss oder eine Adresse bei einem bekannten Hosting-Anbieter schützt nicht vor Phishing. Beides besagt nur, dass die Verbindung zur aufgerufenen Website verschlüsselt ist – nicht, dass deren Betreiber vertrauenswürdig sind.

## Was tun, wenn Zugangsdaten eingegeben wurden?

Wer seine Google-Zugangsdaten auf einer solchen Seite eingegeben hat, sollte sofort handeln:

1. **Google-Passwort ändern:** Die echte Google-Kontoseite manuell aufrufen und ein neues, einzigartiges Passwort setzen.
2. **Unbekannte Sitzungen beenden:** In den Sicherheitseinstellungen angemeldete Geräte und letzte Kontoaktivitäten prüfen.
3. **Zwei-Faktor-Authentisierung aktivieren:** Am besten einen Passkey oder einen Sicherheitsschlüssel verwenden.
4. **Wiederverwendete Passwörter ersetzen:** Dasselbe Kennwort muss auch bei allen anderen Diensten geändert werden.
5. **YouTube-Kanal prüfen:** Berechtigungen, Kanalinhaber, hochgeladene Videos, Livestreams und Änderungen kontrollieren.
6. **Wiederherstellungsmethoden kontrollieren:** Unbekannte E-Mail-Adressen, Telefonnummern und verbundene Apps entfernen.
7. **Bei einem Firmenkonto die IT informieren:** Administratoren können Sitzungen widerrufen, Protokolle prüfen und weitere Schutzmaßnahmen einleiten.

Auch wer nur geklickt, aber keine Daten eingegeben oder Dateien heruntergeladen hat, sollte die Seite schließen und die Nachricht als Phishing melden. Da die Website bereits beim Besuch technische Daten erfasst, sollte man nicht erneut „zum Testen“ darauf zugreifen.

## Fazit: Die Stimmlizenz war nur der Türöffner

Die vermeintliche Frage nach einer Stimmlizenz hatte mit dem späteren Angriff kaum etwas zu tun. Sie sollte eine Reaktion provozieren. Danach folgten ein erfundener Musikvorwurf, wechselnde Domains, eine pauschale Copyright-Warnung und schließlich eine gefälschte YouTube-Studio-Seite zur Übernahme des Google-Kontos.

Bei echten Urheberrechtsproblemen auf YouTube führt der sichere Weg direkt ins selbst aufgerufene YouTube Studio. Dort lassen sich Anspruchsteller, betroffenes Material und gegebenenfalls die beanstandete Audiospur prüfen. Offizielle Hinweise zu Copyright-Strikes kommen laut [YouTube-Hilfe](https://support.google.com/youtube/answer/2814000?hl=de) von `no-reply@youtube.com` – nicht von Stephanie Lara über ein italienisches Freemail-Postfach und nicht über ein fremdes „Appeal Portal“.

Kurz gesagt: **Nicht auf den Link antworten, nicht über die fremde Seite anmelden und Copyright-Warnungen immer direkt im YouTube Studio prüfen.**
