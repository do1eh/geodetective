<?php
declare(strict_types=1);

if(session_status() !== PHP_SESSION_ACTIVE) session_start();

include('credentials.php');

$conn = mysqli_connect($server, $user, $pass,$dbase);

 if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
  
  //Alle GET Variablen einlesen
  foreach($_GET as $key => $val){$$key=htmlspecialchars($val);}
  foreach($_POST as $key => $val) {$$key=htmlspecialchars($val);}

  if (!isset($_SESSION['language'])) {
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $acceptLang = ['fr', 'it', 'en', 'de', 'nl']; 
    $lang = in_array($lang, $acceptLang) ? $lang : 'de';
    $_SESSION['language']=$lang;
  }

  include('locale/' . $_SESSION['language'] . '.php');
  
  ?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['language']; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biggest Scout Event</title>
    <style>
        /* Grundlegende Stil-Anpassungen für Desktop und Mobilgeräte */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        h1, h2 {
            text-align: center;
            color: #2a6f44; /* Pfadfinder-grün */
        }
        p {
            text-align: justify;
        }
        /* Standard für kleine Bildschirme (Handy) */
.responsive-img {
  width: 300px;
  height: auto; /* Behält das Seitenverhältnis bei */
}

/* Für Bildschirme ab 768px Breite (PC/Tablet) */
@media (min-width: 768px) {
  .responsive-img {
    width: 800px;
  }
}
        .media-container {
            margin-bottom: 30px;
            text-align: center;
        }
        .media-container h2 {
            margin-top: 0;
        }
        .video-wrapper {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 Seitenverhältnis */
            height: 0;
            overflow: hidden;
            margin-bottom: 20px;
            border-radius: 8px;
        }
        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            
            height: 100%;
            border: 0;
        }
        .audio-wrapper {
            width: 100%;
            max-width: 400px;
            margin: 20px auto;
        }
        .audio-wrapper h2 {
            margin-bottom: 10px;
        }
        .link-preview {
            display: block;
            text-decoration: none;
            color: #333;
            background-color: #e9e9e9;
            padding: 15px;
            border-radius: 8px;
            transition: background-color 0.3s;
            margin-bottom: 20px;
            text-align: left;
        }
        .link-preview:hover {
            background-color: #dcdcdc;
        }
        .link-preview img {
            max-width: 200px;
            float: left;
            margin-right: 15px;
            border-radius: 4px;
        }
        .link-preview h3 {
            margin: 0 0 5px 0;
            color: #2a6f44;
        }
        .link-preview p {
            margin: 0;
            font-size: 0.9em;
            color: #666;
            text-align: left;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Impressum und Datenschutzerklärung</h1>
    
    <p></p>

  

<div class="link-preview">
        <h2>Impressum</h2>
        
        <p>
<b>Angaben gemäß § 5 DDG</b><br><br>

Ralf Nils Lüsebrink<br>
Pastor-Dörr-Ring 58<br>
40589 Düsseldorf<br><br><br>

<b>Kontakt</b><br><br>


E-Mail: webmaster@biggestscoutevent.com<br><br>

<b>Redaktionell verantwortlich</b><br><br>

Ralf Nils Lüsebrink<br>
Pastor-Dörr-Ring 58<br>
40589 Düsseldorf<br><br><br>



        </p> 
            
</div>



   

<div class="link-preview">
        <h2>Datenschutzerklärung</h2>
          <p>
<b>1. Datenschutz auf einen Blick</b><br><br>
Allgemeine Hinweise<br>
Die folgenden Hinweise geben einen einfachen Überblick darüber, was mit Ihren personenbezogenen 
Daten passiert, wenn Sie diese Website besuchen. Personenbezogene Daten sind alle Daten, mit 
denen Sie persönlich identifiziert werden können.<br><br>

Datenerfassung auf dieser Website<br>
Wer ist verantwortlich für die Datenerfassung auf dieser Website?<br><br>

Die Datenverarbeitung auf dieser Website erfolgt durch den Websitebetreiber. 
Dessen Kontaktdaten können Sie dem Impressum dieser Website entnehmen.<br><br>

Wie erfassen wir Ihre Daten?<br><br>

Es werden nur Daten erhoben, die für die Nutzung der Website erforderlich sind.
Dies ist der Fall beim Erstellen eines Accounts für Geodetective.
Er werden ausschließlich Daten erhoben, die Sie uns freiwillig mitteilen.<br><br>

Wofür nutzen wir Ihre Daten?<br><br>

Die Daten werden verwendet um Sie als Nutzer zu identifizieren <br>
und Ihnen die Nutzung der Website zu ermöglichen.<br><br>

<b>2. Verantwortliche Stelle</b><br><br>
Die verantwortliche Stelle für die Datenverarbeitung auf dieser Website ist:<br>
<br>
Ralf Nils Lüsebrink<br>
Pastor-Dörr-Ring 58<br>
40589 Düsseldorf<br>
E-Mail: webmaster@biggestscoutevent.com<br><br>

Verantwortliche Stelle ist die natürliche oder juristische Person, 
die allein oder gemeinsam mit anderen über die Zwecke und Mittel der 
Verarbeitung von personenbezogenen Daten entscheidet.<br><br>

<b>3. Hosting</b><br>
Wir hosten unsere Website bei folgendem Anbieter:<br><br>

STRATO AG<br>
Jannowitzbrücke 1<br>
10179 Berlin<br><br>

Server-Log-Dateien<br>
Beim Aufrufen unserer Website erfasst STRATO automatisch Informationen in sogenannten 
Server-Log-Dateien, die Ihr Browser automatisch an den Server übermittelt. Dies sind:

<ul>
<li>Browsertyp und Browserversion</li>
<li>Verwendetes Betriebssystem</li>
<li>Referrer URL (die zuvor besuchte Seite)</li>    
<li>Hostname des zugreifenden Rechners</li>
<li>Uhrzeit der Serveranfrage</li>
<li>IP-Adresse (von STRATO zur Wahrung des Datenschutzes anonymisiert bzw. gekürzt gespeichert)</li>
</ul>

Eine Zusammenführung dieser Daten mit anderen Datenquellen wird nicht vorgenommen.<br>
Die Erfassung dieser Daten erfolgt auf Grundlage von Art. 6 Abs. 1 lit. f DSGVO. 
Der Websitebetreiber hat ein berechtigtes Interesse an der technisch fehlerfreien Darstellung, 
der Stabilität und der Sicherheit seiner Website.<br><br>


<b>4. Ihre Rechte (Betroffenenrechte)</b><br><br>
Sie haben im Rahmen der geltenden gesetzlichen Bestimmungen jederzeit folgende Rechte 
bezüglich Ihrer personenbezogenen Daten:<br><br>

Auskunft (Art. 15 DSGVO): Recht auf Auskunft über Ihre von uns verarbeiteten personenbezogenen Daten.<br>
Berichtigung (Art. 16 DSGVO): Recht auf unverzügliche Berichtigung unrichtiger Daten.<br>
Löschung (Art. 17 DSGVO): Recht auf Löschung Ihrer bei uns gespeicherten Daten.<br>
Einschränkung der Verarbeitung (Art. 18 DSGVO): Recht, die Einschränkung der Verarbeitung zu verlangen.<br>
Datenübertragbarkeit (Art. 20 DSGVO): Recht auf Erhalt Ihrer Daten in einem gängigen, 
maschinenlesbaren Format.<br><br>

Widerruf Ihrer Einwilligung (Art. 7 Abs. 3 DSGVO): Sie können eine erteilte Einwilligung 
jederzeit mit Wirkung für die Zukunft widerrufen.<br>
Widerspruchsrecht (Art. 21 DSGVO): Sie haben das Recht, aus Gründen, die sich aus 
Ihrer besonderen Situation ergeben, jederzeit gegen die Verarbeitung Sie betreffender 
personenbezogener Daten Widerspruch einzulegen.<br><br>

Beschwerderecht bei der zuständigen Aufsichtsbehörde:<br>

Im Falle von Verstößen gegen die DSGVO steht den Betroffenen ein Beschwerderecht 
bei einer Aufsichtsbehörde zu. Zuständige Aufsichtsbehörde für Nordrhein-Westfalen ist:<br><br>

Landesbeauftragte für Datenschutz und Informationsfreiheit Nordrhein-Westfalen<br>
Kavalleriestr. 2–4, 40213 Düsseldorf<br>
Webseite: https://www.ldi.nrw.de<br><br>

        </p> 
            
</div>



   </div>
   
</body>
</html>