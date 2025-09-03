<?php
session_start();
 
   include("../templateoben.php");  
  
    $stmt = $conn->prepare("SELECT * from guess WHERE imageid=? and userid=?");
    $stmt->bind_param("ii", $_SESSION['imageid'], $_SESSION['userid']);
    $stmt->execute();
    $guessresult = $stmt->get_result();
    
    $jid="";
    if ($guessresult->num_rows)  {
        $guessdatensatz = $guessresult->fetch_assoc();
        $jid=$guessdatensatz['guessedjid'];
    
    }
?>

<center>


<h1><?=buttonguessjid?></h1>

 
    <form action="checkguessjid.php" method="post">
    
        <label for="jid">Jid:</label> 
        <input type="text" name="jid" value="<?=$jid?>"><br>
        <?php
        if(isset($msg)) {
         echo'<span style="color:red;">'.$msg.'<br></span>';
       }
       ?>  
        <button type="submit"><?=buttonsave?></button><br><br>
        
    </form>
    <button  onclick="window.location.href='guess.php?chosenimage=<?=$_SESSION['imageid']?>'"><?=buttonback?></button>


</center>

<?php
  include("../templateunten.php");
  ?>
