<?php
include("../templateohne.php");  
 
$imageid=$_SESSION['imageid'];

if (isset($accept)) {
    $imageid=$_POST['accept'];
    $stmt = $conn->prepare("update image set accepted= NOT accepted,acceptedby=?,deadline='2035-12-31 00:00:00' WHERE id=?");
    $stmt->bind_param("ii", $_SESSION['userid'], $imageid);
    $stmt->execute();
    //echo $sql; 
    if ($_SESSION['allimages']==1) {
       echo "<script>window.location.href='editmyimages.php?mode=admin&allimages=1';</script>";
    }
    else {
        echo "<script>window.location.href='editmyimages.php?mode=admin';</script>";
    }
    
}else
if (isset($delete)) {
    $imageid=$_POST['delete'];
    
    //Datei löschen
    $stmt = $conn->prepare("SELECT * FROM image WHERE id=?");
    $stmt->bind_param("i", $imageid);
    $stmt->execute();
    $result = $stmt->get_result();
    $datensatz = $result->fetch_assoc();
    $filename=$datensatz['filename'];
    unlink("../uploads/".$filename); 
    
    $stmt = $conn->prepare("delete from image  WHERE id=?");
    $stmt->bind_param("i", $imageid);
    $stmt->execute();

    $stmt = $conn->prepare("delete from guess  WHERE imageid=?");
    $stmt->bind_param("i", $imageid);
    $stmt->execute();
    $stmt = $conn->prepare("delete from comment  WHERE imageid=?");
    $stmt->bind_param("i", $imageid);
    $stmt->execute();
    

    if ($_SESSION['allimages']==1) {
        echo "<script>window.location.href='editmyimages.php?mode=admin&allimages=1';</script>";
     }
     else {
        if ($_SESSION['role']=='admin') {
         echo "<script>window.location.href='editmyimages.php?mode=admin';</script>";
        } else {
         echo "<script>window.location.href='editmyimages.php';</script>";
     }
     }
    
    } else

    if(isset($turn)) {
        $imageid=$_POST['turn'];
        $_SESSION['imageid']=$imageid;
         $stmt = $conn->prepare("SELECT * FROM image WHERE id=?");
         $stmt->bind_param("i", $imageid);
         $stmt->execute();
         $result = $stmt->get_result();
         $datensatz = $result->fetch_assoc();
         $filename=$datensatz['filename'];
      $filenameneu=time().substr($filename, -4);

    if (file_exists("../uploads/".$filename)) {
    $imagePath = "../uploads/".$filename;
    $imagePathneu = "../uploads/".$filenameneu;
    $imageInfo = getimagesize($imagePath);
    $mime = $imageInfo['mime'];

    switch ($mime) {
        case 'image/jpeg':
            $img = imagecreatefromjpeg($imagePath);
            break;
        case 'image/png':
            $img = imagecreatefrompng($imagePath);
            break;
        case 'image/gif':
            $img = imagecreatefromgif($imagePath);
            break;
        default:
            $img = false;
    }

    // EXIF-Daten auslesen
    $exif = exif_read_data($filename);
    $degrees = 0;

    if (!empty($exif['Orientation'])) {
        switch ($exif['Orientation']) {
            case 3: // 180 Grad
                $degrees = 180;
                break;
            case 6: // 90 Grad im Uhrzeigersinn (muss um 270 Grad gegen Uhrzeigersinn gedreht werden)
                $degrees = 270;
                break;
            case 8: // 270 Grad im Uhrzeigersinn (muss um 90 Grad gegen Uhrzeigersinn gedreht werden)
                $degrees = 90;
                break;
        }
    }
  
    if ($degrees > 0) {
        $img = imagerotate($img, $degrees, 0);
    }

    if ($img !== false) {
        
        $rotated = imagerotate($img, 90, 0);
        switch ($mime) {
            case 'image/jpeg':
                imagejpeg($rotated, $imagePathneu,90);
                
                break;
            case 'image/png':
                imagepng($rotated, $imagePathneu);
                break;
            case 'image/gif':
                imagegif($rotated, $imagePathneu);
                break;
        }


     $stmt = $conn->prepare("update image set filename=? WHERE id=?");
     $stmt->bind_param("si", $filenameneu, $imageid);
     $stmt->execute();
     unlink($imagePath);


        imagedestroy($img);
        imagedestroy($rotated);
    }

}
if ($_SESSION['mode']=='admin' && $_SESSION['role']=='admin' && $_SESSION['allimages']==1) {
    echo "<script>window.location.href='editmyimages.php?mode=admin&allimages=1';</script>";
    } elseif ($_SESSION['mode']=='admin' && $_SESSION['role']=='admin') {
        echo "<script>window.location.href='editmyimages.php?mode=admin';</script>";
    } else {
      echo "<script>window.location.href='editmyimages.php';</script>";
    }
    } else

