---
title: "Vorsicht vor Phishing: Gefälschte E-Mails im Namen von Miles & More"
params:
  author: Andy
date: "2025-01-19"
featured: true
toc: true
tags: 
  -  "pishing"
categories:
    - "Phishing"
thumbnail: "creditcard.webp"
url: "posts/2025-01-19_miles-and-more"
summary: "Schützen Sie sich vor Betrug! Gefälschte E-Mails im Namen von Miles & More versuchen, an Ihre persönlichen Daten zu gelangen. Erfahren Sie, wie Sie Phishing-Versuche erkennen und sicher handeln."
---

Phishing-Mails sind eine der häufigsten Betrugsmethoden, um an persönliche Daten wie Zugangsdaten oder Kreditkarteninformationen zu gelangen. 

Aktuell werden E-Mails verbreitet, die vorgeben, von Miles & More zu stammen. In der Nachricht werden Empfänger aufgefordert, ihre Daten über einen vermeintlich sicheren Link zu aktualisieren.

## Die Phishing-Mail

Die Mail gibt sich im üblichen Ton, mal wieder sollten wir unsere Kreditkarte aktualisieren.

> Sehr geehrte Kundinnen und Kunden,  
>   
> Um weiterhin die Sicherheit und den bestmöglichen Service für unsere Miles & More Kreditkarten zu gewährleisten, bitten wir Sie, Ihre Daten zu überprüfen und bei Bedarf zu aktualisieren.  
>   
> Klicken Sie einfach auf den folgenden sicheren Link und folgen Sie den Anweisungen, um Ihre Daten schnell und sicher zu aktualisieren  

Mit geschulten Blick erkennen wir, dass geschludert wurde. So ist das Logo nicht ganz passend und irgendwie wirkt alles billig.

![Die E-Mail](/posts/2025-01-19_miles-and-more/miles.webp)

## Die Umleitung, für Linux und Windows Nutzer unterschiedlich

Natürlich wollen wir herausfinden, was hinter der vermeintlichen Phishing-Mail steckt. Mit einer Portion Neugier öffnen wir den angegebenen Link – selbstverständlich in einer isolierten Linux-VM – und staunen nicht schlecht: Statt auf einer Phishing-Seite landen wir direkt auf der offiziellen Login-Seite von Miles & More! 

Die offizielle URL: [https://miles-and-more.kartenabrechnung.de](https://miles-and-more.kartenabrechnung.de)

Doch die Überraschung bleibt nicht lange aus. Als wir denselben Link auf einem Windows-System öffnen, zeigt sich ein völlig anderes Bild: Dieses Mal landen wir auf einer verdächtigen Seite mit der URL: https://miles-and-more-kundenservice-de.com.

Die Betrüger sind offenbar clever genug, das verwendete Betriebssystem zu erkennen. Linux-Nutzer werden auf die echte Seite umgeleitet – vermutlich, weil sie oft als technisch versierter gelten und den Link möglicherweise nur zur Analyse anklicken. Windows-Anwender hingegen, die als primäre Zielgruppe für solche Angriffe gelten, landen direkt in der Falle. Ein weiterer Trick, der zeigt, wie ausgeklügelt Phishing-Angriffe inzwischen sein können.

## Meldung an den Provider

Wir melden das noch an den Provider, vielleicht sperrt er ja die Seite. Aber wirklich glauben wir nicht dran.

## Fazit

Wie immer gilt, solche Mails direkt löschen und die Seite immer direkt über den Browser öffnen und keine Links direkt anklicken.

