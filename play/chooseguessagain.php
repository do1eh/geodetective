<?php
session_start();

   include("../templateoben.php");  
   include("../user/loadevent.php");  
 

$limit=0;
date_default_timezone_set('Europe/Berlin'); 
$startzeit = new DateTime($_SESSION['starttimestamp']);
$startzeit=$startzeit->getTimestamp();
$aktuellezeit = new DateTime();
$aktuellezeit=$aktuellezeit->getTimestamp();
$datum=date("Y-m-d ", $aktuellezeit);
$nachmittag=false;
$morgen=strtotime("tomorrow");
$datummorgen=date("Y-m-d ", $morgen);
if (date("a", $aktuellezeit)=='pm')
{
   $nachmittag=true;
}


//Nacht
$startnachtstring=$datum.$_SESSION['startnight'];
$startnacht=new DateTime($startnachtstring);
$startnacht=$startnacht->getTimestamp();
$endnachtstring=$datum.$_SESSION['endnight'];
if($nachmittag){
   $endnachtstring=$datummorgen.$_SESSION['endnight'];
} 
$endnacht=new DateTime($endnachtstring);
$endnacht=$endnacht->getTimestamp();

$night=false;
if ($startnacht<$aktuellezeit && $aktuellezeit<$endnacht)
{
     $night=true;
} 
$deadline=new DateTime($datum);

if (!$night) {
 //$deadline=$aktuellezeit+(4*60*60);
 $deadline=$aktuellezeit+($_SESSION['interval']*60*60);
}else{
 $deadline=$endnacht;
}

$deadlinestring=date("Y-m-d H:i:s", $deadline);

/*
Event:
Ein Event hat eine Start und Endezeit
Nach beginn der Startzeit wird das Event in Intervalle aufgeteilt.
In jedem Intervall werden x weitere der eingereichten Bilder zum arten freigegeben.
Nach ablauf des Intervalls kann kein Tipp mehr abegegeben werden und die Lösung
sowie alle Tipps erscheinen unter "Ergebnisse".
Die Ergebnisse bleiben bis zum Eventende abrufbar. 
*/

//event läuft
if ($startzeit<=$aktuellezeit )
{
 
 //intervallnummer bestimmen: aktuellezeit-startzeitpunkt in stunden / interval
 //$diff_mins = abs($startzeit - $aktuellezeit) / 60;

 //$diff_hours=floor($diff_mins/60);  
 //$intervallnummer=floor($diff_hours/$_SESSION['interval'])+1; 
 //anzahl der bereits veröffentlichen Bilder:
 //$bildanzahlpublished=$intervallnummer*$_SESSION['imagesperinterval'];
 //anzahl der Bilder deren Dealine bereits abgelaufen ist
 //$bildanzahldeadline=($intervallnummer-1)*($_SESSION['imagesperinterval']);
 //$deadline=$startzeit+($_SESSION['interval']*3600);
 //$deadlinestring= date("Y-m-d H:i:s", $deadline); 
 
 //Neues Konzept zeige immer #imagesperinverval bilder deren deadline nicht erreicht ist
 //Alle dieser Bilder die dealine=hivalue haben deadline=jetzt+intervalldauer
 //Wenn NAchtruhe dann deadline=ende der Nachtruhe
 
 
 


 
 echo' 
 <h2>'.guessmaintitle.'</h2>

   
   <form action="guess.php" method="post">
';
  
//$sql="SELECT * FROM image WHERE eventid='".$_SESSION['eventid']."' and accepted=1  order by submitted limit ".$bildanzahlpublished." offset ".$bildanzahldeadline ;
//$sql="SELECT * FROM image WHERE eventid='".$_SESSION['eventid']."' and accepted=1 ";
$stmt = $conn->prepare("SELECT image.id,deadline,description,name,contact,filename,guess.userid guessed FROM image join user on image.userid=user.id join scoutgroup on user.scoutgroup=scoutgroup.id left join guess on image.id=guess.imageid and guess.userid =? WHERE eventid=? and accepted=1  and deadline> CURRENT_TIMESTAMP()  and not guess.userid is null order by ordernumber,image.submitted limit ?");
$stmt->bind_param("iii", $_SESSION['userid'], $_SESSION['eventid'], $_SESSION['imagesperinterval']);
$stmt->execute();
$result = $stmt->get_result();

   $datensaetze = $result->fetch_all(MYSQLI_ASSOC);
   
   
   if($result->num_rows==0)
   {
      echo guessnoimages;
   }
   else {
echo guessexplain; echo'<br>';
   }
   foreach($datensaetze as $datensatz) {
    //Deadline neu setzen
    if ($night || $datensatz['deadline']=='2035-12-31 00:00:00'){
    $stmt = $conn->prepare("update image set deadline=? where id=?");
    $stmt->bind_param("si", $deadlinestring, $datensatz['id']);
    $stmt->execute();
    $datensatz['deadline']=$deadlinestring;
    }
    
    
    //Bilder anzeigen
    $filename=$datensatz['filename'];    
    $imageid=$datensatz['id'];     

    echo '
    <button type="submit" id="chosenimage" name="chosenimage" value="'.$imageid.'">
        <img src="../uploads/'.$filename.'" style="width: 100%;max-width: 200px;margin-top: 20px;">
      </button>    
    <br><br>';  
    
     if (null!=$datensatz['guessed']){
      echo'Bereits geraten!<br><br>';
     }
    echo' '.$datensatz['description'].'
    <br><br>
    '.guesssubmittedby.' '.$datensatz['name'].' 
    <br><br> 
    '.guesscontact.' '.$datensatz['contact'];
    echo'<br><br> ';
    echo guessuntil; 
    echo' '.$datensatz['deadline'].' 
    <br><br> 
        
       <br> 
       <br> 
       ';
   }
} //ende event läuft 
else {
  echo'<h1>'; 
  echo gamestart;
  echo'<br>';
  echo date("Y-m-d H:i:s", $startzeit);
  echo'</h1><br>';
  echo uploaduntilstart;
  echo"<br><br><button  onclick=\"window.location.href='../submit/submitimage.php'\">".buttonuploaduntilstart."</button>";
  

}
   ?>

</form>
<button  onclick="window.location.href='chooseguessimage.php'"><?=buttonback?></button>





<?php
  include("../templateunten.php");
  ?>
