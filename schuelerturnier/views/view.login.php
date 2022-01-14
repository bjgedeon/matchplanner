<?php  include 'models/model.login.php';
 ?>
<main>
   <?php 
    if (count($errors) > 0) { ?>
            <div class = "errorbox"> <ul>
                    <?php foreach ($errors as $error) { ?>
                    <li> <?= $error ?> </li> <br>
                    <?php } ?>        
                    </ul>  
            </div>
            <?php } ?>
 </main>
 <div class="main">
    <div>
    <?php
if ($_SESSION['userid'] > 0) { ?>
    <div class="bestaetigungsbox"> <ul>
    <li>Sie sind eingeloggt. Melden Sie sich <a href="index.php?page=anmeldung">hier</a> für das Turnier an.</li>
    <div>
    <?php } ?>
</ul>
   </div>
            <a class="link2" href="index.php?page=register">registrieren</a>
            <a class="link2" href="index.php?page=login">einloggen</a>
        <form method="post" action="index.php?page=login">
            <h1>einloggen</h1>
          <p>Benutzername:</p>
       <input class="textarea" type = "text" value="<?php if (isset ($postUsername)) { echo $postUsername;} ?>" name="post-username">    
       <p>Passwort:</p>
       <input class="textarea" type = "password" value="<?php if (isset ($postPassword)) { echo $postPassword;} ?>" name="post-password">
       <input class = "bottom" type = "submit" name="bottom"> 
      </div>
    </form>