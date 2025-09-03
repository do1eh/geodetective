<?php
session_start();
 
   include("../templateoben.php");  
   if ($_SESSION['role']!='admin' ) {
    echo "<script>window.location.href='../menu/main.php';</script>";
    exit(1);
 } 
   if (isset($_POST['edit'])) {
    $groupid=$_POST['edit'];
    $stmt = $conn->prepare("SELECT * from scoutgroup WHERE id=?");
    $stmt->bind_param("i", $groupid);
    $stmt->execute();
    $groupresult = $stmt->get_result();
    $groupdatensatz = $groupresult->fetch_assoc();
    $_SESSION['groupid']=$groupid;
    
}else
if (isset($_POST['delete'])) {
  $groupid=$_POST['delete'];
    
    //Gruppe löschen
    
    
    $stmt = $conn->prepare("delete from scoutgroup  WHERE id=?");
    $stmt->bind_param("i", $groupid);
    $stmt->execute();

    
    echo "<script>window.location.href='adminscoutgroup.php';</script>"; 
    //header('location: adminscoutgroup.php');
    
    }


   ?>

<center>


<h1>Gruppe Ändern</h1>

 
    <form action="updategroup.php" method="post">
    
        <label for="name">Name:</label> 
        <input type="text" name="name" value="<?=$groupdatensatz['name']?>" required><br>
        <label for="association">Verband:</label> 
        <input type="text" name="association" value="<?=$groupdatensatz['association']?>" required><br>
        <label for="city">Stadt:</label> 
        <input type="text" name="city" value="<?=$groupdatensatz['city']?>" required><br>
        
        Land:
        <select id="country" name="country" required>
          <?php
          echo'<option value="Schweiz" ';
          if ($groupdatensatz['country']=="Schweiz") {echo'selected ';}
          echo'>Schweiz</option>';
          
          echo'<option value="Deutschland" ';
          if ($groupdatensatz['country']=="Deutschland") {echo'selected ';}
          echo'>Deutschland</option>';

          echo'<option value="Österreich" ';
          if ($groupdatensatz['country']=="Österreich") {echo'selected ';}
          echo'>Österreich</option>';

          echo'<option value="Luxemburg" ';
          if ($groupdatensatz['country']=="Luxemburg") {echo'selected ';}
          echo'>Luxemburg</option>';
          ?>
            
             
        </select><br><br>
        <label for="jid">JID-Code:</label> 
        <input type="text" name="jid" value="<?=$groupdatensatz['jid']?>">  <br>
        <label for="contact">Kontakt:</label> 
        <input type="text" name="contact" value="<?=$groupdatensatz['contact']?>">  
        <?php
        if(isset($msg)) {
         echo'<span style="color:red;">'.$msg.'<br></span>';
       }
       ?>  
       <br><br>
        <button type="submit">Pfadfindergruppe ändern</button><br><br>
        
    </form>
    <button  onclick="window.location.href='adminscoutgroup.php'">Zurück</button>


</center>

<?php
  include("../templateunten.php");
  ?>
