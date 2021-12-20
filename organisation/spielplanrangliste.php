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
    if (!empty($_POST['post-team'])) {
        $postTeam = $_POST['post-team'];
    } else {
        $errors[] = 'Team2 eingeben';
    }
    if (!empty($_POST['post-otherteam'])) {
        $postOtherteam = $_POST['post-otherteam'];
    } else {
        $errors[] = 'Team1 eingeben';
    }
    if (!empty($_POST['post-class'])) {
        $postClass = $_POST['post-class'];
    } else {
        $errors[] = 'Kategorie';
    }
    if (!empty($_POST['post-time'])) {
        $postTime = $_POST['post-time'];
        if (!preg_match('/[0-9]+:+[0-9]+-+[0-9]+:+[0-9]/', $postTime)) {
            $errors[] = 'Die Zeit nach Vorschrift eingeben.';
        }
    } else {
        $errors[] = 'Zeit eingeben';
    }
    if (!empty($_POST['post-place'])) {
        $postPlace = $_POST['post-place'];
        if (!is_numeric($postPlace)) {
            $errors[] = 'Nr. des Platzes in Zahl';
        }
    }
    else {
        $errors[] = 'Nr. des Platzes';
    }
 
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO `matchplan` (post_class, post_team, post_otherteam, post_time, post_place) VALUES (:postClass, :postTeam, :postOtherteam, :postTime, :postPlace)");
        $stmt -> execute([':postClass' => $postClass, ':postTeam' => $postTeam, ':postOtherteam' => $postOtherteam, ':postTime' => $postTime, 'postPlace' => $postPlace]);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>spielplan/rangliste</title>
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300&display=swap" rel="stylesheet">
</head>
<body>
<header class="header">
 <h1 class="title">Spielplan/Rangliste</h1>
 <div class="div">
        <a href="home.php">Home</a>
        <a href="information.php">Information</a>
        <a href="anmeldungen.php">Anmeldungen</a>
        <a href="anmeldung.php">Anmeldung</a>
        <a href="spielplanrangliste.php">Spielplan und Rangliste</a>
        <div class="dropdown">
        <button class="dropbtn" href="spielplan.php">Spielplan</a>
        <div class="dropdown-content">
        <a href="spielplan12klasse.php">1 + 2 Klasse</a>
        <a href="spielplan34klasse.php">3 + 4 Klasse</a>
        <a href="spielplan56klasse.php">5 + 6 Klasse</a>
        </div>
</div>
    </div>
</header>   
<main>
 <?php if (count($errors) > 0) { ?>
            <div class="errorbox"> <ul>
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
    <li>Spiel ist eingetragen.</li>
    <div>
    <?php } ?>
</ul>
   </div>
            <div class="main">
<form method="post" action="spielplanrangliste.php">
<h2>Spiel eintragen</h2>
<p>Kategorie:</p>
  <input type="radio" name="post-class" value= "1,2Klasse">
  <label for="1,2Klasse">1, 2 Klasse</label><br>
  <input type="radio" name="post-class" value= "3,4Klasse">
  <label for="3,4Klasse">3, 4 Klasse</label><br>
  <input type="radio" name="post-class" value= "5,6Klasse">
  <label for="5,6Klasse">5, 6 Klasse</label>
     <p>Heimteam:</p> 
     <input class="textarea" type = "text" value="<?php if (isset ($postTeam1)) { echo $postTeam1;} ?>" name = "post-team"> 
     <p>Gastteam:</p>
     <input class="textarea" type = "text" value="<?php if (isset ($postOtherteam)) { echo $postOtherteam;} ?>" name = "post-otherteam">
     <p>Spielzeit:</p>
     <input class="textarea" type = "text" value="<?php if (isset ($postTime)) { echo $postTime;} ?>" name = "post-time" placeholder="XX:XX-XX:XX">
     <p>Platz:</p>
     <input class="textarea" type = "text" value="<?php if (isset ($postPlace)) { echo $postPlace;} ?>" name = "post-place" placeholder="in Zahl angeben">
    <input class = "bottom" type = "submit" name="bottom">
    </div>
</form>
 </main>
</body>
</html>