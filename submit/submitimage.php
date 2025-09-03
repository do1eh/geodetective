<?php
session_start();
 
   include("../templateoben.php");  
   
   $stmt = $conn->prepare("SELECT * FROM user WHERE id=?");
   $stmt->bind_param("i", $_SESSION['userid']);
   $stmt->execute();
   $result = $stmt->get_result();
   $datensatz = $result->fetch_assoc();

   
$submitfrom = new DateTime($_SESSION['submitfrom']);   
$submitfrom=$submitfrom->getTimestamp();
$submituntil = new DateTime($_SESSION['submituntil']); 
$submituntil=$submituntil->getTimestamp();
$aktuellezeit = new DateTime();
$aktuellezeit=$aktuellezeit->getTimestamp();
$submitok=false;
if ($aktuellezeit>=$submitfrom && $aktuellezeit<=$submituntil) {
  $submitok=true;
}



   ?>

<center>


<h1><?=submitimagetitle?></h1>
<?=submitimageexplain?>
    <hr>
    <form action="checksubmitimage.php" method="post" enctype="multipart/form-data">
    <img src="../images/photo.jpg" class="responsive">
    <br> 
    
    <?php if (!$submitok) {echo'<H2>'; echo submitdiabled; echo'</H2><br>';}?> 
   <input id="uploadedimage" type="file" accept="image/* , text/plain"  name="uploadedimage" 
   <?php if (!$submitok) {echo' disabled ';}; ?>
   
   />
   
    <br />
    <br />
    
    
    <input type="submit" value="<?=buttonupload?>" <?php if (!$submitok) {echo' disabled ';}; ?>/>
   <script>
   document.querySelector('form').addEventListener('submit', function() {
      // Ladeanimation erzeugen
      let loader = document.createElement('div');
      loader.id = 'loader-animation';
      loader.style.position = 'fixed';
      loader.style.top = 0;
      loader.style.left = 0;
      loader.style.width = '100vw';
      loader.style.height = '100vh';
      loader.style.background = 'rgba(255,255,255,0.7)';
      loader.style.display = 'flex';
      loader.style.alignItems = 'center';
      loader.style.justifyContent = 'center';
      loader.style.zIndex = 9999;
      loader.innerHTML = '<div style="border:8px solid #f3f3f3;border-top:8px solid #3498db;border-radius:50%;width:60px;height:60px;animation:spin 1s linear infinite;"></div><style>@keyframes spin{0%{transform:rotate(0deg);}100%{transform:rotate(360deg);}}</style>';
      document.body.appendChild(loader);
   });
   </script>
    </form>

<button  onclick="window.location.href='../menu/main.php'"><?=buttoncancel?></button>

</center>

<?php
  include("../templateunten.php");
  ?>
