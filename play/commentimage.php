<?php

 
   include("../templateoben.php");  
   include("../user/loadevent.php");  
  
   
  ?>
   <h2><?=commenttitle?></h2>
   
   
   
   


   
   <form action="checkcomment.php" id="commentform" name="commentform" method="post">
  
<?php

//Sicherheitscheck $GET-Parameter
if (!isset($_GET['imageid']) || !is_numeric($_GET['imageid'])) {
    echo "<script>window.location.href='../menu/main.php';</script>";
    exit(1);
}
   $stmt = $conn->prepare("SELECT image.id,deadline,description,name,contact,filename,solutiontext FROM image join user on image.userid=user.id join scoutgroup on user.scoutgroup=scoutgroup.id WHERE image.id=?");
   $stmt->bind_param("i", $_GET['imageid']);
   $stmt->execute();
   $imageresult = $stmt->get_result();
   $image=$imageresult->fetch_assoc();
   $filename=$image['filename'];
   //Bild
   echo '
   
  
       <img src="../uploads/'.$filename.'" style="width: 100%;max-width: 200px;margin-top: 20px;">
        
     <br><br>
   '.guesssubmittedby.' '.$image['name'].' 
    
     <br><br>
     '.solutionimagdescription.':
     <br>
   '.$image['description'].'
   <br><br>
   '.solutiontitle.':
   <br>
    '.$image['solutiontext'].'
    <br><br>
    <label for="comment">'.commentplaceholder.'</label><br>
    <textarea rows="4" cols="40" maxlength="500" id="commenttext" name="commenttext" form="commentform" required></textarea>
    
    
    <input type="hidden" id="imageid" name="imageid" value="'.$_GET['imageid'].'"> <br>
          <button type="submit" id="comment" name="comment">'.commentbutton.'</button> 
   
  ';
  //Kommentare
   $stmt = $conn->prepare("SELECT * FROM comment join user on comment.userid=user.id WHERE imageid=? and accepted=1 order by submitted desc");
   $stmt->bind_param("i", $_GET['imageid']);
   $stmt->execute();
   $result = $stmt->get_result();
    
   if($result->num_rows>0)
   {
      

   $kommentare = $result->fetch_all(MYSQLI_ASSOC);
   foreach($kommentare as $kommentar) {
    echo '<br><br><b>'.$kommentar['username'].' ';
    echo $kommentar['submitted'];
    echo ':</b><br>';
    
    echo htmlspecialchars($kommentar['text']);
   }
   }
  ?>

</form>

<button  onclick="window.location.href='choosesolutionimage.php'"><?=buttonback?></button>




<?php
if (isset($_GET['saved'])) {
  echo '<script> alert("'.commentsaved.'") </script>';
  
  } 

  include("../templateunten.php");
  ?>
