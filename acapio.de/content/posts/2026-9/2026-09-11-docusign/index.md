---
title: "Docusign-Phishing: Gefälschte Signaturanfrage stiehlt Passwörter"
params:
  author: Andy
date: "2026-09-11"
featured: true
toc: true
tags:
  - "Phishing"
  - "Docusign"
  - "Passwortdiebstahl"
categories:
  - "Phishing"
thumbnail: "phishing.webp"
url: "posts/2026-09-11-docusign-phishing"
summary: "Eine täuschend echte Docusign-Mail fordert zur Unterschrift zweier Dokumente auf. Der Link führt jedoch zu einer personalisierten Phishing-Seite, die das Passwort gleich dreimal abfragt."
---

Eine angebliche **Docusign-Mail** kündigt zwei Dokumente an, die dringend unterschrieben werden müssen. Absender, Dateinamen, Frist und Umschlag-ID lassen die Nachricht auf den ersten Blick erstaunlich glaubwürdig wirken. Hinter dem gelben Button wartet jedoch kein digitaler Vertrag, sondern eine raffinierte **Phishing-Seite zum Diebstahl von Zugangsdaten**.

Wir zeigen, woran sich diese gefälschte Docusign-E-Mail erkennen lässt und was nach dem Klick auf den Link passiert.

## Die gefälschte Docusign-Mail

![Gefälschte Docusign-Mail mit der Aufforderung, zwei Dokumente zu unterschreiben](/posts/2026-09-11-docusign-phishing/mail.webp)

Der Betreff der E-Mail lautet:

> Please Sign: Documents Ready for Completion (SOA and Payment Analysis 2026 Q4 _ andy.dunkel.pdf)

Im Namen von „James Ashton“ aus der Finanzabteilung sollen zwei angeblich über Docusign verschickte Dateien zur Unterschrift bereitliegen:

> **ACTION REQUIRED**  
> Complete with DocuSign:  
> 2 documents awaiting your signature
>
> **Q4 2026 SOA**  
> SOA – Q4 2026.pdf · 4 pages · 1.6 MB
>
> **Q4 2026 Payment Analysis**  
> Payment Analysis – Q4 2026.xlsx · 12 pages · 3.1 MB

Zusätzliche Angaben wie die vermeintliche Envelope ID `4F7B2E91-6A3D-4C08-9B54-1E82A7D09F33`, eine Versandzeit und die Frist bis zum 25. September sollen Vertrauen schaffen. Gleichzeitig erzeugt der Hinweis „ACTION REQUIRED“ Zeitdruck. Der Empfänger soll möglichst schnell auf **„REVIEW & SIGN DOCUMENTS“** klicken, ohne die Zieladresse genauer zu prüfen.

## Woran erkennt man das Docusign-Phishing?

Spätestens ein Blick auf das tatsächliche Linkziel entlarvt die Nachricht. Der Button führt nicht zu einer offiziellen Docusign-Domain, sondern zu einer langen Adresse unter:

`gatewaypie.com`

Am Ende der URL befindet sich außerdem die E-Mail-Adresse des Empfängers als Parameter, beispielsweise:

`?e=andy.dunkel@ekiwi.de`

Der Link ist also personalisiert. Die Phishing-Seite weiß dadurch schon vor der ersten Eingabe, welche Adresse zum Besucher gehört. Das erklärt, warum später ein scheinbar passendes Benutzerkonto angezeigt wird – und macht die Seite glaubwürdiger.

Weitere Warnzeichen sind:

* **Fremde Domain:** Die Adresse gehört nicht zu Docusign.
* **Ungewöhnlicher Betreff:** Der Betreff enthält neben Dokumentnamen auch die E-Mail-Adresse beziehungsweise den Namen des Empfängers.
* **Künstliche Dringlichkeit:** Zwei Dokumente sollen innerhalb einer festen Frist unterschrieben werden.
* **Unerwartete Unterlagen:** Wer weder eine Abrechnung noch eine Zahlungsanalyse erwartet, sollte besonders misstrauisch sein.
* **Vorgeblicher interner Absender:** Ein bekannter Name oder eine vertraute Absenderadresse ist kein Echtheitsbeweis. Absenderangaben können gefälscht oder Konten missbraucht werden.

## Die Masche: Kopierte Website statt Docusign-Dokument

