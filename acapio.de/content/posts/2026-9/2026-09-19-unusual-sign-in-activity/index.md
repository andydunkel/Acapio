---
title: "Unusual sign-in activity: Gefälschte Sicherheitswarnung führt zum Passwortklau"
params:
  author: Andy
date: "2026-09-19"
featured: true
toc: true
tags:
  - "Phishing"
  - "Unusual sign-in activity"
  - "Passwortdiebstahl"
  - "Gefälschte Sicherheitswarnung"
categories:
  - "Phishing"
thumbnail: "phishing.webp"
url: "posts/2026-09-19-unusual-sign-in-activity"
summary: "Eine angebliche Warnung über eine ungewöhnliche Anmeldung aus den USA führt nicht zur Kontoübersicht, sondern zu einer personalisierten Phishing-Seite im Look von ekiwi.de."
---

Eine Anmeldung aus den USA, ein unbekannter Windows-Rechner und ein verdächtig genauer Zeitstempel: Mit einer angeblichen **„Unusual sign-in activity“** will uns eine E-Mail zum schnellen Sicherheitscheck bewegen. Das klingt vernünftig – wäre der angebotene Check nicht selbst die Gefahr.

Der Button **„Review recent activity“** führt nicht zur echten Kontoverwaltung, sondern zu einer personalisierten Phishing-Seite. Dort wartet bereits unsere E-Mail-Adresse, eingebettet in den vertrauten Auftritt von [eKiwi.de](https://ekiwi.de/). Was könnte seriöser sein als eine Webseite, die sich selbst im Hintergrund zeigt? Nun ja: fast alles. 🎭

## Die angebliche Warnung über eine ungewöhnliche Anmeldung

![Phishing-Mail mit dem Betreff Unusual sign-in activity und angeblichen Anmeldedaten aus den USA](/posts/2026-09-19-unusual-sign-in-activity/mail_1.webp)

Die Nachricht meldet eine angebliche Anmeldung für ein teilweise verdecktes Konto bei `ekiwi.de`. Als Herkunft werden die USA, die IP-Adresse `11.20.66.123`, Windows und Chrome genannt. Der Text der E-Mail lautet:

> **Unusual sign-in activity**
>
> We detected something unusual about a recent sign-in to the account  
> `********@ekiwi.de`.
>
> **Sign-in details**  
> Country/region: United States  
> IP address: 11.20.66.123  
> Date: 18/09/2026 06:56 (GMT)  
> Platform: Windows  
> Browser: Chrome
>
> Please go to your recent activity page to let us know whether or not this was you. If this wasn't you, we'll help you secure your account. If this was you, we'll trust similar activity in the future.
>
> **Review recent activity**
>
> To opt out or change where you receive security notifications, click here.
>
> Thanks,  
> ekiwi.de Account Team

Der Aufbau ist geschickt gewählt. Konkrete Angaben erwecken den Eindruck, hier habe ein Sicherheitssystem tatsächlich einen Vorfall protokolliert. Gleichzeitig drängt die Aussicht auf einen fremden Kontozugriff zum Handeln. Der Empfänger soll zuerst klicken und erst später nachdenken.

## Warum die E-Mail verdächtig ist

Die Nachricht macht optisch einen ordentlichen Eindruck. Inhaltlich bleiben jedoch einige deutliche Warnzeichen:

* **Unerwartete Sicherheitsmeldung:** Eine Warnung über einen fremden Login erzeugt Angst und Zeitdruck – beides wird beim Phishing gezielt ausgenutzt.
* **Unpersönliche Ansprache:** Statt eines Namens wird lediglich eine maskierte E-Mail-Adresse gezeigt.
* **Fragwürdiger Absender:** Die Grußformel „ekiwi.de Account Team“ klingt offiziell, ist aber kein Beleg dafür, dass die Nachricht tatsächlich von ekiwi.de stammt.
* **Der Link entscheidet:** Absendername, Logos und Schaltflächen lassen sich leicht kopieren. Entscheidend ist, auf welche Domain der Button wirklich verweist.
* **Zweiter Köder:** Auch das unscheinbare „click here“ zum Ändern der Benachrichtigungen ist ein Link und sollte nicht ausprobiert werden.

Wer eine solche Warnung prüfen möchte, öffnet die bekannte Kontoseite **manuell über ein Lesezeichen oder eine selbst eingegebene Adresse**. Die Links in der verdächtigen Nachricht werden dafür nicht benötigt.

## Was nach dem Klick passiert

Für unsere Analyse haben wir den Link geöffnet. **Das sollte man im normalen Alltag nicht nachmachen.** Verdächtige Seiten können Daten über den Besucher erfassen, Downloads anstoßen oder mit weiteren Tricks arbeiten. Vor allem dürfen dort niemals Passwörter oder andere persönliche Daten eingegeben werden.

Statt einer Übersicht der letzten Kontoaktivitäten erscheint die echte eKiwi-Webseite nur als Kulisse. Darüber liegt ein fremdes Anmeldefenster mit Logo, Name und bereits bekannter E-Mail-Adresse.

![Personalisierte Phishing-Seite mit vorausgewähltem eKiwi-Konto vor der echten Website](/posts/2026-09-19-unusual-sign-in-activity/link_angeklickt_1.webp)

Die Maske fordert dazu auf, ein Konto auszuwählen. Das Konto „Andy.dunkel“ ist bereits markiert; zusätzlich wird ein blasser Eintrag „Admin“ angezeigt. Die E-Mail-Adresse wurde sehr wahrscheinlich aus dem individuellen Link übernommen. So entsteht der Eindruck, das System kenne den Benutzer bereits und gehöre deshalb zum Unternehmen.

Doch eine bekannte Adresse auf einer Webseite beweist lediglich, dass jemand diese Adresse kannte – und die Täter haben sie schon beim Versand der Mail besessen.

Nach einem Klick auf **„Continue“** folgt die eigentliche Falle:

![Gefälschte eKiwi-Anmeldemaske mit vorausgefüllter E-Mail-Adresse und Passwortfeld](/posts/2026-09-19-unusual-sign-in-activity/link_angeklickt_2.webp)

Unter „Welcome Back“ ist die E-Mail-Adresse bereits eingetragen. Nun soll nur noch das Passwort ergänzt werden. Hinweise wie **„256-bit SSL – Secured by Ekiwi“** sollen technische Sicherheit vorspielen. Eine solche Beschriftung ist jedoch nur Text und kann von jedem Seitenbetreiber eingefügt werden. Selbst eine verschlüsselte HTTPS-Verbindung würde lediglich die Verbindung zur Phishing-Seite absichern – nicht die Ehrlichkeit ihres Betreibers.

Auffällig ist außerdem die Anzeige **„Attempt 1/3“**. Sie deutet darauf hin, dass mehrere Eingaben vorgesehen sind. Solche Seiten erklären ein eingegebenes Passwort häufig absichtlich für falsch, damit das Opfer es erneut eintippt oder eine andere Passwortvariante ausprobiert. Damit erhalten die Täter mehrere mögliche Zugangsdaten und können zugleich Tippfehler aussortieren.

## Gleiche Phishing-Seite, anderer Köder

Die nachgebaute Anmeldemaske kennen wir bereits. In unserem Artikel über eine [gefälschte Docusign-Signaturanfrage](/posts/2026-09-11-docusign-phishing/) führte eine völlig andere E-Mail zur gleichen Art von personalisiertem Login: eKiwi-Webseite im Hintergrund, vorausgewählte Adresse und mehrere angebliche Anmeldeversuche.

Das zeigt den modularen Aufbau der Masche:

1. Eine beliebige Geschichte bringt das Opfer zum Klicken – hier der verdächtige Login, dort ausstehende Dokumente.
2. Die E-Mail-Adresse wird im Link an die Phishing-Seite übergeben.
3. Die Seite lädt den Auftritt der zur Adresse gehörenden Organisation als glaubwürdige Kulisse.
4. Eine darübergelegte Anmeldemaske sammelt die eingegebenen Passwörter ein.

Der Köder lässt sich austauschen, die Passwortfalle dahinter bleibt weitgehend gleich.

## Was tun, wenn der Link angeklickt wurde?

Wer die Seite nur geöffnet, **nichts eingegeben und nichts heruntergeladen** hat, sollte sie schließen und die E-Mail als Phishing melden. Anschließend sind ein aktueller Browser und ein Sicherheitscheck des Geräts sinnvoll. Ein bloßer Klick bedeutet nicht automatisch, dass das Konto übernommen wurde – der Seite sind aber zumindest übliche Verbindungsdaten wie die IP-Adresse und Browserinformationen bekannt geworden.

Wurde ein Passwort eingegeben, ist schnelles Handeln nötig:

1. **Passwort sofort auf der echten Website ändern.** Die Adresse selbst eintippen oder ein bekanntes Lesezeichen verwenden.
2. **Wiederverwendete Passwörter ersetzen.** Dasselbe oder ein ähnliches Kennwort muss auch bei allen anderen Diensten geändert werden.
3. **Zwei-Faktor-Authentisierung aktivieren.** Sie bietet eine zusätzliche Hürde, falls das Passwort bereits bei den Tätern liegt.
4. **Unbekannte Sitzungen abmelden.** In den Kontoeinstellungen alle Geräte und aktiven Anmeldungen kontrollieren.
5. **Postfachregeln prüfen.** Unbekannte Weiterleitungen, Filter und Wiederherstellungsadressen können auf einen bereits erfolgten Zugriff hindeuten.
6. **Bei Firmenkonten die IT informieren.** Administratoren können Zugriffe prüfen, Sitzungen widerrufen und weitere betroffene Konten schützen.

## Fazit

Die angebliche **„Unusual sign-in activity“** warnt nicht vor dem Phishing – sie ist das Phishing. Die präzisen Login-Daten in der Mail sollen Seriosität erzeugen, während die personalisierte Folgeseite mit der echten eKiwi-Webseite im Hintergrund Vertrautheit simuliert.

Wer einen fremden Login gemeldet bekommt, sollte die Warnung durchaus ernst nehmen – aber unabhängig überprüfen. Konto oder Anbieter direkt aufrufen, dort die letzten Aktivitäten kontrollieren und niemals das Passwort in eine Seite eingeben, die über den Link einer unerwarteten Mail geöffnet wurde. **Die beste Reaktion auf „Review recent activity“ ist in diesem Fall: erst die Adresse prüfen, dann gar nicht klicken.**
