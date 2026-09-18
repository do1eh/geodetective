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
    <h1>JOTA-JOTI - Biggest Scout Event</h1>
    <center>
    <img src="images/biggestscoutevent.png" width="800px" alt="Biggestscoutevent.com" class="responsive-img">
    </center>
    <p><?=landingtitle?></p>

    <hr>

<div class="link-preview">
        <h2><?=generalinfo?></h2>
        <p><?=generalinfotext?></p> 
            
</div>

<div class="link-preview">
        <h2>Nethunt</h2>
        <img src="nethunt/protocols.png" width="200px" alt="Nethunt Vorschaubild">
        <h3><?=nethunttitle?></h3>
        <p><?=nethunttext?></p>
        <br>
        <p>
        <center>
              <a href="#" style="
            display: inline-block;
            padding: 10px 20px;
            background-color: #2a6f44;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        "><?=nethuntbutton?></a>
        </center> 
</p>    
</div>


    <div class="link-preview">
        <h2>GeoDetective</h2>
        <a href="splashscreen.php" class="link-preview clearfix">
            <img src="images/GeoDetective-JOTA-JOTI.png" width="100px" alt="GeoDetective Vorschaubild">
            <div>
                <h3><?=geotitle?></h3>
                <p><?=geotext?></p> 
            </p>
            </div>
        </a>
        <center>
              <a href="splashscreen.php" style="
            display: inline-block;
            padding: 10px 20px;
            background-color: #2a6f44;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        "><?=geobutton?></a>
        </center>
    </div> 

    <div class="link-preview">
        <h2>Workshop 2026</h2>
        <img src="workshop/midi.jpg" width="200px" alt="MIDI Controller">
        
        <h3><?=midititle?></h3>
        <p><?=miditext?></p>
        <br>
        <p>
        <center>
              <a href="midi/scoutball.html" target="_blank">Scoutball</a><br>
              <a href="midi/boom.html" target="_blank">Space Tunnel defender</a><br>
              <a href="midi/platform.html" target="_blank">Platform</a><br>
              <a href="midi/farbmischer.html" target="_blank">Color mixer</a><br>
              <a href="https://errozero.co.uk/acid-machine/" target="_blank">Acid Machine 2</a><br>
        </center> 
</p>
<br>
<p><?=miditext2?></p>
<br>
<p>
<center>
              <a href="<?=midilink?>" style="
            display: inline-block;
            padding: 10px 20px;
            background-color: #2a6f44;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        "><?=midibutton?></a>  
        </center>
</p> 
</div>


 <div class="link-preview">
        <h2><?=liveradiotitle?></h2>
        <p ><?=liveradiotext?></p>
           
        <div class="audio-wrapper">
            <center>
            <a href="https://hose.brandmeister.network/?subscribe=90710" target="_blank" style="
            display: inline-block;
            padding: 10px 20px;
            background-color: #2a6f44;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        "><?=liveradiobutton?></a>
        </center>
        <br><br> 
            <iframe src="https://hose.brandmeister.network/?subscribe=90710" frameborder="0" style="width: 100%; height: 100px;"></iframe>
        <br><br>
        <h2 id="live-radio-heading"><?=calendartitle?></h2>
        <center>
            <iframe src="https://calendar.google.com/calendar/embed?height=300&wkst=1&ctz=Europe%2FBerlin&showPrint=0&showNav=0&showTabs=0&showDate=0&mode=AGENDA&src=NTM3NzRmMzA1Mjg3MjRjMDU3MjdkZmU1YzA2OGFhMzhhNGQ3YjMxMzI4ZTkwZGU3MDc0NzRiZmZjZDEyNjA3N0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&color=%239e69af" style="border-width:0" width="300" height="300" frameborder="0" scrolling="no"></iframe>
        </center>    
            </div>
    </div>

            


<div class="link-preview">
        <h2>GeoDetective</h2>

            <div>
                <h3><?=georulestitle?></h3>
                <p><?=georulestext?></p> 
            </p>
            </div>
        </a>
        <center>
              <a href="splashscreen.php" style="
            display: inline-block;
            padding: 10px 20px;
            background-color: #2a6f44;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        "><?=geobutton?></a>
        </center>
    </div> 
