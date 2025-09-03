<?php

 
   include("../templateoben.php");  
   if ($_SESSION['role']!='admin' && $_SESSION['role']!='moderator') {
    echo "<script>window.location.href='../menu/main.php';</script>";
    exit(1);
 } 
   if (isset($allcomments)) {
    echo'<button  onclick="window.location.href=\'admincomments.php\'">Nur nicht freigegebe Kommentare anzeigen</button>'; 
    $stmt = $conn->prepare("SELECT comment.id,filename,user.username,comment.submitted,comment.accepted,comment.text, admin.username adminname, comment.acceptedby 
          FROM comment 
          left join user on comment.userid=user.id 
          left join user admin on comment.acceptedby=admin.id 
          left join image on comment.imageid=image.id 
          WHERE image.eventid=?
          order by comment.submitted desc");
$stmt->bind_param("i", $_SESSION['eventid']);
$stmt->execute();
$result = $stmt->get_result();
    $_SESSION['allcomments']=1;
    
    
  } 
    
    else {
      echo'<button  onclick="window.location.href=\'admincomments.php?allcomments=1\'">Alle Kommentare anzeigen</button>';    
      $stmt = $conn->prepare("SELECT comment.id,filename,user.username,comment.submitted,comment.accepted,comment.text, admin.username adminname, comment.acceptedby 
      FROM comment 
      left join user on comment.userid=user.id 
      left join user admin on comment.acceptedby=admin.id 
      left join image on comment.imageid=image.id 
      WHERE  comment.accepted=0 and comment.acceptedby=0
      and image.eventid=?
      order by comment.submitted desc");
$stmt->bind_param("i", $_SESSION['eventid']);
$stmt->execute();
$result = $stmt->get_result();
      $_SESSION['allcomments']=0;
   
     
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

   <form action="editcomments.php" method="post">

<?php   
   

  $kommentare = $result->fetch_all(MYSQLI_ASSOC);
  foreach($kommentare as $kommentar) {
   echo'<img src="../uploads/'.$kommentar['filename'].'" style="width: 100%;max-width: 100px;margin-top: 20px;"><br><br>'; 
   echo '<br><br><b>'.$kommentar['username'].' ';
   echo $kommentar['submitted'];
   echo ':</b><br>';
   
   echo $kommentar['text'];
   
   if ($kommentar['accepted']==0 and $kommentar['acceptedby']==0) {
    echo '<br><br><b>'.pleaseaccept.'</b>'; 
  } else 
  if ($kommentar['accepted']==0 and $kommentar['acceptedby']>0) {
    echo '<br><br><font color=red><b>'.declinedby.' '.$kommentar['adminname'].' </b></font>'; 
  } else {
    if($kommentar['accepted']==1 and $kommentar['acceptedby']>0) {          
   
  echo '<br><br><font color=green><b>'.acceptedby.' '.$kommentar['adminname'].' </b></font>';          
    }
  }
   
   
   
      echo '<br><br><button type="submit" id="accept" name="accept" value="'.$kommentar['id'].'">';
   if($kommentar['accepted']==0) {echo editmyimagesaccept;}else{echo editmyimagesdecline;};  
   echo'</button> ';

   echo'<button onclick="return wirklichloeschen()" id="delete" name="delete" value="'.$kommentar['id'].'">'.buttondelete.'</button>';
   echo'  
   <br> 
   <br> 
   ';

  }
   ?>

</form>

<button  onclick="window.location.href='admin.php'"><?=buttonback?></button>




<?php
  include("../templateunten.php");
  ?>
