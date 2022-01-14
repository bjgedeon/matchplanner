<?php  include 'models/model.anmeldung.php';
 ?>

<?php if ($_SESSION["userid"] > 0) {?>
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
            <div>
   <?php
if (isset($_POST['bottom']) && (count($errors) === 0)) { ?>
    <div class="bestaetigungsbox"> <ul>
    <li>Vielen Dank für Ihre Anmeldung am Schülerturnier Ebikon 2021. Wir werden uns bei Ihnen melden wenn alles organisiert ist.</li>
    <div>
    <?php } ?>
</ul>
</div>
<div class="main">
       <form method="post" action="index.php?page=anmeldung">
<h2>anmelden</h2>
  <p>Klassenname:</p>
  <input class="textarea" type = "text" value="<?php if (isset ($postClassname)) { echo $postClassname;} ?>" name="post-classname">
  <p>Teamname:</p>
  <input class="textarea" type = "text" value="<?php if (isset ($postTeamname)) { echo $postTeamname;} ?>" name="post-teamname">
  <p>Kategorie:</p>
  <input type="radio" name="post-class" value= "1,2Klasse">
  <label for="1,2Klasse">1 + 2 Klasse</label><br>
  <input type="radio" name="post-class" value= "3,4Klasse">
  <label for="3,4Klasse">3 + 4 Klasse</label><br>
  <input type="radio" name="post-class" value= "5,6Klasse">
  <label for="5,6Klasse">5 + 6 Klasse</label>
  <p>Anzahl teilnehmender Schüler:</p>
  <input class="textarea" type = "text" value="<?php if (isset ($postStudents)) { echo $postStudents;} ?>" name="post-students" placeholder="Wert in Zahl angeben">
  <p>Name der Lehrperson:</p>
  <input class="textarea" type = "text" value="<?php if (isset ($postTeacher)) { echo $postTeacher;} ?>" name="post-teacher" placeholder="Vorname Nachname">
  <p>Telefonnummer der Lehrperson:</p>
  <input class="textarea" type = "text" value="<?php if (isset ($postNumberteacher)) { echo $postNumberteacher;} ?>" name="post-numberteacher">
  <p>Email-Adresse der Lehrperson:</p>
  <input class="textarea" type = "text" value="<?php if (isset ($postEmailteacher)) { echo $postEmailteacher;} ?>" name="post-emailteacher">
  <p>Name des Betreuers/ der Betreuerin:</p>
  <input class="textarea" type = "text" value="<?php if (isset ($postTrainer)) { echo $postTrainer;} ?>" name="post-trainer" placeholder="Vorname Nachname">
  <p>Telefonnummer des Betreuers/ der Betreuerin:</p>
  <input class="textarea" type = "text" value="<?php if (isset ($postNumbertrainer)) { echo $postNumbertrainer;} ?>" name="post-numbertrainer">
  <p>Email-Adresse des Betreuers/ der Betreuerin:</p>
  <input class="textarea" type = "text" value="<?php if (isset ($postEmailtrainer)) { echo $postEmailtrainer;} ?>" name="post-emailtrainer">
  <input class = "bottom" type = "submit" name="bottom">
</form> 
       </div>
   </main>
 <?php } 

 else { ?>
 <div class="link4">
 <p>Bitte registrieren Sie sich <a href="index.php?page=register">hier</a>.</p>
 </div>
 <?php } ?>