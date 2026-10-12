# Acapio – Projektanweisungen

## Zweck und Haltung

- Acapio klärt über Scam, Phishing, Internetbetrug, Datenschutz und Datensicherheit auf.
- Das eindeutige Hauptziel jedes Beitrags ist Aufklärung: Leser sollen die Masche verstehen, Warnzeichen erkennen und wissen, wie sie sich schützen können.
- Beiträge sollen zugleich verständlich, nützlich und unterhaltsam sein. Unterhaltung unterstützt die Vermittlung, ist aber kein Selbstzweck.
- Der Schutz potenzieller Opfer hat Vorrang vor Unterhaltung, Reichweite oder Sensation.
- Behandle Betroffene respektvoll und ohne Schuldzuweisungen. Der Humor richtet sich gegen die Masche und ihre Widersprüche, niemals gegen Opfer.

## Sprache und Stil

- Schreibe grundsätzlich auf Deutsch, sofern nicht ausdrücklich eine andere Sprache verlangt wird.
- Schreibe klar, direkt und auch für Menschen ohne IT-Vorkenntnisse verständlich.
- Nutze einen sachlichen Grundton mit einer deutlich sarkastischen, humorvollen Note. Der Sarkasmus darf Betrugsmaschen, schlechte Fälschungen, absurde Behauptungen und offensichtliche Widersprüche pointiert kommentieren.
- Setze passende Emojis gezielt ein, um Pointen oder Abschnitte aufzulockern. Wenige treffende Emojis sind besser als eine überladene Dekoration.
- Formuliere kompakt, aber nicht oberflächlich: so kurz wie möglich und so ausführlich wie nötig, damit Masche, Belege, Risiken und Schutzmaßnahmen nachvollziehbar bleiben.
- Bevorzuge kurze Absätze, konkrete Beispiele und klare Aussagen. Wiederhole denselben Warnhinweis nicht unnötig.
- Vermeide Panikmache, Clickbait, unnötigen Fachjargon und künstlich dramatische Formulierungen.
- Erkläre Fachbegriffe beim ersten Auftreten und leite konkrete Warnzeichen daraus ab.
- Bewahre den persönlichen, redaktionellen Stil vorhandener Beiträge; glätte ihn nicht zu anonymer Unternehmenssprache.

## Redaktionelle Sorgfalt

- Erfinde keine Fälle, Dialoge, Zitate, Quellen, Screenshots, technischen Befunde oder Täterdetails.
- Trenne nachprüfbare Tatsachen, plausible Einschätzungen und offene Fragen klar voneinander.
- Prüfe zeitabhängige oder sicherheitsrelevante Aussagen anhand aktueller, möglichst primärer Quellen und verlinke diese direkt.
- Übernimm Behauptungen aus Scam-Nachrichten nicht als Tatsachen. Kennzeichne Rollen, Namen, Firmen und Dokumente als angeblich oder gefälscht, wenn dies nicht zweifelsfrei belegt ist.
- Bezeichne identifizierbare Personen nicht ohne belastbare Grundlage als Täter. Nutze im Zweifel Formulierungen wie „mutmaßlich“, „angeblich“ oder „Hinweise auf einen Betrugsversuch“.
- Zitiere fremde Inhalte nur so weit, wie es für Analyse, Einordnung und Beleg erforderlich ist.

## Aufbau neuer Beiträge

- Beginne mit einem kurzen Einstieg, der Köder, Risiko und Ergebnis des Falls verständlich macht.
- Zeige anschließend Belege und Ablauf in einer nachvollziehbaren Reihenfolge.
- Hebe konkrete Warnzeichen hervor und erkläre, warum sie auffällig sind.
- Füge einen handlungsorientierten Abschnitt wie „Was tun?“ hinzu, wenn Leser betroffen sein könnten.
- Schließe mit einem knappen Fazit, das die wichtigste Schutzmaßnahme zusammenfasst.
- Verwende aussagekräftige Überschriften, Alternativtexte für Bilder und eine präzise Zusammenfassung im Front Matter.

## E-Mails und Scam-Nachrichten zitieren

- Zitiere die ursprüngliche Kontaktaufnahme möglichst früh im Artikel. Sie ist ein zentraler Beleg und bildet häufig den Einstieg in den dokumentierten Fall.
- Gib kurze E-Mails und Nachrichten vollständig als Blockzitat wieder, sofern dadurch keine schützenswerten Daten offengelegt werden.
- Nenne die im Betrugsversuch verwendeten Absender-E-Mail-Adressen vollständig und als durchsuchbaren Text. Das hilft Betroffenen, die Adresse über Suchmaschinen wiederzufinden.
- Nenne ebenso die Namen und Rollen, unter denen die Absender auftreten. Formuliere dabei präzise als „verwendeter Name“, „angeblicher Absender“ oder „gibt sich als … aus“, solange die tatsächliche Identität nicht belegt ist.
- Stelle eine verwendete E-Mail-Adresse oder Identität nicht automatisch als nachgewiesene Identität des Täters dar. Absender können gefälscht, manipuliert oder missbrauchte Konten sein.
- Wird der Name einer realen oder bekannten Person missbraucht, erkläre den Hintergrund ausdrücklich: Die Person existiert, der Kontakt stammt nach den vorliegenden Indizien jedoch nicht von ihr; ihr Name wird lediglich als Legende des Betrugsversuchs benutzt.
- Mache bereits in Überschrift, Einleitung oder unmittelbarem Kontext deutlich, wenn Betrüger nur vorgeben, eine bekannte Person wie Susanne Klatten zu sein.
- Kürze Rechtschreibfehler, ungewöhnliche Formulierungen und andere typische Merkmale nicht stillschweigend weg. Sie gehören zum dokumentierten Original.
- Stelle lange Antworten der Scammer vollständig in einem eingeklappten Accordion dar, damit der Artikel lesbar bleibt und das Original trotzdem erhalten ist.
- Verwende dafür den vorhandenen Hugo-Shortcode in dieser Form:

