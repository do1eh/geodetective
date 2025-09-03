<?php

include("../templateohne.php");  



$imageid=$_SESSION['imageid'];

if (isset($_POST['chosenimage'])) {
    
    if (isset($_POST['chosenimage'])){
    $imageid=$_POST['chosenimage'];
    }
    else {
        if (isset($_GET['chosenimage'])){$imageid=$_GET['chosenimage']; } 
    }
    $_SESSION['imageid']=$imageid;

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
    }
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    
    <title><?=guessmaintitle?></title>
    <style>
        /* Grundlegende Stile für den Body */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            overflow: hidden;
            background-color: black;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Container für das Bild */
        .container {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        /* Das Bild im Container */
        .image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            cursor: grab;
            transition: transform 0.2s ease;
        }

        /* Transparentes Overlay rechts */
        .overlay {
            position: absolute;
            top: 0;
            right: 0;
            width: 50px;
            height: 100%;
            background-color: rgba(111, 96, 196, 0.5);
            color:#ffffff;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Zoom Slider */
        .zoom-slider {
            transform: rotate(90deg);
            margin: 10px;
            width: 200px;
            height: 200px;
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 5px;
        }

        /* Button für guessmap.php */
        .button {
            position: absolute;
            padding: 10px 20px;
            top: 20px;
            left: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            color: #333;
        }

        .button2 {
            position: absolute;
            padding: 10px 20px;
            top: 60px;
            left: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            color: #333;
        }

        .button4{
            position: absolute;
            padding: 10px 20px;
            top: 100px;
            left: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            color: #333;
        }

        .button3{
            position: absolute;
            padding: 10px 20px;
            top: 140px;
            left: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            color: #333;
        }


        /* Responsiv für kleine Bildschirme */
        @media (max-width: 768px) {
            .overlay {
                width: 40px;
            }

            .zoom-slider {
                width: 250px;
                height: 150px;
            }
        }

    </style>
</head>
<body>

<div class="container">
    <!-- Das Bild -->
    <img src="../uploads/<?=$filename?>" alt="Zoomable Image" class="image" id="zoomImage" ondragstart="return false">

    <!-- Transparentes Overlay für den Zoom -->
    <div class="overlay">
        
        <input type="range" min="1" max="10" value="1" class="zoom-slider" id="zoomSlider">
        <br><br><br>
        Zoom
    </div>

    <!-- Button für guessmap.php -->
    
     <button class="button" onclick="window.location.href='guessmap.php'"><?=buttonguesslocation?></button>
     <button class="button2" onclick="window.location.href='guessjid.php'"><?=buttonguessjid?></button>
     <button class="button4" onclick="resetImage()"><?=buttonreset?></button>
     <button class="button3" onclick="window.location.href='chooseguessimage.php'"><?=buttonback?></button>
     
    
</div>

<script>
    let isMouseDown = false;
    let startX, startY;
    let scale = 1;
    const image = document.getElementById('zoomImage');
    const zoomSlider = document.getElementById('zoomSlider');
    let initialTouchDistance = 0;
    let initialScale = scale;
    let initialTouchX = 0;
    let initialTouchY = 0;


    function resetImage(){
        startX=0, startY=0;
        scale = 1;
        initialTouchDistance = 0;
        initialScale = scale;
        initialTouchX = 0;
        initialTouchY = 0;
        image.style.transform = `scale(${scale})`;
        image.style.left = `0px`;
        image.style.top = `0px`;
        zoomSlider.value = scale;

    }
    // Zoom mit dem UI Slider
    zoomSlider.addEventListener('input', (e) => {
        scale = parseFloat(e.target.value);
        image.style.transform = `scale(${scale})`;
    });

    // Zoom per Mausrad (für Desktop)
    image.addEventListener('wheel', (e) => {
        e.preventDefault();
        if (e.deltaY < 0) {
            scale = Math.min(scale * 1.1, 5); // Maximaler Zoomfaktor
        } else {
            scale = Math.max(scale / 1.1, 1); // Minimaler Zoomfaktor
        }
        image.style.transform = `scale(${scale})`;
        zoomSlider.value = scale; // Slider anpassen
    });

    // Verschieben des Bildes bei Mausdrag (für Desktop)
    image.addEventListener('mousedown', (e) => {
        isMouseDown = true;
        startX = e.clientX - image.offsetLeft;
        startY = e.clientY - image.offsetTop;
        image.style.cursor = 'grabbing';
    });

    document.addEventListener('mouseup', () => {
        isMouseDown = false;
        image.style.cursor = 'grab';
    });

    document.addEventListener('mousemove', (e) => {
        if (isMouseDown) {
            const x = e.clientX - startX;
            const y = e.clientY - startY;
            image.style.left = `${x}px`;
            image.style.top = `${y}px`;
        }
    });

    // Touch-Gesten für Zoom und Verschieben auf Mobilgeräten
    image.addEventListener('touchstart', (e) => {
        if (e.touches.length === 2) {
            initialTouchDistance = getDistance(e.touches[0], e.touches[1]);
            initialScale = scale;
        } else if (e.touches.length === 1) {
            initialTouchX = e.touches[0].clientX - image.offsetLeft;
            initialTouchY = e.touches[0].clientY - image.offsetTop;
        }
    });

    image.addEventListener('touchmove', (e) => {
        if (e.touches.length === 2) {
            let newTouchDistance = getDistance(e.touches[0], e.touches[1]);
            scale = initialScale * (newTouchDistance / initialTouchDistance);
            scale = Math.min(Math.max(scale, 1), 5); // Begrenzung des Zooms
            image.style.transform = `scale(${scale})`;
            zoomSlider.value = scale;
        } else if (e.touches.length === 1) {
            const x = e.touches[0].clientX - initialTouchX;
            const y = e.touches[0].clientY - initialTouchY;
            image.style.left = `${x}px`;
            image.style.top = `${y}px`;
        }
    });

    // Hilfsfunktion, um die Distanz zwischen zwei Touchpunkten zu berechnen
    function getDistance(touch1, touch2) {
        return Math.sqrt(Math.pow(touch2.clientX - touch1.clientX, 2) + Math.pow(touch2.clientY - touch1.clientY, 2));
    }

</script>

</body>
</html>
