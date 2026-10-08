---
title: "Gefälschte Hotelbeschwerde: Hinter dem Google-Link steckt Malware"
params:
  author: Andy
date: "2026-09-27"
featured: true
toc: true
tags:
  - "Phishing"
  - "Social Engineering"
  - "Google"
  - "Hotel"
  - "Malware"
categories:
  - "Phishing"
thumbnail: "iltis.webp"
url: "posts/2026-09-27-hotel-beschwerde"
summary: "Eine empörte Hotelgästin droht wegen angeblicher Beleidigungen mit einem öffentlichen Video. Der vermeintliche Google-Link führt über eine erst drei Tage alte fremde Domain zu einem ZIP-Archiv mit Malware."
---

Eine Hotelgästin sei rassistisch beleidigt und vor ihrer Familie gedemütigt worden. Sie habe alles gefilmt, erwarte sofort eine Stellungnahme und drohe andernfalls mit der Qualitätsabteilung und einer Veröffentlichung. Das klingt nach einer Beschwerde, die kein Hotel einfach liegen lassen möchte.

Genau darauf setzt diese Phishing-Mail. Der angebliche Videolink beginnt sichtbar mit `www.google.com` – führt über eine Google-Weiterleitung aber auf eine völlig andere und erst wenige Tage alte Domain. Statt des versprochenen Videos wurde dort nach den Informationen unserer Quelle ein **ZIP-Archiv mit Malware** ausgeliefert. Das Skandalvideo? Fehlanzeige. Dafür gibt es jede Menge rote Flaggen. 🚩

## Die angebliche Beschwerde von „Frieda“

Der Betreff beginnt mit „Meine Familie beleidigt, ich gedemütigt – das lasse ich nicht durchgeh…“. Als Absender erscheint **Frieda** mit der Adresse `gijutsu@k-koken.jp`. Die Nachricht ist außerdem mit hoher Priorität markiert:

![Phishing-Mail mit angeblicher Beschwerde einer Hotelgästin](/posts/2026-09-27-hotel-beschwerde/mail.webp)

Die Mail im Wortlaut; die beleidigenden Begriffe geben wir ausschließlich zur Dokumentation der Masche wieder:

> Sehr geehrte Damen und Herren,
>
> ich bin fassungslos. Die Zimmerdame hat mich als „Neger“ und „Affe“ bezeichnet und das vor meinen Augen! Meine Familie hat sie ebenfalls beleidigt. Ich bin Ihre zahlende Gästin, und so ein Umgang ist für mich nicht hinnehmbar.
>
> Den gesamten Vorfall habe ich auf Video aufgenommen:  
> `https://www.google.com/share.google?q=CBquCspYGOEiQpNOU`
>
> Ich erwarte eine Stellungnahme und Wiedergutmachung. Kommt keine zufriedenstellende Antwort, leite ich die Beschwerde an die Qualitätsabteilung weiter und teile das Video öffentlich.
>
> Mit freundlichen Grüßen  
> Ihre Gästin

Zimmernummer, Aufenthaltszeitraum, Buchungsnummer und vollständiger Name fehlen. Dafür liefert „Frieda“ maximale Empörung und einen Link, der angeblich alle offenen Fragen mit einem Video beantworten soll.

## Warum die Geschichte so gut als Köder funktioniert

Die Nachricht zielt nicht auf Neugier allein, sondern auf den beruflichen Reflex des Empfängers:

* **Schwerer Vorwurf:** Rassistische Beleidigungen durch eine Mitarbeiterin verlangen nach schneller Aufklärung.
* **Drohender Imageschaden:** Das angebliche Video soll veröffentlicht und die Beschwerde weitergeleitet werden.
* **Hohe Priorität:** Die Outlook-Markierung verstärkt den Eindruck, dass sofort gehandelt werden müsse.
* **Emotionaler Ton:** Wer empört ist, klickt womöglich erst auf den vermeintlichen Beweis und prüft später.
* **Keine konkrete Zuordnung:** Die fehlenden Buchungsdaten lassen sich angeblich bequem durch das Video ersetzen.

