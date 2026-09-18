<?php
/*
 * Created on 27.10.2024
 * updated on 27.10.2024
 * 
 * Wenn fertig dann:
 * <option value="fr">Français</option>
 * <option value="nl">Nederlands</option>
 *
 
 */#

  include("./templatelogin.php");
  ?>

<center>
<img src="images/GeoDetective-JOTA-JOTI.png" class="responsive">

<h1>Login</h1>
    <form action="user/login.php" method="post">
      Language:
    <select id="language" name="language" required>
              <option value="de" <?php if ($_SESSION['language'] =='de') {echo ' selected ';} ?>>Deutsch</option>
              <option value="en" <?php if ($_SESSION['language'] =='en') {echo ' selected ';} ?>>English</option>
              <option value="fr" <?php if ($_SESSION['language'] =='fr') {echo ' selected ';} ?>>Français</option>
              <option value="nl" <?php if ($_SESSION['language'] =='nl') {echo ' selected ';} ?>>Nederlands</option>
              <option value="it" <?php if ($_SESSION['language'] =='it') {echo ' selected ';} ?>>Italiano</option>
        </select><br><br>
        <input type="text" name="username" placeholder="<?=username?>" ><br>
        <input type="password" name="password" placeholder="<?=password?>" >
        <br>
        <?php
       
        if(isset($msg)) {
          echo'<span style="color:red;">'.errorwrongpassword.'<br></span>';
        }
        ?>   
 <button type="submit" name="login">Login</button>
 <button type="submit" name="register">Register</button>
    </form>

<hr>
<div id="credits">
<B>Credits:</B><BR>
Spielidee:<BR>
<li>Woody und JOTI/JOTA Team der PBS<BR>
Entwicklung:<BR>
<li>Ralf Lüsebrink / DO1EH<BR>
<li>Benoît Panizzon / Woody / HB9EUE<BR>
Übersetzungen:<BR>
<li>NL: Sander Krul<BR>
Tester:<BR>
<li>Thomas Pfaff / Pepe / HB9EVT<BR>
Source: <a href="https://github.com/do1eh/geodetective">https://github.com/do1eh/geodetective</a><BR>
Impressum / Datenschutz: Es gilt das Impressum und die Datenschutzbestimmungen der jeweiligen Landesverbände die das Spiel organisieren.
</div>

</center>

<?php
  include("./templateunten.php");
  ?>