if (isset($chosenimage)) {
    
    $imageid=$_POST['chosenimage'];
    $_SESSION['imageid']=$imageid;
    $stmt = $conn->prepare("SELECT * FROM image WHERE id=?");
   $stmt->bind_param("i", $imageid);
   $stmt->execute();
   $result = $stmt->get_result();
   $datensatz = $result->fetch_assoc();
   $filename=$datensatz['filename'];



}


   $stmt = $conn->prepare("SELECT * FROM image WHERE id=?");
   $stmt->bind_param("i", $imageid);
   $stmt->execute();
   $result = $stmt->get_result();
   $datensatz = $result->fetch_assoc();
   $filename=$datensatz['filename'];
   $lat=$datensatz['lat'];
   $lon=$datensatz['lon'];
   $_SESSION['lat']=$lat;
   $_SESSION['lon']=$lon;
   $beschreibung=$datensatz['description'];
   $solutiontext=$datensatz['solutiontext'];
   ?>
  
  
  
  

  
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//DE">
  <html>
  <head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minimap mit Beschreibung</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"/>

  <title>JOTA-JOTI Geodetective</title>
  <meta http-equiv="content-type" content= "text/html; iso-8859-1">
  <meta name="robots" content= "INDEX,FOLLOW">
  <meta http-equiv="content-language" content= "de">
  <meta name="keywords" content= "JOTA, JOTI, Pfadfinder, Scouts, Spiel, ">
  <meta name="author" content= "Ralf Lüsebrink">
  <meta name="publisher" content= "Ralf Lüsebrink">
  <link rev="made" content= "rnh@gmx.net">
  <meta name="copyright" content= "Ralf Lüsebrink">
  <meta name="audience" content= "Alle">
  <meta name="page-type" content= "Spiel für Pfadfinder">
  <meta name="page-topic" content= "Spiel zum JOTA">
  <meta name="revisit after" content= "7 days">
  <META NAME="Description" CONTENT="Jamboree in the Air and Internet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="SHORTCUT ICON" href="favicon.ico">
  
  
  
  
  
  
  <style type="text/css">
  
  <style>
        /* Grundlegendes Layout und Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            height: 100vh;
            box-sizing: border-box;
            background-color: #f4f4f4;
        }

        .map-container {
            width: 50%;
            max-width: 300px;
            height: 300px;
            margin-top: 20px;
            border: 2px solid #ccc;
        }

        .controls {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 5px;
            width: 100%;
            max-width: 600px;
            padding: 10px;
            box-sizing: border-box;
            background-color: #fff;
            
        }

        .controls input {
            padding: 10px;
            margin-top: 10px;
            width: 100%;
            max-width: 500px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .controls button {
            padding: 10px 20px;
           
            border: none;
            border-radius: 4px;
            margin-top: 10px;
            cursor: pointer;
            font-size: 16px;
        }

        .controls button:hover {
            background-color: #0056b3;
        }

        /* Responsive Design für Handys */
        @media (max-width: 600px) {
            .map-container {
                height: 200px;
            }

            .controls {
                width: 90%;
                padding: 15px;
            }
        }
    </style>
  
  

  
  
  </head>
  
  
  
  <body>  








<center>


<img src="../uploads/<?=$filename;?>" style="max-height: 200px;
            
            margin-top: 20px;
            border: 2px solid #ccc;">


    
    <form action="checkeditimage.php" method="post">
    
    <div id="map" class="map-container"></div>

    <!-- Steuerungselemente -->
    <div class="controls">
    <button type="submit" name="reposition"><?=editimageeditcoord?></button>        
    <?=editimageedescrition?>
        <!--<input type="text" name="imagedescription" placeholder="Bildbeschreibung" value="<?=$beschreibung;?>"/>-->
        <textarea id="text" name="imagedescription" rows="3" cols="40"><?=trim($beschreibung);?></textarea>
        <?=editimagesolutiontext?>
        <!--<input type="text" name="imagedescription" placeholder="Bildbeschreibung" value="<?=$beschreibung;?>"/>-->
        <textarea id="text" name="imagesolutiontext" rows="3" cols="40"><?=trim($solutiontext);?></textarea>
        <?php
         if(isset($msg)) {
         echo'<span style="color:red;">'.$msg.'<br></span>';
       }
       
       ?>   
        
        <button type="submit" name="save"><?=editimagesavebutton?></button>
        
    </div>
    </form>
    <button  onclick="window.location.href='editmyimages.php'"><?=buttonback?></button>
    
    
    
    
    
    
    
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script>
        // Initiale Koordinaten (Latitude, Longitude)
        let lat = <?=$lat;?>  
        let lon = <?=$lon;?> 

        // Initialisiere die Karte
        const map = L.map('map').setView([lat, lon], 13);

        // Füge eine TileLayer hinzu (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Füge einen Marker an der aktuellen Position hinzu
        const marker = L.marker([lat, lon]).addTo(map);

        // Funktion, um die Position anzupassen
        document.getElementById('adjust-position-button').addEventListener('click', () => {
            // Setze eine neue zufällige Position als Beispiel
            lat = 51.1657 + (Math.random() - 0.5) * 2;  // zufällige Abweichung innerhalb Deutschlands
            lon = 10.4515 + (Math.random() - 0.5) * 2; // zufällige Abweichung innerhalb Deutschlands

            // Aktualisiere die Karte und den Marker
            map.setView([lat, lon], 13);
            marker.setLatLng([lat, lon]);

            // Ausgabe der neuen Koordinaten in der Konsole
            console.log(`Neue Position: Lat: ${lat}, Lon: ${lon}`);
        });

        // Füge EventListener hinzu, um Bildbeschreibung anzuzeigen
        const descriptionInput = document.getElementById('image-description');
        descriptionInput.addEventListener('input', (event) => {
            console.log('Bildbeschreibung: ', event.target.value);
        });
    </script>

<?php
  include("../templateunten.php");
  ?>
