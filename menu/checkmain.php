<?php
 
   include("../templateoben.php");  


  
   if(isset($admin)) {
     echo "<script>window.location.href='../admin/admin.php';</script>"; 
    //header('location: ../admin/admin.php');
     exit(1);
}


if(isset($spielen)) {
     echo "<script>window.location.href='../play/chooseguessimage.php';</script>";
    //header('location: ../play/chooseguessimage.php');
     exit(1);
}

if(isset($einreichen)) {
     echo "<script>window.location.href='../submit/mypictures.php';</script>";
    //header('location: ../submit/mypictures.php');
     exit(1);
}
if(isset($ergebnisse)) {
     echo "<script>window.location.href='../play/choosesolutionimage.php';</script>";
    //header('location: ../play/choosesolutionimage.php');
     exit(1);
}

if(isset($einstellungen)) {
     echo "<script>window.location.href='../user/configure.php';</script>";
    //header('location: ../user/configure.php');
     exit(1);
}
if(isset($abmelden)) {
    session_destroy();
    echo "<script>window.location.href='../index.php';</script>";
    //header('location: ../splashscreen.php');
     exit(1);
}

?>