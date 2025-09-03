<?php
declare(strict_types=1);

if(session_status() !== PHP_SESSION_ACTIVE) session_start();

include('credentials.php');

$conn = mysqli_connect($server, $user, $pass,$dbase);

 if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
  
  //Alle GET Variablen einlesen
  

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
            max-width: 100px;
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
    <h1>JOTA /JOTI - Biggest Scout Event</h1>
    <p><?=landingtitle?></p>

    <hr>

    <div class="link-preview">
        <h2>GeoDetective</h2>
        <a href="splashscreen.php" class="link-preview clearfix">
            <img src="images/GeoDetective-JOTA-JOTI.png" alt="GeoDetective Vorschaubild">
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

</div>
    </div>
    <hr>

    <div class="media-container">
        <h2><?=videotitle?></h2>
        <div class="video-wrapper">
            <iframe src="https://www.youtube.com/embed/ZCxqxfypKNc" allowfullscreen></iframe>
        </div>
        <div class="video-wrapper">
            <iframe src="https://youtube.com/embed/rN9LwCKpZzo" allowfullscreen></iframe>
        </div>

   </div>

</body>
</html>