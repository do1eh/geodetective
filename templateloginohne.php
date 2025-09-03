<?php
declare(strict_types=1);
session_start();
include('credentials.php');

$conn = mysqli_connect($server, $user, $pass,$dbase);

 if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
  
  //Alle GET Variablen einlesen
  

  if (!isset($_SESSION['language'])) {
    $_SESSION['language']='de';
  }
  
  //include('../locale/' . $_SESSION['language'] . '.php');
  
  ?>
  
  
  
  

  
  





