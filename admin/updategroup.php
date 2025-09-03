<?php
session_start();
 
   include("../templateoben.php");  
   if ($_SESSION['role']!='admin' ) {
    echo "<script>window.location.href='../menu/main.php';</script>";
    exit(1);
 } 
 $groupid=$_SESSION['groupid'];      

$stmt = $conn->prepare("SELECT * FROM scoutgroup WHERE id<>? and name=?");



$stmt->bind_param("is", $groupid, $name);

$stmt->execute();

$result = $stmt->get_result();

$datensatz = $result->fetch_assoc();


if ($result->num_rows)  {
    echo "<script>window.location.href='registerscoutgroup.php?msg='".htmlentities("Der Gruppenname ist bereits angelegt, bitte aus der Liste auswählen."),"';</script>"; 
    //header("location: registerscoutgroup.php?msg='Der Gruppenname ist bereits angelegt, bitte aus der Liste auswählen.'");
     exit(1);
}

if (strlen($jid)>0 && strlen($jid)<>6)  {
    echo "<script>window.location.href='registerscoutgroup.php?msg=".htmlentities("Der JID-Code muss sechstellig sein.")."';</script>"; 
    //header("location: registerscoutgroup.php?msg='Der JID-Code muss sechstellig sein.'");
     exit(1);
}

//Wenn alle OK ist, Gruppe anlegen

$stmt = $conn->prepare("update scoutgroup set name=?, country=?,city=?,contact=?,association=?,jid=? where id=?");

$stmt->bind_param("ssssssi", $name, $country, $city, $contact, $association, $jid, $groupid);

$stmt->execute();

echo "<script>window.location.href='adminscoutgroup.php';</script>"; 
//header("location: adminscoutgroup.php");
exit(1);
  



?>