<?php
session_start();
 
   include("../templateoben.php");  
       
   //Kommentar speichern
   $commenttext = htmlspecialchars(trim($_POST['commenttext']));
   $stmt = $conn->prepare("insert into comment (imageid,userid,text) values (?, ?, ?)");
   $stmt->bind_param("iis", $_POST['imageid'], $_SESSION['userid'], $commenttext);
   $stmt->execute();
   echo "<script>window.location.href='choosesolutionimage.php?saved=1';</script>";
   exit(1);
   
        
   
?>