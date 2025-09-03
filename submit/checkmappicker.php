<?php
session_start();
 
   include("../templateoben.php");  

   if(isset($abbrechen)) {
       echo "<script>window.location.href='../menu/main.php';</script>"; 
       //header("location: ../menu/main.php");
    exit(1);
   }
   if(isset($ok) and  isset($Location_Latitude)) {
       //Koordinaten des Pickers in Bild schreiben
   

   $stmt = $conn->prepare("update  image set lat=?,lon=? where id=?");
   $stmt->bind_param("ddi", $Location_Latitude, $Location_Longitude, $_SESSION['imageid']);
   $stmt->execute();
   }
   echo "<script>window.location.href='editimage.php';</script>";
   //header("location: editimage.php");
   exit(1);
   
        
   
?>