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
   

   $sql="update  image set lat=".$Location_Latitude.",lon=".$Location_Longitude." where id=".$_SESSION['imageid'];
   $conn->query($sql);
   }
   echo "<script>window.location.href='editimage.php';</script>";
   //header("location: editimage.php");
   exit(1);
   
        
   
?>