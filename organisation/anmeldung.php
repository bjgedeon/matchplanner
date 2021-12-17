<?php
$user = 'root';
$password = '';
$database = 'matchplanner';

$pdo = new PDO('mysql:host=localhost;dbname=' . $database, $user, $password, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

$errors = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['post-group'])) {
        $postGroup = rand(1,2);
    }
    if (!empty($_POST['post-classname'])) {
        $postClassname = $_POST['post-classname'];
    } else {
        $errors[] = 'Klassenamen';
    }
    if (!empty($_POST['post-teamname'])) {
        $postTeamname = $_POST['post-teamname'];
    } else {
        $errors[] = 'Teamnamen';
    }
    if (!empty($_POST['post-class'])) {
        $postClass = $_POST['post-class'];
    } else {
        $errors[] = 'Kategorie';
    }
    if (!empty($_POST['post-students'])) {
        $postStudents = $_POST['post-students'];
        if (!is_numeric($postStudents)) {
            $errors[] = 'Anzahl teilnehmender Spieler in einer Zahl.';
        }
    }
    else {
        $errors[] = 'Anzahl teilnehmender Spieler.';
    }
    if (!empty($_POST['post-teacher'])) {
        $postTeacher = $_POST['post-teacher'];
    } else {
        $errors[] = 'Namen der Lehrperson.';
    }
    if (!empty($_POST['post-trainer'])) {
        $postTrainer = $_POST['post-trainer'];
    } else {
        $errors[] = 'Namen des Trainers/ der Trainerin';
    }
    if (!empty($_POST['post-numberteacher'])) {
        $postNumberteacher = $_POST['post-numberteacher'];
        if (!preg_match('/^[\+ 0-9]+$/', $postNumberteacher)) {
            $errors[] = 'gültige Telefonnummer bei der Lehrperson';
        }
    }
    else {
        $errors[] = 'Telefonnummer bei der Lehrperson.';
    }
    if (!empty($_POST['post-numbertrainer'])) {
        $postNumbertrainer = $_POST['post-numbertrainer'];
        if (!preg_match('/^[\+ 0-9]+$/', $postNumbertrainer)) {
            $errors[] = 'gültige Telefonnummer bei dem Trainer/ der Trainerin';
        }
    }
    else {
        $errors[] = 'Telefonnummer, bei dem Trainer/ der Trainerin';
    }
    if (!empty($_POST['post-emailteacher'])) {
        $postEmailteacher = $_POST['post-emailteacher'];
        if (strpos($postEmailteacher, '@') === false) {
            $errors[] = 'gültige Email-Adresse bei der Lehrperson';
        }
    }
    else {
        $errors[] = 'Email-Adresse bei der Lehrperson';
    }
    if (!empty($_POST['post-emailtrainer'])) {
        $postEmailtrainer = $_POST['post-emailtrainer'];
        if (strpos($postEmailtrainer, '@') === false) {
            $errors[] = 'gültige E-mail-Adresse, bei dem Trainer/ der Trainerin';
        }
    }
    else {
        $errors[] = 'E-mail-Adresse, bei dem Trainer/ der Trainerin';
    }
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO `sign_up` (post_group, post_class, post_students, post_classname, post_teamname, post_numberteacher, post_numbertrainer, post_emailteacher,  post_emailtrainer, post_teacher, post_trainer) VALUES (:postGroup, :postClass, :postStudents, :postClassname, :postTeamname, :postNumberteacher, :postNumbertrainer, :postEmailteacher, :postEmailtrainer, :postTeacher, :postTrainer)");
        $stmt -> execute([':postGroup' => $postGroup,':postClass' => $postClass, ':postStudents' => $postStudents, ':postClassname' => $postClassname, ':postTeamname' => $postTeamname, ':postNumberteacher' => $postNumberteacher, ':postNumbertrainer' => $postNumbertrainer, ':postEmailteacher' => $postEmailteacher, ':postEmailtrainer' => $postEmailtrainer, ':postTeacher' => $postTeacher, ':postTrainer' => $postTrainer]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anmeldung</title>
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300&display=swap" rel="stylesheet">
</head>
<body>
<header class="header">
 <h1 class="title">Anmeldung</h1>
 <div class="div">
        <a href="home.php">Home</a>
        <a href="information.php">Information</a>
        <a href="anmeldungen.php">Anmeldungen</a>
        <a href="anmeldung.php">Anmeldung</a>
        <a href="spielplanrangliste.php">Spielplan und Rangliste</a>
    </div>
</header>   
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
    <li>Anmeldung war erfolgreich</li>
    <div>
    <?php } ?>
</ul>
   </div>
       <div class="main">
       <form method="post" action="anmeldung.php">
<h2>anmelden</h2>
  <p>Klassenname:</p>
  <input class="textarea" type = "text" value="<?php if (isset ($postClassname)) { echo $postClassname;} ?>" name="post-classname">
  <p>Teamname:</p>
  <input class="textarea" type = "text" value="<?php if (isset ($postTeamname)) { echo $postTeamname;} ?>" name="post-teamname">
  <p>Kategorie:</p>
  <input type="radio" name="post-class" value= "1,2Klasse">
  <label for="1,2Klasse">1, 2 Klasse</label><br>
  <input type="radio" name="post-class" value= "3,4Klasse">
  <label for="3,4Klasse">3, 4 Klasse</label><br>
  <input type="radio" name="post-class" value= "5,6Klasse">
  <label for="5,6Klasse">5, 6 Klasse</label>
  <p>Anzahl teilnehmender Schüler:</p>
  <input class="textarea" type = "text" value="<?php if (isset ($postStudents)) { echo $postStudents;} ?>" name="post-students" placeholder="Wert in Zahl angeben">
  <p>Name der Lehrperson:</p>
  <input class="textarea" type = "text" value="<?php if (isset ($postTeacher)) { echo $postTeacher;} ?>" name="post-teacher" placeholder="Vorname Nachname">
  <p>Name des Trainers/ der Trainerin:</p>
  <input class="textarea" type = "text" value="<?php if (isset ($postTrainer)) { echo $postTrainer;} ?>" name="post-trainer" placeholder="Vorname Nachname">
  <p>Telefonnummer der Lehrperson:</p>
  <input class="textarea" type = "text" value="<?php if (isset ($postNumberteacher)) { echo $postNumberteacher;} ?>" name="post-numberteacher">
  <p>Telefonnummer des Trainners/ der Trainerin:</p>
  <input class="textarea" type = "text" value="<?php if (isset ($postNumbertrainer)) { echo $postNumbertrainer;} ?>" name="post-numbertrainer">
  <p>Email-Adresse der Lehrperson:</p>
  <input class="textarea" type = "text" value="<?php if (isset ($postEmailteacher)) { echo $postEmailteacher;} ?>" name="post-emailteacher">
  <p>Email-Adresse des Trainers/ der Trainerin:</p>
  <input class="textarea" type = "text" value="<?php if (isset ($postEmailtrainer)) { echo $postEmailtrainer;} ?>" name="post-emailtrainer">
  <input class = "bottom" type = "submit" name="bottom">
</form> 
       </div>
   </main>
</body>
</html>