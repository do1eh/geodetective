<?php

include("../templateohne.php");  



$imageid=$_SESSION['imageid'];

if (isset($chosenimage)) {
    
    $imageid=$_POST['chosenimage'];
    $_SESSION['imageid']=$imageid;
    

    $stmt = $conn->prepare("SELECT * FROM image WHERE  id=?");
    $stmt->bind_param("i", $imageid);
    $stmt->execute();
    $result = $stmt->get_result();
    $datensatz = $result->fetch_assoc();
    $lat=$datensatz['lat'];
    $lon=$datensatz['lon'];
    
    //JID des Bildes
    $stmt = $conn->prepare("SELECT * FROM image join user on image.userid=user.id join scoutgroup on user.scoutgroup=scoutgroup.id WHERE image.id=?");
    $stmt->bind_param("i", $imageid);
    $stmt->execute();
    $imagejid = $stmt->get_result();
    $imagejiddtaensatz = $imagejid->fetch_assoc();
    $jid= $imagejiddtaensatz['jid']; 

   
    $stmt = $conn->prepare("SELECT * FROM guess join user on guess.userid=user.id join scoutgroup on user.scoutgroup=scoutgroup.id WHERE imageid=?");
    $stmt->bind_param("i", $imageid);
    $stmt->execute();
    $guesses = $stmt->get_result();
    $anzahlguesses = $guesses->num_rows;
    
   
    }
?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=solutiontitle?></title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
   
    <style>
        #map { height: 500px;  max-width: 800px;}
        #marker-list { margin-top: 20px; }
        li { margin-bottom: 5px; }
    </style>
</head>
<body>

    <h1 style="display: inline"><?=solutionheadline?></h1><br> (<img src='../images/jotamarker.png' height='25em' ><?=solution?>,<img src='../images/markergreen.png' height='25em' ><?=solutionguesses?>, <img src='https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png'height='25em' ><?=solutionmyguess?>)
    
    <div id="map"></div>
   
   <script>
     
     var windowheight=60/100*window.innerHeight;
     windowheight=Math.floor(windowheight)+'px';
     document.getElementById("map").style.height=windowheight;
    </script> 

    <h2><?=solutionlist?></h2>
    <ul id="marker-list"></ul>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>

function zoomLevelForDistance(map, distanceInMeters) {
    const center = map.getCenter();
    var metersPerPixel = Math.cos(center.lat * Math.PI / 180) * 40075017 / (256 * Math.pow(2, map.getZoom())); // Formel für Meter pro Pixel
    let zoomLevel = map.getZoom();

    while (metersPerPixel * map.getSize().x > distanceInMeters) { // Solange die Kartenbreite in Pixeln * Meter pro Pixel größer ist als die gewünschte Distanz...
        zoomLevel++;
        metersPerPixel = Math.cos(center.lat * Math.PI / 180) * 40075017 / (256 * Math.pow(2, zoomLevel)); // Meter pro Pixel für neues Zoomlevel berechnen
    }
     while (metersPerPixel * map.getSize().x < distanceInMeters) { // Solange die Kartenbreite in Pixeln * Meter pro Pixel kleiner ist als die gewünschte Distanz...
        zoomLevel--;
        metersPerPixel = Math.cos(center.lat * Math.PI / 180) * 40075017 / (256 * Math.pow(2, zoomLevel)); // Meter pro Pixel für neues Zoomlevel berechnen
    }
    
    return zoomLevel;
}


        //marker
        var jotamarker = new L.Icon({
  iconUrl: '../images/jotamarker.png',
  shadowUrl: '../images/jotashadow.png',
  iconSize: [50, 73],
  iconAnchor: [25, 73],
  popupAnchor: [1, -77],
  shadowSize: [0, 0]
});

var greenmarker = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowSize: [41, 41]
});
        // Referenzpunkt (z.B. Berlin)
        const referencePoint = [<?=$lat?>, <?=$lon?>]; // Latitude und Longitude von Berlin

        // Marker-Daten (Name, Latitude, Longitude)
        const markers = [
            <?php
             
             $first=true;
             foreach($guesses as $guess) {
                
                //jid korrekt
                $jidcorrect="";
                if ($guess['guessedjid']==$jid)
                {
                    $jidcorrect=solutionjidcorrect; 
                }
                if (!$first) {echo ',';}; 
                $first=false;
                $beschriftung="";
               
               
                $beschriftung=$beschriftung.$guess['username']." - ".$guess['name']." (".$guess['city'].", ".$guess['country'].")";
                
                $beschriftung=$beschriftung." ".$jidcorrect;
                if ($guess['userid']==$_SESSION['userid']) {
                    $beschriftung=$beschriftung."*";
                }
                echo'{ name: "'.$beschriftung.'", lat: '.$guess['lat'].', lng: '.$guess['lon'].' }';

             }
                



            //{ name: "Marker 1", lat: 52.5201, lng: 13.4051 },
           ?>
        ];

        // Erstelle die Karte
        const map = L.map('map').setView(referencePoint, 10);

        // Füge OpenStreetMap als Layer hinzu
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        // Füge den Referenzpunkt als Marker hinzu
        //L.marker([51.5, -0.09], {icon: greenIcon}).addTo(map);
        //L.marker(referencePoint, {icon: jotamarker}).addTo(map).bindPopup('Ziel').openPopup();
        L.marker(referencePoint, {icon: jotamarker}).addTo(map);
        // Füge die Marker zur Karte hinzu und berechne die Entfernungen
        const distances = markers.map(marker => {
            const markerLatLng = [marker.lat, marker.lng];
            const distance = map.distance(referencePoint, markerLatLng); // Luftlinienentfernung
            var ismymarker="t"+marker.name;
            var markerElement;
            if (ismymarker.endsWith('*')) {
                 markerElement = L.marker(markerLatLng, {icon: greenmarker}).addTo(map).bindPopup(marker.name);
            } else {
             markerElement = L.marker(markerLatLng).addTo(map).bindPopup(marker.name);
            }
            return { ...marker, distance, element: markerElement };
        });

        // Sortiere Marker nach Entfernung zum Referenzpunkt (aufsteigend)
        distances.sort((a, b) => a.distance - b.distance);

        //median der abstände ist an position
        var medianpos=<?=$anzahlguesses/2?>;
        var i=0;
        // Zeige die sortierten Marker in einer Liste an
        const listElement = document.getElementById('marker-list');
        distances.forEach(marker => {
            const listItem = document.createElement('li');
            var distance=marker.distance.toFixed(2);
            var einheit='m';
            
            //median der abstände
            if(i==medianpos) {median=distance;i=i+1;} else {i=i+1;}
            if(distance>1000) {
                distance=(distance/1000).toFixed(3);
                einheit='km';
            }
            distance=distance.replace('.',',');
            //listItem.textContent = `${marker.name}: ${Math.round(marker.distance / 1000)} km`;
            listItem.textContent = `${marker.name}: ${distance} ${einheit}`;
            //listItem.textContent = `${marker.name}: ${marker.distance} m`;
            listElement.appendChild(listItem);
        });
       
        map.setView(referencePoint, zoomLevelForDistance(map,(median))-1);

        
    </script>
 <button  onclick="window.location.href='choosesolutionimage.php'"><?=buttonback?></button>
</body>
</html>
