<?php
include("../templateoben.php");  
require_once('GeoImage.php');
?>

<form action="savesortimages.php" method="post">
<?php   
$sql = "SELECT * FROM image WHERE eventid='" . $_SESSION['eventid'] . "' and deadline > CURRENT_TIMESTAMP() ORDER BY ordernumber, submitted";
$result = $conn->query($sql);
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
        $sql = "UPDATE image SET ordernumber='" . $order . "' WHERE id='" . $datensatz['id'] . "'";
        $conn->query($sql);

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
