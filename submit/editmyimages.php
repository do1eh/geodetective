<?php

 
   include("../templateoben.php");  
   if(isset($mode) && $mode=='admin' && $_SESSION['role']=='admin') {
    
   if (isset($allimages)&& $allimages==1) {
    echo' Angezeigt werden alle Bilder.<br><br>';  
    echo'<button  onclick="window.location.href=\'editmyimages.php?mode=admin\'">Nur nicht freigegebe Bilder anzeigen</button>'; 
    $stmt = $conn->prepare("SELECT image.id id, user.id userid, image.filename,accepted,acceptedby,username,deadline,description FROM image join user on acceptedby=user.id WHERE  eventid=?   order by ordernumber,submitted");
    $stmt->bind_param("i", $_SESSION['eventid']);
    $stmt->execute();
    $result = $stmt->get_result(); 
    $_SESSION['allimages']=1;
  }
    else {
      
      echo' Angezeigt werden nur neue Bilder, die noch nicht freigegeben wurden!<br><br>';  
      echo'<button  onclick="window.location.href=\'editmyimages.php?mode=admin&allimages=1\'">Alle Bilder anzeigen</button>';    
      $stmt = $conn->prepare("SELECT image.id id, user.id userid, image.filename,accepted,acceptedby,username,deadline,description FROM image left join user on acceptedby=user.id WHERE  eventid=? and accepted=0 and acceptedby=0 order by ordernumber,submitted");
      $stmt->bind_param("i", $_SESSION['eventid']);
      $stmt->execute();
      $result = $stmt->get_result(); 
      $_SESSION['allimages']=0;
    
    }
  }

  ?>
                
<script>
function wirklichloeschen() {
    if (confirm("<?=reallydelete?>")) {
    this.form.submit();
  } else {
    return false;
  }
  
}
</script>

   <form action="editimage.php" method="post">
  



<?php   
  if(isset($mode) && $mode=='admin' && $_SESSION['role']=='admin') {


   //$sql="SELECT * FROM image WHERE  eventid='".$_SESSION['eventid']."' order by ordernumber,submitted";
   echo'<H1>Administratormodus</H1>';
  }
  else {
   
   $stmt = $conn->prepare("SELECT * FROM image WHERE userid=? and eventid=? and deadline=? order by ordernumber,submitted");
   $hival = hival;
   $stmt->bind_param("iis", $_SESSION['userid'], $_SESSION['eventid'], $hival);
   $stmt->execute();
   $result = $stmt->get_result();

   $datensaetze = $result->fetch_all(MYSQLI_ASSOC);
   
   if((isset($mode) && $mode!='admin') || $_SESSION['role']!='admin') {
   if($result->num_rows==0)
   {
    
    echo editmyimagesnomimages;
   }
   else {
      echo editmyimagesclickimage;
   }}

   foreach($datensaetze as $datensatz) {
    $filename=$datensatz['filename'];    
    $imageid=$datensatz['id'];     

    echo '
    <button type="submit" id="chosenimage" name="chosenimage" value="'.$imageid.'">
        <img src="../uploads/'.$filename.'" style="width: 100%;max-width: 200px;margin-top: 20px;">
      </button>    
    ';
    echo '<br><br>'.$datensatz['description'].' </b></font>';
    if (isset($mode) && $mode=='admin' && $_SESSION['role']=='admin') {
      $_SESSION['mode']='admin';
    //Allgemeine Infos
    
     

      if ($datensatz['accepted']==0 and $datensatz['acceptedby']==0) {
        echo '<br><br><b>'.pleaseaccept.'</b>'; 
      } else 
      if ($datensatz['accepted']==0 and $datensatz['acceptedby']>0) {
        echo '<br><br><font color=red><b> '.declinedby.' '.$datensatz['username'].' </b></font>'; 
      } else {
        if($datensatz['accepted']==1 and $datensatz['acceptedby']>0) {          
       
      echo '<br><br><font color=green><b>'.acceptedby.' '.$datensatz['username'].' </b></font>';          
        }
      }
      if($datensatz['deadline']!=hival) {
        echo '<br><br><font color=red><b>'.alreadyingame.'</b></font>'; 
      }


      echo '<br><br><button type="submit" id="accept" name="accept" value="'.$imageid.'">';
      if(!$datensatz['accepted']) {echo editmyimagesaccept;}else{echo editmyimagesdecline;};  
      echo'</button> ';
    }
    else {
      $_SESSION['mode']='';
    }
    
    

    echo '<br><br><button type="submit" id="turn" name="turn" value="'.$imageid.'">';
      echo editmyimagesturn;  
      echo'</button> ';

      echo '
    <button type="submit" id="chosenimage" name="chosenimage" value="'.$imageid.'">';
        echo editmyimage;
      echo'</button> ';

    echo'<button onclick="return wirklichloeschen()" id="delete" name="delete" value="'.$imageid.'">'.buttondelete.'</button>';
    

   


      echo'  
       <br> 
       <br> 
       ';
   }
   ?>

</form>

<button  onclick="window.location.href='../menu/main.php'"><?=buttonback?></button>




<?php
  include("../templateunten.php");
  ?>
