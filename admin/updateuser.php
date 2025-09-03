<?php
session_start();
 
   include("../templateoben.php");  
   if ($_SESSION['role']!='admin' ) {
    echo "<script>window.location.href='../menu/main.php';</script>";
    exit(1);
 } 
 $edituserid=$_SESSION['edituserid'];      

$stmt = $conn->prepare("SELECT * FROM user WHERE id<>? and username=?");
$stmt->bind_param("is", $edituserid, $username);
$stmt->execute();
$result = $stmt->get_result();
$datensatz = $result->fetch_assoc();

if ($result->num_rows)  {
    echo "<script>window.location.href='edituser.php?msg=".htmlentities("Der Username existiert bereits. Bitte wähle einen anderen.")."';</script>";
    //header("location: edituser.php?msg='Der Username existiert bereits. Bitte wähle einen anderen.");
     exit(1);
}


if ($password<>"*****") {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("update user set username=?, scoutgroup=?,role=?, password=? where id=?");
    $stmt->bind_param("ssssi", $username, $scoutgroup, $role, $hash, $edituserid);
    $stmt->execute();
}
else {
    $stmt = $conn->prepare("update user set username=?, scoutgroup=?,role=? where id=?");
    $stmt->bind_param("sssi", $username, $scoutgroup, $role, $edituserid);
    $stmt->execute();
}

echo "<script>window.location.href='adminuser.php';</script>";
//header("location: adminuser.php");
exit(1);
  



?>