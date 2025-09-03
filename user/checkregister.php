<?php
session_start();
 
   include("../templatelogin.php");  

  
  if  (isset($username) and isset($password)){
     
$stmt = $conn->prepare("SELECT * FROM user WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$datensatz = $result->fetch_assoc();
//$hash = password_hash($password, PASSWORD_DEFAULT);

if ($result->num_rows)  {
  echo "<script>window.location.href='register.php?msg=errorusername&scoutgroup=$scoutgroup';</script>";
    //header("location: register.php?msg=".errorusername);
     exit(1);
}

if ($password!=$password2){
    echo "<script>window.location.href='register.php?msg=errorpasswordidentity&scoutgroup=$scoutgroup';</script>";
    //header("location: register.php?msg=".errorpasswordidentity);
     exit(1);
}

if (strlen($password)<6){
  echo "<script>window.location.href='register.php?msg=errorpasswordlength&scoutgroup=$scoutgroup';</script>";
  //header("location: register.php?msg=".errorpasswordidentity);
   exit(1);
}

//Wenn alle OK ist, User anlegen
$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO user (username, scoutgroup,password) VALUES (?, ?, ?)");
$stmt->bind_param("sis", $username, $scoutgroup, $hash);
$stmt->execute();

//und einloggen
 
echo "<script>window.location.href='login.php?username=".$username."&password=".$password."&language=".$_SESSION['language']."';</script>";
//header("location: login.php?username=".$username."&password=".$password);
exit(1);
}  



?>
