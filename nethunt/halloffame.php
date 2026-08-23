<?php
session_start();
 
   include("../templatenethunt.php");  


   ?>

<center>


<h1>Hall of Fame</h1>

<?=halloffameexplain?>
<br><br
    <form action="checkhalloffame.php" method="post">
        
        <input type="text" name="username" placeholder="<?=username?>" required><br>
        <input type="text" name="kommentar" placeholder="<?=commentplaceholder?>"><br>
        <?=rating?><br>
        <div class="star-rating">
          <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 Sterne">&#9733;</label>
          <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 Sterne">&#9733;</label>
          <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 Sterne">&#9733;</label>
          <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 Sterne">&#9733;</label>
          <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 Stern">&#9733;</label>
        </div><br><br>
        <button type="submit"><?=buttonsave?></button>
 <?php
         if(isset($msg)) {
          
         echo'<br><span style="color:red;">'.constant($msg).'<br></span>';
       }
       ?>   
    </form>



</center>

<?php
  include("../templateunten.php");
  ?>
