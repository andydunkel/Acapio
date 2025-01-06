---
title: "Vorsicht vor gefälschten Camtasia-Angeboten: Malware-Betrug"
params:
  author: Andy
date: "2024-12-29"
featured: true
toc: true
tags: 
  -  "scam"
  -  "phishing"
  -  "malware"
categories:
    - "Phishing"
    - "Malware"
thumbnail: "fraud.webp"
url: "posts/2024-12-29_camtasia_scam"
summary: "Eine betrügerische E-Mail, die vorgibt, von Camtasia zu stammen, zielt darauf ab, Nutzer mit falschen Werbekooperationen zu ködern. Allerdings versuchen die Betrüger wahrscheinlich, Malware über schädliche Links oder Anhänge zu verbreiten."
---

Eine betrügerische E-Mail, die vorgibt, von "Camtasia" zu stammen, zielt darauf ab, Nutzer mit falschen Werbekooperationen zu ködern. Allerdings versuchen die Betrüger wahrscheinlich, Malware über schädliche Links oder Anhänge zu verbreiten.

## Die E-Mail

> Greetings!
> 
> I am a Camtasia advertising representative, and our company would like to work with you.
> 
> Say a little about our company. Camtasia is a screen capture software. The user defines the area of the screen or window to be captured and sets the recording parameters before it starts. Camtasia Studio allows the user to record sound from a microphone or speakers, and place video footage from a webcam on the screen.
> 
> We hope you are interested - email us if you need more information.
> 
> Camtasia.
> bpsqb8snzmeu708m

## Unsere Antwort

Wir geben uns mal halbwegs seriös:

> Dear Camtasia Team,  
> 
> Thank you for reaching out! We are very interested in partnering with such a well-known brand. Please let us know more details about the collaboration and what the next steps would be.  
> 
> Looking forward to hearing from you!  
> 
> Best regards,  

## Wir bekommen einen Download-Link

Die Antwort lässt nicht lange auf sich warten. Geld wird versprochen, nicht gerade wenig. Selbst für unseren kleinen Kanal sind bis zu 5000 Dollar drin, für ein paar Sekunden Werbung. Für Windows und den Mac gibt es noch Promo-Material, welches wir uns anschauen sollen.

> Thank you for your interest in collaborating with PicsArt. We appreciate you considering this partnership.
> 
> We are proposing the integration of a pre-produced 20-60 second video advertisement for PicsArt into your content. Here are the key details of our proposal:
> 
> 1. Compensation: The fee for integrating the 20-60 second video ranges from $835 to $5,260, depending on your projected viewership. If your assessment of ad inventory value exceeds $5,260, please share your pricing proposal for our consideration. Complete payment terms will be detailed in the formal contract.
> 
> 2. Confidentiality: Strict confidentiality is required. Distribution of this agreement to third parties is strictly prohibited.
> 
> 3. Placement: The PicsArt video advertisement will be prominently featured at the beginning or mid-point of your video. The precise placement will be specified and agreed upon in the contract.
> 
> 4. Payment Schedule: Upon contract signing, we will remit up to 50% of the agreed-upon fee as a prepayment to your designated account or e-wallet.
> 
> Exclusive Offer: As a thank you for your partnership, we are pleased to offer a complimentary premium PicsArt activation key, compatible with iOS, Android, and Windows operating systems.
> 
> Next Steps:
> 
> Please review the advertising materials and contract:
> 
> Windows Materials: https://promoofficial.com/PicsArt Materials for Windows and MacOs (Password: 2024)
> Advertising Agreement: Please download, complete the required fields, and electronically sign the PicsArt campaign advertising agreement. Return the signed agreement for our approval.
> 
> Upon mutual agreement and signature, we will provide you with a final approved contract and forward your details to our accounting department.
> 
> We look forward to a successful partnership.
> 
> Sincerely,
> 
> The PicsArt Team

### Download und Malware

Wir starten die virtuelle Linux-Maschine. Auf gar keinen Fall, sollte der Link in Windows oder dem Mac direkt angeklickt werden. Der Download ist eine passwortgeschützte ZIP-Datei. Die Masche ist alt, der Passwortschutz verschlüsselt die Datei, so dass ein Virenscanner die Inhalte nicht scannen kann und möglicherweise Alarm schlägt.

![ZIP-Datei mit Inhalt](/posts/2024-12-29_camtasia_scam/download_1.webp)

Wir entpacken alles und freuen uns, dass sich hier jemand richtig Mühe gegeben hat, sogar kein paar Beispiel-Videos sind enthalten. Alles bezieht sich auf den echten Dienst "PicsArt", von Camtasia ist keine Rede mehr.

![Beispiel Videos sind enthalten](/posts/2024-12-29_camtasia_scam/download_2.webp)

Spannend wird es im Ordner für den Mac und für Windows. Windows-Nutzer bekommen eine .exe Datei, welche sie nur zu starten brauchen. Für den Mac muss eine .dmg Datei installiert werden, eine Anleitung hilft hier.

![Ausführbare Programme für Windows und Mac](/posts/2024-12-29_camtasia_scam/download_3.png)

Wer die Programme startet hat ein Problem. Die Malware wird ausgeführt und das System infiziert. Wir machen einen [Virenscheck mit Virus-Total](https://ekiwi-blog.de/22006/dateien-online-auf-viren-pruefen/). 

![Virencheck](/posts/2024-12-29_camtasia_scam/download_4.webp)

Nur 7 von 72 Virenscannern erkennen aktuell die Malware. Diese wird regelmäßig neu erzeugt, bevor die Anbieter der Virenpramme nachziehen können. Ein installierter Virenscanner ist also oft kein ausreichender Schutz.

### Wir schreiben mal zurück

Im Grunde können wir uns eine Antwort sparen, die Phisher haben ihr Ziel erreicht, wenn der Anwender die Datei ausführt. Aber vielleicht machen wir denen noch etwas Arbeit.

> Dear PicsArt Team,  
> 
> Thanks for the link. As per your instructions, we reviewed the advertising materials and attempted to open the provided files. 
> However, it seems that there was an issue, as the files didn’t appear to function or display any content after opening. 
> Could you please confirm if the files were uploaded correctly, or if there are alternative links we could use?  
> 
> We look forward to your response and moving forward with this partnership.  
> 
> Best regards,  


## Fazit und Update

Vorsicht ist bei solchen Angeboten angesagt. Das Red-Flag ist ein Download von Dateien mit Passwortschutz. Ausgeführt wird der Computer infiziert. In den meisten Fällen wird eine Backdoor installiert, welche dann ausgenutzt wird um weitere Malware nachinstallieren zu können. Das kann dann alles mögliche sein, vom Bitcoin-Miner, Erpessungs-Trojaner, Teilnahme an Spam und Botnetzwerken, you name it.

Virenscanner bieten nur hier begrenzten Schutz, selbst nach einigen Tagen erkennen nur [wenige die Malware](https://www.virustotal.com/gui/file/18b6f5ab29a4676139b5e2f763583a4e6fbbdb1c3ca79f281b9d3c4acbc89762/detection).

## Video

<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/z6206Ywe6vc?si=ocJKYU_zN3I7oagx" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>