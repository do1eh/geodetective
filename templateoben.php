<?php
//Sprache
declare(strict_types=1);

if(session_status() !== PHP_SESSION_ACTIVE) session_start();

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
  
  
  
//globale Variablen
define("hival", "2035-12-31 00:00:00");

  //if (!isset($_SESSION['language'])) {
  //  $_SESSION['language']='de';
  //}

  if (!isset($_SESSION['language'])) {
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $acceptLang = ['fr', 'it', 'en', 'de', 'nl']; 
    $lang = in_array($lang, $acceptLang) ? $lang : 'de';
    $_SESSION['language']=$lang;
  }


  include('../locale/' . $_SESSION['language'] . '.php');
      
  ?>
  
  
  
  

  
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//DE">
  <html>
  <head>
  
  <title>JOTA-JOTI Geodetective</title>
  <meta http-equiv="content-type" content= "text/html; iso-8859-1">
  <meta name="robots" content= "INDEX,FOLLOW">
  <meta http-equiv="content-language" content= "de">
  <meta name="keywords" content= "JOTA, JOTI, Pfadfinder, Scouts, Spiel, ">
  <meta name="author" content= "Ralf Lüsebrink">
  <meta name="publisher" content= "Ralf Lüsebrink">
  <link rev="made" content= "rnh@gmx.net">
  <meta name="copyright" content= "Ralf Lüsebrink">
  <meta name="audience" content= "Alle">
  <meta name="page-type" content= "Spiel für Pfadfinder">
  <meta name="page-topic" content= "Spiel zum JOTA">
  <meta name="revisit after" content= "7 days">
  <META NAME="Description" CONTENT="Jamboree in the Air and Internet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="SHORTCUT ICON" href="../favicon.ico">
  <link rel="stylesheet" href="../main.css">
    
  </head>
  
  
  
  <body> 





