<?php
session_start();
 
   include("../templateoben.php");  

     



if (strlen($jid)>0 && strlen($jid)<>6)  {
    echo "<script>window.location.href='editscoutgroup.php?msg=".htmlentities("Der JID-Code muss sechstellig sein.")."';</script>"; 
    //header("location: registerscoutgroup.php?msg='Der JID-Code muss sechstellig sein.'");
     exit(1);
}

//Wenn alle OK ist, Gruppe ändern

$stmt = $conn->prepare("update scoutgroup set country=?,city=?,contact=?,association=?,jid=? where id=?");
$stmt->bind_param("sssssi", $country, $city, $contact, $association, $jid, $_SESSION['userscoutgroup']);
$stmt->execute();

echo "<script>window.location.href='configure.php';</script>"; 

exit(1);
  



?>