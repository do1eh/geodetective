<?php
/*
 * Created on 27.10.2024
 * updated on 27.10.2024
 *
 
 */#

  include("../templaterefresh.php");

  //$sql="SELECT image.id,guess.userid FROM image join left join guess on imager.id=imageid where eventid='".$_SESSION['eventid']."' and accepted=1  and deadline> CURRENT_TIMESTAMP()  limit ".$_SESSION['imagesperinterval'];   
//$result = $conn->query($sql);

   //var openguesses= $result->num_rows
   //Anzahl der Aktiven Bilder für die der USer noch keinen Tipp abgegeben hat
   $stmt = $conn->prepare("SELECT count(*) as openguesses FROM image left join guess on image.id=guess.imageid and guess.userid =? WHERE image.eventid=? and accepted=1  and deadline > CURRENT_TIMESTAMP() and guess.userid is null order by ordernumber,image.submitted limit ?");   
   
   $stmt->bind_param("iii", $_SESSION['userid'], $_SESSION['eventid'], $_SESSION['imagesperinterval']);
   $stmt->execute();
   $result = $stmt->get_result();
   $datensatz = $result->fetch_assoc();
   $openguesses=$datensatz['openguesses'];
   $openguessestext=$openguesses." ".menunewimages;
   
   if ($openguesses=="0") {
      $openguessestext=menunonewimages;
   } 
   if ($openguesses=="1") {
      $openguessestext=menunewimage;
   } 
   

  ?>

<center>


<h1><?=menutitle?></h1>
    <form action="checkmain.php" method="post">
 <?php
       
 if ($_SESSION['role']=='admin'|| $_SESSION['role']=='moderator') {
 echo'<button type="submit" name="admin">'.menuadmin.'</button><br><br>';
 }

 if($openguesses=="0")
 {
   echo'<div style="background-color:rgb(235, 123, 129);max-width: 200px; padding:15px">';
 }else {
    echo'<div style="background-color:rgb(160, 233, 137);max-width: 200px; padding:15px">';
 }
 ?>
 
 <button type="submit" name="spielen"><?=menuplay?></button><br><br>
 <?=$openguessestext?>
</div>
 <br>
 <button type="submit" name="einreichen"><?=menumyimages?></button><br><br>
 <button type="submit" name="ergebnisse"><?=menusolution?></button><br><br>
 <button type="submit" name="einstellungen"><?=menuoptions?></button><br><br>
 <button type="submit" name="abmelden"><?=menulogout?></button>
    </form>



</center>

<?php
  include("../templateunten.php");
  ?>
