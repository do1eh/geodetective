<?php
session_start();
 
   include("../templateoben.php");  

   if(isset($abbrechen)) {
      echo "<script>window.location.href='../menu/main.php';</script>";
       //header("location: ../menu/main.php");
    exit(1);
   }
   if(isset($ok) and  isset($Location_Latitude)) {
       
   //1. prüfen ob für dieses Bild schon ein Tipp abgegeben wurde:
   $stmt = $conn->prepare("select * from guess where userid=? and imageid=?");
   $stmt->bind_param("ii", $_SESSION['userid'], $_SESSION['imageid']);
   $stmt->execute();
   $result = $stmt->get_result();
   if ($result->num_rows)
   {
   $guessresult = $result->fetch_assoc();
   $guessid=$guessresult['id']; 
    
   $stmt = $conn->prepare("update  guess set lat=?,lon=? where id=?");
   $stmt->bind_param("ddi", $Location_Latitude, $Location_Longitude, $guessid);
   $stmt->execute();

   }
   else { 

    $stmt = $conn->prepare("insert into  guess (imageid,userid,lat,lon) values (?, ?, ?, ?)");
    $stmt->bind_param("iidd", $_SESSION['imageid'], $_SESSION['userid'], $Location_Latitude, $Location_Longitude);
    $stmt->execute();   
   
   }
   }
   echo "<script>window.location.href='../menu/main.php';</script>";
   //header("location: ../menu/main.php");
   exit(1);
   
        
   
?>