Hotels sind für solche Köder besonders geeignet: Beschwerden gehören zum Alltag, mehrere Personen bearbeiten gemeinsam ein Postfach und der Schutz des eigenen Rufs erzeugt zusätzlichen Zeitdruck. Der Link ist damit kein Fremdkörper, sondern wird als vermeintliches Beweismittel in eine plausible Arbeitssituation eingebaut.

## Der Google-Trick im Link 🔗

Auf den ersten Blick steht dort Google. Entscheidend ist jedoch der genaue Aufbau:

```text
https://www.google.com/share.google?q=CBquCspYGOEiQpNOU
        └───────┘ └───────────┘ └──────────────────────┘
          Domain       Pfad              Parameter
```

Die tatsächliche Domain ist `www.google.com`. Der Text `share.google` steht hier nur **hinter dem ersten Schrägstrich im Pfad** und ist keine zweite Domain. Google verwendet `share.google` zwar tatsächlich für Kurzlinks; laut der [offiziellen Google-Hilfe](https://support.google.com/websearch/answer/118238?co=GENIE.Platform%3DDesktop&hl=de) beginnen solche Freigabelinks jedoch mit `https://share.google/`.

Das macht den Link besonders tückisch: Er führt zunächst wirklich zu Google und kann dadurch bei einer oberflächlichen Prüfung seriös wirken. Google dient in diesem Fall aber lediglich als Weiterleitungsstation zum eigentlichen Ziel.

## Wohin der Link wirklich führt

Wir haben ausschließlich die HTTP-Weiterleitungen abgerufen und keine Skripte der Zielseite ausgeführt. Am **27. September 2026** antwortete Google mit dem Statuscode `301` und leitete auf folgende Adresse weiter:

```text
hxxps://guest-information-5661939311[.]com/v
```

Der Name soll offenbar noch einmal zum Hotelthema passen: „guest information“ klingt nach Gästeinformationen, hat mit Google aber nichts zu tun. Die öffentliche [RDAP-Auskunft für die Domain](https://rdap.verisign.com/com/v1/domain/guest-information-5661939311.com) zeigt als Registrierungsdatum den **24. September 2026**. Die Domain war beim Versand damit gerade einmal drei Tage alt.

Bei unserer Prüfung lieferte das Ziel nur noch den HTTP-Status `404 Not Found`. Das ist keine Entwarnung. Nach Angaben der Quelle, von der wir die Mail erhalten haben, führte die Weiterleitung zuvor zum Download eines **ZIP-Archivs mit Malware**. Inzwischen wurde die Datei offenbar entfernt oder der Pfad deaktiviert.

Uns liegt das ursprüngliche ZIP-Archiv selbst nicht vor. Deshalb können wir Dateiname, Prüfsumme, enthaltene Dateien und Malware-Familie nicht unabhängig bestimmen. Belegt sind die Weiterleitung auf die fremde Domain, deren junges Registrierungsdatum und der zum Prüfzeitpunkt nicht mehr erreichbare Pfad. Die Einordnung des früher ausgelieferten Archivs als Malware stammt von unserer Quelle.

## Auch der Absender passt nicht zur Geschichte

„Frieda“ schreibt von `gijutsu@k-koken.jp`, also unter einer japanischen Domain. Ein Bezug zu einem Hotelaufenthalt oder zur Identität der angeblichen Gästin ist in der Nachricht nicht erkennbar.

Allein daraus folgt allerdings nicht, dass der Domaininhaber hinter der Kampagne steckt. Die Absenderadresse kann gefälscht sein oder ein echtes Postfach kann missbraucht worden sein. Ohne vollständige Mailheader lässt sich das nicht sauber unterscheiden. Sicher ist nur: Der sichtbare Absender liefert keinen plausiblen Beleg für die behauptete Beschwerde.

## Das angebliche Video kommt als Malware-ZIP 📦🦠

Der Köder soll den Empfänger nicht nur auf die fremde Seite locken, sondern zum Herunterladen und Öffnen des ZIP-Archivs bewegen. Die Verpackung passt perfekt zur Geschichte: Wer ein Beweisvideo erwartet, hält eine komprimierte Datei womöglich für einen gewöhnlichen Video-Download und öffnet sie ohne die sonst übliche Vorsicht.

Ein ZIP-Archiv führt Schadcode nicht von allein aus. Gefährlich wird es, wenn der Empfänger den Inhalt entpackt und die darin enthaltene Datei startet. Gerade unter Windows können doppelte Dateiendungen, versteckte bekannte Erweiterungen oder ein Video-Symbol eine ausführbare Datei harmloser erscheinen lassen, als sie ist.

Welche Datei in diesem konkreten Archiv steckte und welche Funktionen die Malware hatte, lässt sich ohne das Sample nicht seriös sagen. Wer aus einem inzwischen toten Link gleich eine konkrete Malware-Familie herausliest, betreibt eher Kaffeesatzanalyse als IT-Forensik. ☕🔬

## So sollten Hotels und Unternehmen reagieren

Wer eine solche Beschwerde erhält, sollte den Vorwurf ernst nehmen, aber den mitgelieferten Link nicht unüberlegt öffnen:

1. Buchungsnummer, Aufenthaltsdatum, Zimmernummer und vollständigen Namen über einen bekannten Kommunikationsweg erfragen.
2. Im Buchungs- oder CRM-System prüfen, ob sich der Absender einem echten Aufenthalt zuordnen lässt.
3. Mit der Maus über den Link fahren oder die Adresse als Text untersuchen, ohne sie aufzurufen.
4. Verdächtige Links durch die eigene IT oder in einer isolierten Analyseumgebung prüfen lassen.
5. Die Nachricht samt vollständiger Header an die IT-Sicherheitsstelle melden und nach weiteren Empfängern im Unternehmen suchen.

Wer den Link bereits geöffnet hat und nur eine Fehlerseite sah, sollte den Vorfall trotzdem der IT melden. Ein heruntergeladenes ZIP-Archiv darf keinesfalls auf dem Arbeitsplatzrechner geöffnet oder sein Inhalt gestartet werden; die Datei sollte stattdessen der IT-Sicherheitsstelle zur isolierten Analyse übergeben werden.

Wurde eine Datei aus dem Archiv bereits ausgeführt, ist das Gerät als potenziell kompromittiert zu behandeln: Netzwerkverbindung trennen, IT oder Incident Response informieren und Passwörter von einem sauberen Gerät ändern. Das bloße Löschen des ZIP-Archivs genügt dann nicht.

## Fazit: Große Empörung, kleines Zeitfenster, fremde Domain

Die Mail ist sauber auf den Hotelalltag zugeschnitten: ein schwerer Vorwurf, drohender Reputationsschaden, hohe Priorität und ein angebliches Beweisvideo. Der Empfänger soll reagieren, bevor er bemerkt, dass weder Buchungsdaten noch ein nachvollziehbarer Absender vorhanden sind.

Besonders raffiniert ist der Link. Er beginnt tatsächlich bei `www.google.com`, endet nach der Weiterleitung aber auf einer drei Tage alten Domain namens `guest-information-5661939311.com`. Dort wartete laut unserer Quelle kein Beschwerdevideo, sondern ein ZIP-Archiv mit Malware. Ein bekannter Name am Anfang einer Linkkette macht weder deren Ziel noch den dort angebotenen Download vertrauenswürdig.

„Frieda“ wollte eine schnelle Stellungnahme. Unsere fällt knapp aus: **Keine Buchungsnummer, kein überprüfbarer Vorfall und kein Video – dafür eine brandneue Domain und Malware im ZIP-Archiv. Nicht klicken, nicht entpacken, nicht ausführen.** 🦦🚫
