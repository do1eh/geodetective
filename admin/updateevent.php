<?php
session_start();
 
   include("../templateoben.php");  
   if ($_SESSION['role']!='admin' ) {
    echo "<script>window.location.href='../menu/main.php';</script>";
    exit(1);
 } 
 $editeventid=$_SESSION['editeventid'];   
 
 //Format für Datepicker: yyyy-mm-ddThh:mm   
 //Format für Timestamp: yyyy-mm-dd hh:mm:ss   
 $starttimestamp=str_replace("T"," ",$starttimestamp).":00";
 $endtimestamp=str_replace("T"," ",$endtimestamp).":00";
 $submitfrom=str_replace("T"," ",$submitfrom).":00";
 $submituntil=str_replace("T"," ",$submituntil).":00";


$stmt = $conn->prepare("update event set name=?, starttimestamp=?, endtimestamp=?, startnightsrest=?, endnightsrest=?, submitfrom=?, submituntil=?, publishinterval=?,imagesperinterval=? where id=?");
$stmt->bind_param("sssssssiii", $name, $starttimestamp, $endtimestamp, $startnightsrest, $endnightsrest, $submitfrom, $submituntil, $interval, $imagesperinterval, $editeventid);
$stmt->execute();

 
$_SESSION['starttimestamp'] = $starttimestamp;
$_SESSION['endtimestamp'] = $endtimestamp;
$_SESSION['interval'] = $interval;
$_SESSION['imagesperinterval'] = $imagesperinterval;
$_SESSION['submitfrom'] = $submitfrom;
$_SESSION['submituntil'] = $submituntil;
$_SESSION['startnight'] = $startnightsrest;
$_SESSION['endnight'] = $endnightsrest;
   


echo "<script>window.location.href='adminevent.php';</script>"; 
//header("location: adminevent.php");
exit(1);
  



?>