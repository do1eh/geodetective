<?php
session_start();
 
   include("../templateoben.php");  
  
    $stmt = $conn->prepare("SELECT * from scoutgroup WHERE id=?");
    $stmt->bind_param("i", $_SESSION['userscoutgroup']);
    $stmt->execute();
    $groupresult = $stmt->get_result();
    $groupdatensatz = $groupresult->fetch_assoc();
?>

<center>


<h1><?=changegroup?></h1>

 
    <form action="updategroup.php" method="post">
    
        <label for="name"><?=registergroupname?>:</label> 
        <input type="text" name="name" value="<?=$groupdatensatz['name']?>" disabled><br>
        <label for="association"><?=registergroupassociation?>:</label> 
        <input type="text" name="association" value="<?=$groupdatensatz['association']?>" required><br>
        <label for="city"><?=registergroupcity?></label> 
        <input type="text" name="city" value="<?=$groupdatensatz['city']?>" required><br>
        
        <?=registergroupcountry?>:
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
        <label for="jid"><?=registergroupjid?></label> 
        <input type="text" name="jid" value="<?=$groupdatensatz['jid']?>">  <br>
        <label for="contact"><?=registergroupcontact?></label> 
        <input type="text" name="contact" value="<?=$groupdatensatz['contact']?>">  
        <?php
        if(isset($msg)) {
         echo'<span style="color:red;">'.$msg.'<br></span>';
       }
       ?>  
       <br><br>
        <button type="submit"><?=changegroup?></button><br><br>
        
    </form>
    <button  onclick="window.location.href='configure.php'"><?=buttonback?></button>


</center>

<?php
  include("../templateunten.php");
  ?>
