<?php
session_start();
 
   include("../templatenethunt.php");  

   $sql="SELECT * FROM `nethunt` order by datum asc";
   $result = $conn->query($sql);

   $datensaetze = $result->fetch_all(MYSQLI_ASSOC);

   ?>

<center>


<h1>Hall of Fame</h1>

<?=halloffameexplain?>
<br><br>  
 <?php
 if (!isset($_GET['saved']) || $_GET['saved'] != 1) {
  echo'

    <form action="checkhalloffame.php" method="post">
        
        <input type="text" name="username" maxlength="20" placeholder="'.username.'" required><br>
        <input type="text" name="kommentar" maxlength="200" placeholder="'.commentplaceholder.'"><br>
        '.rating.'<br>
        <div class="star-rating">
          <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 Sterne">&#9733;</label>
          <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 Sterne">&#9733;</label>
          <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 Sterne">&#9733;</label>
          <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 Sterne">&#9733;</label>
          <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 Stern">&#9733;</label>
        </div><br><br>
        <button type="submit">'.buttonsave.'</button>
     </form>
';
}
?>
<br><br>
<table style="width: 100%; border: 1px solid black; border-collapse: separate; border-spacing: 5px; padding: 5px;
background-color: #8cd5e9;">
 <tr>
 <td style="text-align: left; padding: 5px;">Name</td>
 <td style="text-align: left; padding: 5px;">Datum</td>
 <td style="text-align: left; padding: 5px;">Rating</td>
 <td style="text-align: left; padding: 5px;">Kommentar</td>
 </tr>
<?php
foreach($datensaetze as $datensatz) {
    $name=$datensatz['name'];    
    $datum=$datensatz['datum'];  
    $rating=$datensatz['rating'];
    $kommentar=$datensatz['kommentar'];
    $ratingStars = '';
    $ratingValue = (int) $rating;
    if ($ratingValue > 0) {
        $ratingStars = str_repeat('★', $ratingValue) . str_repeat('☆', 5 - $ratingValue);
    } else {
        $ratingStars = '–';
    }
 ?>
 
 
 <tr>
  <td style="text-align: left;"><?=$name?></td>
  <td style="text-align: left;"><?=$datum?></td>
  <td style="text-align: left; color: #fff700;" title="<?=$rating?>/5"><?=$ratingStars?></td>
  <td style="text-align: left;"><?=$kommentar?></td>
 </tr>
 <?php
}
?>
</table>




</center>

<?php
  include("../templateunten.php");
  ?>