<!--
    <div class="link-preview">
        <h2>Discord</h2>

            <div>
                <h3><?=discordtitle?></h3>
                <p><?=discordtext?></p> 
                <br>
            </p>
            </div>
        </a>
        <center>
              <a href="https://discord.gg/AuNRPvtE9v" style="
            display: inline-block;
            padding: 10px 20px;
            background-color: #2a6f44;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        "><?=discordbutton?></a>
        </center>
    </div> 
            -->


<div class="link-preview">
        <h2>Deutschsprachige Skeds</h2>
        <p><img src="images/dmrspur.jpeg" width="400px"></p>
        <br><br><br><br><br><br>
                    <div>
                        Ein Sked (von englisch schedule, dt. Zeitplan) ist ein 
                        geplanter Funkverkehr zwischen zwei oder mehreren Funkstationen.<br>
                        Beim JOTA-JOTI gibt es zwei deutschsprachige Skeds.<br>
                        Einen im digitalen Sprechfunk (DMR im Brandmeister Netz) und einen auf Kurzwelle.<br><br>
                <h2> DMR SKED<h2>
                <h3>TG 90710 um 16 Uhr Küchenzeit</h3>
                
                <p>Am Samstag den 18.Oktober findet der deutschsprachige DMR Sked statt.  
                    
Bitte  bereitet eine kleine Vorstellung eurer Gruppe vor:
<ul>
<li>Wie heißt eure Gruppe?</li>
<li>Wo kommt ihr her?</li>
<li>Wieviele Personen sind anwesend?</li>
<li>Wieviele Personen hatten schon ein QSO?</li>
<li>Habt ihr Geodetective gespielt?</li>
</ul><br>
Falls ihr kein DMR fähiges Funkgerät habt, dann könnt ihr trotzdem zuhören:<br><br>
<center>
            <a href="https://hose.brandmeister.network/?subscribe=90710" target="_blank" style="
            display: inline-block;
            padding: 10px 20px;
            background-color: #2a6f44;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        "><?=liveradiobutton?></a>
        </center>
</p> 
    <br>
    <h2> DL-Sked </h2>
    <h3> 3690Mhz um 17 Uhr Küchenzeit</h3> 
    <p>
        Im Anschluss an den DMR Sked findet der traditionsreiche DL-Sked
        auf Kurzwelle statt. Schon seit vielen Jahren treffen sich hier Pfadistationen
        aus Deutschland und anderen Deutschsprachigen Ländern.<br>
        Die beim JOTA-JOTI angemeldeten Stationen nehen automatisch Teil, es ist aber
        kein Problem sich beim DL-Sked bei der Leitstation anzumelden. Am Ende wird
        noch einmal gefragt ob Stationen vergessen wurden. Auch hier kann man sich noch
        in die Liste eintragen lassen um dann von der Leitstation aufgerufen zu werden.
        <br><br>
        Ablauf:<br>
        Alle angemeldeten Stationen werden nach und nach aufgerufen und können dann kurz
        ihre Gruppe und ihre JOTA-JOTI aktivitäten vorstellen.<br>
        Zwischen den Vorstellungen werden immer wieder Quizfragen gestellt.<br>
        Die Lösung ist inner eine Telefonnummer. Wer dort zuerst anruft hat gewonnen.<br>
        Legt euch am Besten Stift und Papier bereit um die Aufgaben und Lösungen zu notieren. 
        Ein Internetzugang kann auch nicht schaden.<br><br>
        Wenn ihr kein Kurzwellenfunkgerät zur Verfügung habbt, dann könnt ihr trotzdem zuhören 
        und auch beim DL-Sked Quiz mitmachen.<br><br><b>
        Sucht euch auf <a href="https://instances.ubersdr.org/" target="_blank">ubersdr.org</a> einen SDR Empfänger in Deutschland 
        und stellt ihn auf 3690Mhz ein:
            </p><br>
            <center>
            <a href="https://instances.ubersdr.org/" target="_blank" style="
            display: inline-block;
            padding: 10px 20px;
            background-color: #2a6f44;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        ">Live Kurzwelle hören</a>
        </center>
            </div>
        </a>
        
            </div>
    </div>
    <hr>

    

   </div>

</body>
</html>