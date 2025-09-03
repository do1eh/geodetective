<?php
/*
 * Created on 31.12.2024
 * updated on 31.12.2024
 *
 
 */#

  
  include("../templateoben.php");
  if ($_SESSION['role']!='admin' && $_SESSION['role']!='moderator') {
    echo "<script>window.location.href='../menu/main.php';</script>";
    exit(1);
 } 
//Anzahl der freizugebenen Bilder 
$stmt = $conn->prepare("SELECT count(*) as imagetoaccept FROM image WHERE eventid=? and acceptedby=0 order by submitted desc");   
$stmt->bind_param("i", $_SESSION['eventid']);
$stmt->execute();
$result = $stmt->get_result();
$datensatz = $result->fetch_assoc();
$imagetoaccept=$datensatz['imagetoaccept'];
$imagetoaccepttext=$imagetoaccept." ".menunewimages;

if ($imagetoaccept=="0") {
   $imagetoaccepttext=menunonewimages;
} 
if ($imagetoaccept=="1") {
   $imagetoaccepttext=menunewimage;
} 

//Anzahl der freizugebenen Kommentare 
$stmt = $conn->prepare("SELECT count(*) as commenttoaccept FROM comment join image on imageid=image.id WHERE eventid=? and comment.acceptedby=0 order by comment.submitted desc");   
$stmt->bind_param("i", $_SESSION['eventid']);
$stmt->execute();
$result = $stmt->get_result();
$datensatz = $result->fetch_assoc();
$commenttoaccept=$datensatz['commenttoaccept'];
$commenttoaccepttext=$commenttoaccept." ".menuacceptcomments;

if ($commenttoaccept=="0") {
   $commenttoaccepttext=menunoacceptcomments;
;
} 
if ($commenttoaccept=="1") {
   $commenttoaccepttext=menuacceptcomment;
} 



?>

<center>


<h1>Administration</h1>
    <form action="checkadmin.php" method="post">
 
<?php
 if ($_SESSION['role']=='admin') {
  echo'
 <button type="submit" name="adminuser">'.adminmenuuser.'</button><br><br>
 <button type="submit" name="admingroup">'.adminmenugroup.'</button><br><br>
 <button type="submit" name="adminevent">'.adminmenuevent.'</button><br><br>
 ';
 }
 if($imagetoaccept=="0")
 {
   echo'<div style="background-color:rgb(235, 123, 129);max-width: 200px; padding:15px">';
 }else {
    echo'<div style="background-color:rgb(160, 233, 137);max-width: 200px; padding:15px">';
 }
  ?>
 <button type="submit" name="images"><?=adminmenuimages?></button><br><br>
 <?=$imagetoaccepttext?>
</div><br>
 <button type="submit" name="sortimages"><?=adminsort?></button><br><br>
 
 <?php
 if($commenttoaccept=="0")
 {
   echo'<div style="background-color:rgb(235, 123, 129);max-width: 200px; padding:15px">';
 }else {
    echo'<div style="background-color:rgb(160, 233, 137);max-width: 200px; padding:15px">';
 }
  ?>
 <button type="submit" name="admincomments">Kommentare verwalten</button><br><br>
 <?=$commenttoaccepttext?>
 </div><br>


 <button type="submit" name="back"><?=adminmenuback?></button>

 </form>



</center>

<?php
  include("../templateunten.php");
  ?>
