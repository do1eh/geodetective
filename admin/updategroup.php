<?php
session_start();
 
   include("../templateoben.php");  

 $groupid=$_SESSION['groupid'];      

$sql0="SELECT * FROM scoutgroup WHERE id<>".$groupid." and name='".$name."'";



$result = $conn->query($sql0);

$datensatz = $result->fetch_assoc();


if ($result->num_rows)  {
    header("location: registerscoutgroup.php?msg='Der Gruppenname ist bereits angelegt, bitte aus der Liste auswählen.'");
     exit(1);
}

if (strlen($jid)>0 && strlen($jid)<>6)  {
    header("location: registerscoutgroup.php?msg='Der JID-Code muss sechstellig sein.'");
     exit(1);
}

//Wenn alle OK ist, Gruppe anlegen

$sql="update scoutgroup set name='".$name."', country='".$country."',city='".$city."',contact='".$contact."',association='".$association."',jid='".$jid."' where id=".$groupid;

$conn->query($sql);


header("location: adminscoutgroup.php");
exit(1);
  



?>