Nach dem Klick erscheint nicht die erwartete Docusign-Ansicht. Stattdessen legt sich ein Anmeldefenster über eine im Hintergrund angezeigte Website. In unserem Fall wurde sogar die Website von eKiwi eingeblendet und das dazugehörige Logo in den Dialog übernommen.

![Personalisierte Phishing-Seite mit vorausgewähltem E-Mail-Konto](/posts/2026-09-11-docusign-phishing/phishing_1.webp)

Zunächst soll das bereits erkannte Konto ausgewählt werden. Name, E-Mail-Adresse, Logo und Website im Hintergrund vermitteln den Eindruck eines unternehmenseigenen Anmeldeportals. Tatsächlich wird die fremde Seite nur als Kulisse benutzt. Die eigentliche Anmeldemaske stammt von den Angreifern.

Im nächsten Schritt ist die E-Mail-Adresse bereits eingetragen. Jetzt fehlt angeblich nur noch das Passwort.

![Gefälschte Anmeldemaske zur Eingabe des E-Mail-Passworts](/posts/2026-09-11-docusign-phishing/phishing_2.webp)

Besonders perfide: Das eingegebene Kennwort wird immer wieder als falsch zurückgewiesen. Die Maske fordert insgesamt **drei Passworteingaben** und zeigt dabei sogar „Versuch 1/3“ an. Das ist keine echte Passwortprüfung. Die wiederholte Abfrage hilft den Kriminellen vielmehr dabei, Tippfehler auszuschließen oder mehrere Passwörter abzugreifen, falls das Opfer verschiedene Varianten ausprobiert.

Die Zugangsdaten werden dabei im Hintergrund an die Betreiber der Phishing-Seite übertragen. Ein erfolgreicher Login kann auf dieser gefälschten Maske deshalb gar nicht stattfinden. Die Fehlermeldung ist Teil der Inszenierung.

## Was tun, wenn das Passwort eingegeben wurde?

Wer auf einer solchen Seite Zugangsdaten eingegeben hat, sollte sofort handeln:

1. **Passwort über die echte Website ändern:** Die Anmeldeseite selbst über ein Lesezeichen oder durch manuelle Eingabe der bekannten Adresse öffnen – niemals über den Link aus der E-Mail.
2. **Dasselbe Passwort überall ersetzen:** Wurde es auch bei anderen Diensten verwendet, müssen diese Zugänge ebenfalls geändert werden.
3. **Zwei-Faktor-Authentisierung aktivieren:** Ein zweiter Faktor erschwert den Missbrauch eines gestohlenen Passworts erheblich.
4. **Aktive Sitzungen abmelden:** In den Kontoeinstellungen alle unbekannten Geräte und Sitzungen beenden.
5. **Weiterleitungen und Regeln prüfen:** Angreifer richten in kompromittierten Postfächern häufig unauffällige Weiterleitungs- oder Löschregeln ein.
6. **IT oder Administrator informieren:** Bei einem Firmenkonto sollte die zuständige Stelle den Vorfall untersuchen und mögliche Zugriffe sperren.

Auch wenn nur auf den Link geklickt, aber nichts eingegeben wurde, sollte die Seite geschlossen und die E-Mail als Phishing gemeldet werden. Anhänge oder Downloads von der Seite dürfen nicht geöffnet werden.

## Fazit: Nicht das Docusign-Logo, sondern die Domain entscheidet

Diese Docusign-Phishing-Mail ist überzeugender als viele gewöhnliche Spam-Nachrichten. Sie kombiniert eine professionell gestaltete Signaturanfrage mit konkreten Dateinamen, einer Frist, einem vermeintlich internen Absender und einer personalisierten Anmeldeseite. Im Hintergrund wird sogar die Website des betroffenen Unternehmens als Kulisse geladen.

Der wichtigste Hinweis steht dennoch offen in der Adresszeile: Der Link führt weder zu Docusign noch zu einem bekannten Anmeldedienst. Wer eine Signaturanfrage nicht erwartet, sollte den Absender über einen unabhängigen Kanal kontaktieren und das Dokument ausschließlich über die offizielle Docusign-Website beziehungsweise die bekannte Anwendung öffnen.

Und spätestens wenn ein Passwort dreimal hintereinander „falsch“ sein soll, gilt: **Nicht weiterprobieren, Seite schließen und das betroffene Kennwort sofort ändern.**
