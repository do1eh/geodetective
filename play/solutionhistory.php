<?php

 
   include("../templateoben.php");  
   include("../user/loadevent.php");  

   
  ?>
   <center>
   <h2><?=solutiontitle?></h2>
   
   
   <form action="solution.php" method="post">
  
<?php   
   
   $limit=0;
   date_default_timezone_set('Europe/Berlin');
   $startzeit = new DateTime($_SESSION['starttimestamp']);
   $aktuellezeit = new DateTime();

   $aktuellezeitstring=date("Y-m-d H:i:s", $aktuellezeit->getTimestamp());
  
   



     
   //$sql="SELECT * FROM image WHERE eventid='".$_SESSION['eventid']."' and accepted=1  order by submitted limit ".$bildanzahldeadline ;
   //$sql="SELECT * FROM image WHERE eventid='".$_SESSION['eventid']."' and accepted=1  and deadline <'".$aktuellezeitstring."' order by submitted";
   $sql="SELECT image.id,deadline,description,name,contact,filename,solutiontext FROM image join user on image.userid=user.id join scoutgroup on user.scoutgroup=scoutgroup.id WHERE eventid='".$historyeventid."' and accepted=1  and deadline <'".$aktuellezeitstring."' order by submitted desc";
   $result = $conn->query($sql);
   

   if($result->num_rows==0)
   {
      echo solutionnoresults;
   }
   else {
      echo solutionresults;
   }

   $datensaetze = $result->fetch_all(MYSQLI_ASSOC);
   foreach($datensaetze as $datensatz) {
    $filename=$datensatz['filename'];    
    $imageid=$datensatz['id']; 
     

    echo '
    <div style="background-color:lightgray;padding: 25px 25px 25px 25px ;margin: 25px 25px 25px 25px;max-width: 300px;">
    <button onclick="window.location.href=\'showimage.php?imageid='.$imageid.'\' ;return false;">
        <img src="../uploads/'.$filename.'" style="width: 100%;max-width: 200px;margin-top: 20px;">
      </button>
      <br><br>
      
       <button type="submit" id="chosenimage" name="chosenimage" value="'.$imageid.'">
        '.solutionlist.'
      </button> 
      <br><br>
    '.guesssubmittedby.' '.$datensatz['name'].' 
     
      <br><br>
      '.solutionimagdescription.':
      <br>
    '.$datensatz['description'].'
    <br><br>
    '.solutiontitle.':
    <br>
        '.$datensatz['solutiontext'].'
   <br><br>';

   // Kommentare
   $commentsql="SELECT * FROM comment join user on comment.userid=user.id WHERE imageid=".$imageid." and accepted=1 order by submitted desc limit 2";

   $commentresult = $conn->query($commentsql);

   if($commentresult->num_rows>0)
   {
      $kommentare = $commentresult->fetch_all(MYSQLI_ASSOC);
      foreach($kommentare as $kommentar) {
         echo '<br><br><b>'.$kommentar['username'].' ';
         echo $kommentar['submitted'];
         echo ':</b><br>';

         echo $kommentar['text'];
      }
   }
   echo '</div>';
  }
   ?>

</form>
<button  onclick="window.location.href='../menu/main.php'"><?=buttonback?></button>
</center>



<?php
  include("../templateunten.php");
  ?>
