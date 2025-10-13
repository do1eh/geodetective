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

 
   $sql="SELECT * FROM image WHERE  eventid='".$_SESSION['eventid']."' and accepted=1 and deadline> CURRENT_TIMESTAMP() order by ordernumber,submitted";
  
  
   $result = $conn->query($sql);

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
      
     
      $sql="UPDATE image SET ordernumber='".$index."' WHERE id='".$gdImage->getId()."'";
      $conn->query($sql);
      $index++;
      //echo $sql.'<br>';
    }
     
    //zurück zu adminsortimages.php
    echo "<script>window.location.href='adminsortimages.php';</script>";   


     
}
  


  include("../templateunten.php");
  ?>
