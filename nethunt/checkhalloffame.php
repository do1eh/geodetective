<?php
session_start();
 
include("../templatenethunt.php");   
       
   //Einstrag speichern speichern
   $username = htmlspecialchars(trim($_POST['username']));
    $kommentar = htmlspecialchars(trim($_POST['kommentar']));
    $rating = (int)$_POST['rating'];

   $sql="insert into nethunt (name,kommentar,rating,datum) values ('".$username."','".$kommentar."',".$rating.",'".date("Y-m-d H:i:s")."')";
   $conn->query($sql);
   echo "<script>window.location.href='halloffame.php?saved=1';</script>";
   exit(1);
   
        
   
?>