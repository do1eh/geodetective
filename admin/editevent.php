<?php
session_start();
 
   include("../templateoben.php");  
   if ($_SESSION['role']!='admin' ) {
    echo "<script>window.location.href='../menu/main.php';</script>";
    exit(1);
 } 
   if (isset($edit)) {
    $editeventid=$_POST['edit'];
    $stmt = $conn->prepare("SELECT * from event WHERE id=?");
    $stmt->bind_param("i", $editeventid);
    $stmt->execute();
    $eventresult = $stmt->get_result();
    $eventdatensatz = $eventresult->fetch_assoc();
    $_SESSION['editeventid']=$editeventid;

   

    
}else
if (isset($delete)) {
  $editeventid=$_POST['delete'];
    
    //Event löschen (wird nicht agezeigt, da es eimmer nur ein Event geben soll, rotzdem hier schon einmal vorbereitet fasl doch)
    
    
    $stmt = $conn->prepare("delete from event  WHERE id=?");
    $stmt->bind_param("i", $editeventid);
    $stmt->execute();

    
    echo "<script>window.location.href='adminevent.php';</script>"; 
    //header('location: adminevent.php');
    exit(1);

    }else if (isset($_SESSION['editeventid'])) {
        $editeventid=$_SESSION['editeventid'];
        $stmt = $conn->prepare("SELECT * from event WHERE id=?");
        $stmt->bind_param("i", $editeventid);
        $stmt->execute();
        $eventresult = $stmt->get_result();
        $eventdatensatz = $eventresult->fetch_assoc();

     

    }
     //Format für Datepicker: yyyy-mm-ddThh:mm   
     $starttimestamp=substr(str_replace(" ","T",$eventdatensatz['starttimestamp']),0,16);
     $endtimestamp=substr(str_replace(" ","T",$eventdatensatz['endtimestamp']),0,16);
     $submitfrom=substr(str_replace(" ","T",$eventdatensatz['submitfrom']),0,16);
     $submituntil=substr(str_replace(" ","T",$eventdatensatz['submituntil']),0,16);
     $startnightsrest=$eventdatensatz['startnightsrest'];
     $endnightsrest=$eventdatensatz['endnightsrest'];
   ?>

<center>


<h1>Event Ändern</h1>

 
    <form action="updateevent.php" method="post">
    
        <label for="name">Name:</label> 
        <input type="text" name="name" value="<?=$eventdatensatz['name']?>" required><br>
        
        <label for="starttimestamp">Beginn:</label> 
        <input type="datetime-local"  name="starttimestamp" value="<?=$starttimestamp?>"><br>
        <label for="endtimestamp">Ende:</label> 
        <input type="datetime-local"  name="endtimestamp" value="<?=$endtimestamp?>"><br>
        <label for="submitfrom">Bilder einreichen ab:</label> 
        <input type="datetime-local"  name="submitfrom" value="<?=$submitfrom?>"><br>
        <label for="submituntil">Bilder einreichen bis:</label> 
        <input type="datetime-local"  name="submituntil" value="<?=$submituntil?>"><br>
        
        <label for="interval">Die nächsten Bilder zum raten veröffentlichen ab Eventbeginn alle:</label> 
        <input type="number"  name="interval" min="1" max="24" value="<?=$eventdatensatz['publishinterval']?>"> Stunden<br>

        <label for="imagesperinterval">Anzahl der Bilder die pro Intervall veröffentlicht werden:</label> 
        <input type="number"  name="imagesperinterval" min="1" max="1000" value="<?=$eventdatensatz['imagesperinterval']?>"><br> 

        <label for="startnightsrest">Beginn der Nachtruhe:</label> 
        <input type="time"  name="startnightsrest" value="<?=$startnightsrest?>"><br>

        <label for="endnightsrest">Ende der Nachtruhe:</label> 
        <input type="time"  name="endnightsrest" value="<?=$endnightsrest?>"><br>
        <br><br>
        
        <?php
        if(isset($msg)) {
         echo'<span style="color:red;">'.$msg.'<br></span>';
       }
       ?>  
       <br><br>
        <button type="submit">Event ändern</button><br><br>
        
    </form>
    <button  onclick="window.location.href='adminevent.php'">Zurück</button>


</center>

<?php
  include("../templateunten.php");
  ?>
