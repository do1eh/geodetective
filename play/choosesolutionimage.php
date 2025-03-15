<?php

 
   include("../templateoben.php");  
   include("../user/loadevent.php");  
  ?>
   <h2><?=solutiontitle?></h2>
   
   
   <form action="solution.php" method="post">
  
<?php   
   
   $limit=0;

   $startzeit = new DateTime($_SESSION['starttimestamp']);
   $aktuellezeit = new DateTime();

   $aktuellezeitstring=date("Y-m-d H:i:s", $aktuellezeit->getTimestamp());
  
   

/*
Event:
Ein Event hat eine Start und Endezeit
Nach beginn der Startzeit wird das Event in Iatervalle aufgeteilt.
In jedem Intervall werden x weitere der eingereichten Bilder zum arten freigegeben.
Nach ablauf des Intervalls kann kein Tipp mehr abegegeben werden und die Lösung
sowie alle Tipps erscheinen unter "Ergebnisse".
Die Ergebnisse bleiben bis zum Eventende abrufbar. 
*/
  
   //event läuft
    if ($startzeit<$aktuellezeit )
   {
    
    //intervallnummer bestimmen: aktuellezeit-startzeitpunkt in stunden / interval
    $diff_mins = abs($startzeit->getTimestamp() - $aktuellezeit->getTimestamp()) / 60;
    $diff_hours=floor($diff_mins/60);  
    $intervallnummer=floor($diff_hours/$_SESSION['interval'])+1; 
    //anzahl der bereits veröffentlichen Bilder:
    $bildanzahlpublished=$intervallnummer*$_SESSION['imagesperinterval'];
    //anzahl der Bilder deren Dealine bereits abgelaufen ist
    $bildanzahldeadline=($intervallnummer-1)*($_SESSION['imagesperinterval']);
       
     
   }

     
   //$sql="SELECT * FROM image WHERE eventid='".$_SESSION['eventid']."' and accepted=1  order by submitted limit ".$bildanzahldeadline ;
   //$sql="SELECT * FROM image WHERE eventid='".$_SESSION['eventid']."' and accepted=1  and deadline <'".$aktuellezeitstring."' order by submitted";
   $sql="SELECT image.id,deadline,description,name,contact,filename,solutiontext FROM image join user on image.userid=user.id join scoutgroup on user.scoutgroup=scoutgroup.id WHERE eventid='".$_SESSION['eventid']."' and accepted=1  and deadline <'".$aktuellezeitstring."' order by submitted desc";
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
      </div>      ';
   }

   
   ?>

</form>

<button  onclick="window.location.href='../menu/main.php'"><?=buttonback?></button>




<?php
  include("../templateunten.php");
  ?>
