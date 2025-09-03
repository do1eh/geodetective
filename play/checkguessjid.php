<?php
session_start();
 
   include("../templateoben.php");  

   if (strlen($jid)>0 && strlen($jid)<>6)  {
    echo "<script>window.location.href='guessjid.php?msg=".htmlentities(errorjid)."';</script>";
    //header("location: registerscoutgroup.php?msg='".errorjid."'");
     exit(1);
}
       
   //1. prüfen ob für dieses Bild schon ein Tipp abgegeben wurde:
   $stmt = $conn->prepare("select * from guess where userid=? and imageid=?");
   $stmt->bind_param("ii", $_SESSION['userid'], $_SESSION['imageid']);
   $stmt->execute();
   $result = $stmt->get_result();
   if ($result->num_rows)
   {
   $guessresult = $result->fetch_assoc();
   $guessid=$guessresult['id']; 
    
   $stmt = $conn->prepare("update  guess set guessedjid=? where id=?");
   $stmt->bind_param("si", $jid, $guessid);
   $stmt->execute();

   }
   else { 

    $stmt = $conn->prepare("insert into guess (imageid,userid,guessedjid) values (?, ?, ?)");
    $stmt->bind_param("iis", $_SESSION['imageid'], $_SESSION['userid'], $jid);
    $stmt->execute();   
   
   }
   
   echo "<script>window.location.href='guess.php?chosenimage=".$_SESSION['imageid']."';</script>";
   //header("location: ../menu/main.php");
   exit(1);
   
        
   
?>