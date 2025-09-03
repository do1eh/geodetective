<?php
session_start();
 
   include("../templateloginohne.php");  

   $_SESSION['language'] = $language;
   include('../locale/' . $_SESSION['language'] . '.php');
  
   if  (isset($username) and isset($password)){
      
$stmt = $conn->prepare("SELECT * FROM user WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$datensatz = $result->fetch_assoc();

if(isset($register)) {
    echo "<script>window.location.href='registerscoutgroup.php';</script>";
    exit(1);
}


if(password_verify($password, $datensatz['password']) && $username==$datensatz['username']) 
{
    //echo 'Passwort stimmt!';
    $_SESSION['userid'] = $datensatz['id'];
    $_SESSION['role'] = $datensatz['role'];
    $_SESSION['userscoutgroup'] = $datensatz['scoutgroup'];

    
    
    include("loadevent.php");  

    
       
    echo "<script>window.location.href='../menu/main.php';</script>";
    exit;
    //header('location: ../menu/main.php');
    // exit(1);
} 
else
{
    //echo 'Passwort ist falsch!';
    
    //echo "<script>window.location.href='../splashscreen.php?msg=".htmlentities(errorwrongpassword, ENT_HTML5  , 'UTF-8')."';</script>";
    echo "<script>window.location.href='../splashscreen.php?msg=errorwrongpassword';</script>";
    exit;
    //header('location: ../splashscreen.php?msg='.errorwrongpassword);
    // exit(1);
}
}

?>
