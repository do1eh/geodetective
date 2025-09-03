<?php

 
   include("../templateoben.php");  
   require_once('GeoImage.php');

   function moveElement($array, $fromIndex, $toIndex) {
    $out = array_splice($array, $fromIndex, 1);
    array_splice($array, $toIndex, 0, $out);
    return $array;
}

function moveup($array, $fromIndex) {
   if($fromIndex==0) return;
    return moveElement($array, $fromIndex, $fromIndex-1);
}
 
function movedown($array, $fromIndex) {
   if($fromIndex==count($array)-1) return;
    return moveElement($array, $fromIndex, $fromIndex+1);
}

 
   $stmt = $conn->prepare("SELECT * FROM image WHERE  eventid=? and deadline> CURRENT_TIMESTAMP() order by ordernumber,submitted");
  
  $stmt->bind_param("i", $_SESSION['eventid']);
  $stmt->execute();
  $result = $stmt->get_result();

   $datensaetze = $result->fetch_all(MYSQLI_ASSOC);
   if($result->num_rows==0)
   {
      echo editmyimagesnomimages;
   }
   else {
      echo editmyimagesclickimage;
   
   
   $images = array();
   
    $order=0;
   //Datensaätze in Array schreiben
   foreach($datensaetze as $datensatz) {
    
    $gdImage=new GeoImage();
    $gdImage->setId($datensatz['id']);
    $gdImage->setEventId($datensatz['eventid']);
    $gdImage->setUserId($datensatz['userid']);
    $gdImage->setLat($datensatz['lat']);
    $gdImage->setLon($datensatz['lon']);
    $gdImage->setDescription($datensatz['description']);
    $gdImage->setSubmitted($datensatz['submitted']);
    $gdImage->setAccepted($datensatz['accepted']);
    $gdImage->setOrderNumber($datensatz['ordernumber']);
    $gdImage->setDeadline($datensatz['deadline']);
    $gdImage->setFilename($datensatz['filename']);
    $gdImage->setSolutionText($datensatz['solutiontext']);
    $gdImage->setAcceptedBy($datensatz['acceptedby']);
    $gdImage->setAccepttime($datensatz['accepttime']);

    $images[]=$gdImage;
    
    
    
   }
   
   
   if(isset($_POST['up'])) {
    
    $id=$_POST['up'];
    $images=moveup($images, $id);
    echo'hier';
    }

      if(isset($_POST['down'])) {
       
      $id=$_POST['down'];
      $images=movedown($images, $id);
      }   

   //Array sortiert speichern
    $index=0;
    foreach($images as $gdImage) {
      
     
      $stmt = $conn->prepare("UPDATE image SET ordernumber=? WHERE id=?");
      $stmt->bind_param("ii", $index, $gdImage->getId());
      $stmt->execute();
      $index++;
      //echo $sql.'<br>';
    }
     
    //zurück zu adminsortimages.php
    echo "<script>window.location.href='adminsortimages.php';</script>";   


     
}
  


  include("../templateunten.php");
  ?>