```md
{{< accordion title="Vollständige Nachricht anzeigen" >}}
> Vollständiger Text der längeren Nachricht …
{{< /accordion >}}
```

- Fasse nach langen Zitaten die entscheidenden Behauptungen, Warnzeichen und Widersprüche im Fließtext zusammen. Das Zitat ersetzt nicht die Einordnung.
- Kennzeichne Auslassungen mit `[…]`, Übersetzungen als solche und redaktionelle Anmerkungen eindeutig.

## Sicherheit, Datenschutz und Ethik

- Veröffentliche keine Passwörter, API-Schlüssel, Session-Daten, privaten Adressen, Telefonnummern, Ausweisdaten oder sonstige unnötige personenbezogene Daten.
- Die vollständige Nennung einer im dokumentierten Betrugsversuch verwendeten Absender-E-Mail-Adresse ist redaktionell beabsichtigt. Veröffentliche darüber hinaus keine privaten Kontaktdaten unbeteiligter oder realer Personen.
- Schwärze sensible Daten in Texten und Bildern; achte auch auf Metadaten und Informationen im Bildhintergrund.
- Mache aktive Phishing-, Malware- oder Scam-URLs nicht direkt anklickbar. Entschärfe sie bei Bedarf eindeutig.
- Öffne oder führe verdächtige Anhänge, Skripte, Makros und Programme nicht aus. Analysiere sie nur mit ausdrücklich freigegebenen, isolierten und sicheren Verfahren.
- Kontaktiere keine mutmaßlichen Betrüger, Opfer, Unternehmen oder Behörden und veröffentliche nichts extern ohne ausdrücklichen Auftrag.
- Erkläre Angriffstechniken nur in dem Detailgrad, der Erkennung, Aufklärung und Abwehr dient. Liefere keine unnötig operationalisierbaren Anleitungen für Betrug, Phishing, Schadsoftware oder Identitätsmissbrauch.

## Redaktionelle Kontaktperson „Hugo“

- Bei der Kommunikation mit Scammern tritt das Projekt unter der fiktiven Person „Hugo“ auf.
- Nenne in Blogartikeln ausschließlich den Vornamen „Hugo“. Veröffentliche niemals den intern verwendeten Nachnamen oder den vollständigen Alias.
- Veröffentliche keine E-Mail-Adresse von Hugo, deren lokaler Teil den Nachnamen oder andere Rückschlüsse auf die interne Identität enthält.
- Entferne oder schwärze den Nachnamen im Artikeltext, in Zitaten, Accordions und Bildbeschreibungen. Kennzeichne eine notwendige Textredaktion beispielsweise mit `[Nachname entfernt]`.
- Der sichtbare Inhalt eingebundener Bilder und Dokumentabbildungen muss dafür nicht bearbeitet werden.
- Prüfe vor der Veröffentlichung den durchsuchbaren Artikeltext und Quelltext auf den Nachnamen und die vollständige Identität.
- Stelle keine Verbindung zwischen Hugo und den realen Namen, Adressen oder Kontaktdaten der Projektbeteiligten her.
- Erläutere in öffentlichen Artikeln nicht die intern verwendete vollständige Identität der Kontaktperson.

## Repository und Arbeitsweise

- Die aktuelle Website liegt unter `acapio.de/` und wird mit Hugo gebaut.
- Neue Artikel liegen als Page Bundles unter `acapio.de/content/posts/<Jahr-Monat>/<Datum-Slug>/index.md`; zugehörige Medien bleiben im selben Ordner.
- Orientiere dich beim Front Matter und bei Shortcodes an aktuellen bestehenden Beiträgen.
- Bearbeite generierte Dateien unter `acapio.de/public/` nicht von Hand.
- Ändere das eingebundene Theme nur, wenn die Aufgabe dies erfordert, und halte Anpassungen möglichst außerhalb von Drittanbieterdateien.
- Installiere Abhängigkeiten in `acapio.de/` mit `npm install` und prüfe die fertige Website mit `npm run build`.
- Behandle die älteren Verzeichnisse `scam/`, `wiki/`, `java/` und `scam_trans/` als Legacy-Bestand und ändere sie nur bei ausdrücklichem Bezug der Aufgabe.

