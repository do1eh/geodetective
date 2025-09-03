<?php
session_start();
 
   include("../templateoben.php");  

   if(isset($abbrechen)) {
    echo "<script>window.location.href='../menu/main.php';</script>";
    
    exit(1);
}

if(isset($editscoutgroup)) {
    echo "<script>window.location.href='editscoutgroup.php';</script>";
    
    exit(1);
}
  
  $sql="";
  if  (isset($username) and isset($password) ){
 $hash = password_hash($password, PASSWORD_DEFAULT);

 $stmt = $conn->prepare("SELECT * FROM user WHERE id<>? and username=?");
 $stmt->bind_param("is", $_SESSION['userid'], $username);
 $stmt->execute();
 $result = $stmt->get_result();
 $datensatz = $result->fetch_assoc();
 

if ($result->num_rows)  {
    echo "<script>window.location.href='configure.php?msg=errorusername';</script>";
   
     exit(1);
}else

if ($password!=$password2){
    echo "<script>window.location.href='configure.php?msg=errorpasswordidentity';</script>";
    exit(1);
} else 
  if (strlen($password)<6){
    echo "<script>window.location.href='configure.php?msg=errorpasswordlength';</script>";
    exit(1);
  }

  else {
$stmt = $conn->prepare("UPDATE user set username=?,  password=? where id=?");
$stmt->bind_param("ssi", $username, $hash, $_SESSION['userid']);
$stmt->execute();
  }
}

if  (isset($username) and !isset($password)){
 
        $stmt = $conn->prepare("UPDATE user set username=? where id=?");
        $stmt->bind_param("si", $username, $_SESSION['userid']);
        $stmt->execute();
}
echo "<script>window.location.href='../menu/main.php';</script>";

exit(1);
  



?>