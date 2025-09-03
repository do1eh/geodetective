<?php
include("../templateohne.php");  
if ($_SESSION['role']!='admin' && $_SESSION['role']!='moderator') {
    echo "<script>window.location.href='../menu/main.php';</script>";
    exit(1);
 } 



if (isset($accept)) {
    $commentid=$_POST['accept'];
    $stmt = $conn->prepare("update comment set accepted= NOT accepted, acceptedby=? WHERE id=?");
    $stmt->bind_param("ii", $_SESSION['userid'], $commentid);
    $stmt->execute();
}else
if (isset($delete)) {
    $commentid=$_POST['delete'];
    $stmt = $conn->prepare("delete from comment  WHERE id=?");
    $stmt->bind_param("i", $commentid);
    $stmt->execute();
    
}

//Am Ende auf jeden Fall zurück  
if ($_SESSION['allcomments']==1) {
    echo "<script>window.location.href='admincomments.php?mode=admin&allcomments=1';</script>";
 }
 else {
     echo "<script>window.location.href='admincomments.php?mode=admin';</script>";
 }


  include("../templateunten.php");
  ?>
