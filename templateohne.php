<?php
//Sprache
declare(strict_types=1);
session_start();
//Wenn nicht angemeldet zurück zur Anmeldung
if (!isset($_SESSION['userid'])) {
    session_destroy();
    echo "<script>window.location.href='../splashscreen.php';</script>";
    //header('location: ../splashscreen.php');
     exit(1);
}
include('credentials.php');


$conn = mysqli_connect($server, $user, $pass,$dbase);

 if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
  
  //Alle GET Variablen einlesen
  
  
  if (!isset($_SESSION['language'])) {
    $_SESSION['language']='de';
  }

  include('../locale/' . $_SESSION['language'] . '.php');
  ?>
  
  





