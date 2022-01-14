<?php  include 'models/model.register.php';
 ?>
<main>
   <?php 
   if (isset($_POST['bottom']) && (count($errors) > 0)) { ?>
            <div class = "errorbox"> <ul>
                    <?php foreach ($errors as $error) { ?>
                    <li> <?= $error ?> </li> <br>
                    <?php } ?> 
                    </ul>  
            </div>
            <?php } ?>
            <?php
if (isset($_POST['bottom']) && (count($errors) === 0)) { ?>
    <div class="bestaetigungsbox"> <ul>
    <li>Ihre Registration war erfolgreich. Sie können sich jetzt <a href='index.php?page=login'>hier</a> einloggen.</li>
    <div>
    <?php } ?>
</ul>
   </div>
            </main>
            <div class="main">
            <a class="link2" href="index.php?page=register">registrieren</a>
            <a class="link2" href="index.php?page=login">einloggen</a>
        <form method="post" action="index.php?page=register">
          <h1>registrieren</h1>  
          <p>Benutzername:</p>
       <input class="textarea" type = "text" value="<?php if (isset ($postUsername)) { echo $postUsername;} ?>" name="post-username">    
       <p>Passwort:</p>
       <input class="textarea" type = "password" value="<?php if (isset ($postPassword1)) { echo $postPassword1;} ?>" name="post-password1">
       <p>Passwort erneut eingeben:</p>
       <input class="textarea" type = "password" value="<?php if (isset ($postPassword2)) { echo $postPassword2;} ?>" name="post-password2">
       <input class = "bottom" type = "submit" name="bottom"> 
      </div>
    </form>