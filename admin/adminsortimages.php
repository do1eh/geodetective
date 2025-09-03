<?php
include("../templateoben.php");  
require_once('GeoImage.php');
if ($_SESSION['role']!='admin' && $_SESSION['role']!='moderator') {
  echo "<script>window.location.href='../menu/main.php';</script>";
  exit(1);
} 
?>

<form action="savesortimages.php" method="post">
<?php   
$stmt = $conn->prepare("SELECT * FROM image WHERE eventid=? and deadline > CURRENT_TIMESTAMP() ORDER BY ordernumber, submitted");
$stmt->bind_param("i", $_SESSION['eventid']);
$stmt->execute();
$result = $stmt->get_result();
$datensaetze = $result->fetch_all(MYSQLI_ASSOC);

if ($result->num_rows > 0) {
    $images = array();
    $order = 0;

    // Datensätze in Array schreiben
    foreach ($datensaetze as $datensatz) {
        $gdImage = new GeoImage();
        $gdImage->setId($datensatz['id']);
        $gdImage->setEventId($datensatz['eventid']);
        $gdImage->setUserId($datensatz['userid']);
        $gdImage->setLat($datensatz['lat']);
        $gdImage->setLon($datensatz['lon']);
        $gdImage->setDescription($datensatz['description']);
        $gdImage->setSubmitted($datensatz['submitted']);
        $gdImage->setAccepted($datensatz['accepted']);
        $gdImage->setOrderNumber($order);
        $gdImage->setDeadline($datensatz['deadline']);
        $gdImage->setFilename($datensatz['filename']);
        $gdImage->setSolutionText($datensatz['solutiontext']);
        $gdImage->setAcceptedBy($datensatz['acceptedby']);
        $gdImage->setAccepttime($datensatz['accepttime']);

        $images[] = $gdImage;

        // Wegspeichern der Ordnung
        $stmt = $conn->prepare("UPDATE image SET ordernumber=? WHERE id=?");
        $stmt->bind_param("ii", $order, $datensatz['id']);
        $stmt->execute();

        $order++;
    }
    
    $imagenumber=0;
   
    // Array sortiert ausgeben
    foreach ($images as $gdImage) {
      If ($imagenumber % $_SESSION['imagesperinterval'] == 0) {
        echo '<H1>Spielrunde ' . ($imagenumber / $_SESSION['imagesperinterval'] + 1) . ':</H1><br>';  
      };
      echo '
        <img src="../uploads/' . $gdImage->getFilename() . '" style="width: 100%; max-width: 200px; margin-top: 20px;">
        <br><br> 
        <button type="submit" id="up" name="up" value="' . $gdImage->getOrderNumber() . '">nach oben</button>
        <button type="submit" id="down" name="down" value="' . $gdImage->getOrderNumber() . '">nach unten</button>
        <br><br>
        ';
    $imagenumber++;
      }
} else {
    echo 'Keine Bilder vorhanden';
}
?>
</form>

<button onclick="window.location.href='../menu/main.php'"><?=buttonback?></button>

<?php
include("../templateunten.php");
?>
