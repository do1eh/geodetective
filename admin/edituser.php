<?php
session_start();
 
   include("../templateoben.php");  
   if ($_SESSION['role']!='admin' ) {
    echo "<script>window.location.href='../menu/main.php';</script>";
    exit(1);
 } 
   if (isset($edit)) {
    $edituserid=$_POST['edit'];
    $stmt = $conn->prepare("SELECT * from user WHERE id=?");
    $stmt->bind_param("i", $edituserid);
    $stmt->execute();
    $userresult = $stmt->get_result();
    $userdatensatz = $userresult->fetch_assoc();
    $_SESSION['edituserid']=$edituserid;

   

    
}else
if (isset($delete)) {
  $edituserid=$_POST['delete'];
    
    //user löschen
    
    
    $stmt = $conn->prepare("delete from user  WHERE id=?");
    $stmt->bind_param("i", $edituserid);
    $stmt->execute();

    
    echo "<script>window.location.href='adminuser.php';</script>"; 
    //header('location: adminuser.php');
    exit(1);

    }else if (isset($_SESSION['edituserid'])) {
        $edituserid=$_SESSION['edituserid'];
        $stmt = $conn->prepare("SELECT * from user WHERE id=?");
        $stmt->bind_param("i", $edituserid);
        $stmt->execute();
        $userresult = $stmt->get_result();
        $userdatensatz = $userresult->fetch_assoc();
    }


   ?>

<center>


<h1>User Ändern</h1>

 
    <form action="updateuser.php" method="post">
    
        <label for="username">Name:</label> 
        <input type="text" name="username" value="<?=$userdatensatz['username']?>" required><br>
        <label for="scoutgroup">Gruppe:</label> 
        <select id="scoutgroup" name="scoutgroup"> 
        <?php
             $result = $conn->query("SELECT * FROM scoutgroup");
             $datensaetze = $result->fetch_all(MYSQLI_ASSOC);
             foreach($datensaetze as $datensatz) {
             echo '<option value = "'.$datensatz["id"].'"';
             if ($datensatz["id"]==$userdatensatz["scoutgroup"]) {echo' selected ';}
             echo'>' .$datensatz["name"] .' ('.$datensatz["association"].') </option>';
       }
       echo '</select><br><br>';
    ?>
        
        
        <label for="password">Passwort:</label> 
        <input type="text" name="password" value="*****" required><br>
        
        Rolle:
        <select id="role" name="role" required>
          <?php
          echo'<option value="user" ';
          if ($userdatensatz['role']=="user") {echo' selected ';}
          echo'>user</option>';
          
          echo'<option value="moderator" ';
          if ($userdatensatz['role']=="moderator") {echo' selected ';}
          echo'>moderator</option>';

          echo'<option value="admin" ';
          if ($userdatensatz['role']=="admin") {echo' selected ';}
          echo'>admin</option>';         
          ?>
        </select><br><br>
        
        <?php
        if(isset($msg)) {
         echo'<span style="color:red;">'.$msg.'<br></span>';
       }
       ?>  
       <br><br>
        <button type="submit">User ändern</button><br><br>
        
    </form>
    <button  onclick="window.location.href='adminuser.php'">Zurück</button>


</center>

<?php
  include("../templateunten.php");
  ?>
