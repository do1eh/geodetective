<?php
include("../templateohne.php");  
 



if (isset($accept)) {
    $commentid=$_POST['accept'];
    $sql="update comment set accepted= NOT accepted, acceptedby=".$_SESSION['userid']." WHERE id='".$commentid."'";
    $conn->query($sql);
}else
if (isset($delete)) {
    $commentid=$_POST['delete'];
    $sql="delete from comment  WHERE id='".$commentid."'";
    $conn->query($sql);
    
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
