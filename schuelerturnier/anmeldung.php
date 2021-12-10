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
    if (!empty($_POST['post-class'])) {
        $postClass = $_POST['post-class'];
    } else {
        $errors[] = 'Wählen Sie bitte eine Kategorie aus';
    }
    if (!empty($_POST['post-classname'])) {
        $postClassname = $_POST['post-classname'];
    } else {
        $errors[] = 'Geben Sie bitte den namen der Klasse ein.';
    }
    if (!empty($_POST['post-teamname'])) {
        $postTeamname = $_POST['post-teamname'];
    } else {
        $errors[] = 'Geben Sie bitte einen Teamnamen ein.';
    }
    if (!empty($_POST['post-students'])) {
        $postStudents = $_POST['post-students'];
        if (!is_numeric($postStudents)) {
            $errors[] = 'Geben Sie bitte die Anzahl teilnehmender Spieler in einer Zahl an.';
        }
    }
    else {
        $errors[] = 'Geben Sie bitte die Anzahl teilnehmender Spieler ein.';
    }
    if (!empty($_POST['post-teacher'])) {
        $postTeacher = $_POST['post-teacher'];
    } else {
        $errors[] = 'Geben Sie bitte den Namen der Lehrperson ein.';
    }
    if (!empty($_POST['post-trainer'])) {
        $postTeamname = $_POST['post-trainer'];
    } else {
        $errors[] = 'Geben Sie bitte den Namen des Trainers/ der Trainerin ein.';
    }
    if (!empty($_POST['post-numberteacher'])) {
        $postNumber = $_POST['post-numberteacher'];
        if (!preg_match('/^[\+ 0-9]+$/', $postNumberteacher)) {
            $errors[] = 'Geben Sie bitte eine gültige Telefonnummer ein.';
        }
    }
    else {
        $errors[] = 'Geben Sie bitte Ihre Telefonnummer ein.';
    }
    if (!empty($_POST['post-numbertrainer'])) {
        $postNumber = $_POST['post-numbertrainer'];
        if (!preg_match('/^[\+ 0-9]+$/', $postNumbertrainer)) {
            $errors[] = 'Geben Sie bitte eine gültige Telefonnummer, bei dem Trainer/ der Trainerin ein.';
        }
    }
    else {
        $errors[] = 'Geben Sie bitte eine gültige Telefonnummer, bei der Lehrperson ein.';
    }
    if (!empty($_POST['post-email'])) {
        $postEmailteacher = $_POST['post-emailteacher'];
        if (strpos($postEmailteacher, '@') === false) {
            $errors[] = 'Geben Sie bitte eine gültige E-mail-Adresse ein.';
        }
    }
    else {
        $errors[] = 'Geben Sie bitte eine E-mail-Adresse ein.';
    }
    if (!empty($_POST['post-emailtrainer'])) {
        $postEmail = $_POST['post-emailtrainer'];
        if (strpos($postEmailtrainer, '@') === false) {
            $errors[] = 'Geben Sie bitte eine gültige E-mail-Adresse ein.';
        }
    }
    else {
        $errors[] = 'Geben Sie bitte eine E-mail-Adresse ein.';
    }
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO `sign_up` (post_class, post_students, post_classname, post_teamname, post_numbertrainer, post_numberteacher, post_emailteacher,  post_emailtrainer) VALUES (:postClass, :postStudents, :postClassname, :postTeamname, :postNumberteacher, :postEmailteacher, :postEmailtrainer)");
        $stmt -> execute([':postClass' => $postClass, ':postStudents' => $postStudents, ':postClassname' => $postClassname, 'postTeamname' => $postTeamname, ':postNumbertrainer' => $postNumbertrainer, ':postNumberteacher' => $postNumberteacher, ':postEmailteacher' => $postEmailteacher, ':postEmailtrainer' => $postEmailtrainer]);
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
        <a href="anmeldung.php">Anmeldung</a>
        <a href="spielplan.php">Spielplan</a>
        <a href="rangliste.php">Rangliste</a>
    </div>
    </header>
   <main>
   <?php if (count($errors) > 0) { ?>
            <div class = "errorbox"> <ul>
                    <?php foreach ($errors as $error) { ?>
                    <li> <?= $error ?> </li> <br>
                    <?php } ?>        
                    </ul>  
            </div>
            <?php } ?>
       <div class="main">
       <form method="post" action="anmeldung.php">
<h2>Melden Sie ihre Klasse für das Schülerturnier Ebikon an.</h2>
  <p>Klassenname:</p>
  <input class="textarea" type = "text" value="<?php if (isset ($postClassname)) { echo $postClassname;} ?>" name="post-classname">
  <p>Teamname:</p>
  <input class="textarea" type = "text" value="<?php if (isset ($postTeamname)) { echo $postTeamname;} ?>" name="post-teamname">
  <p>Kategorie:</p>
  <input type="radio" name="post-class" value="1,2Klasse">
  <label for="1,2Klasse">1, 2 Klasse</label><br>
  <input type="radio" name="post-class" value="3,4Klasse">
  <label for="3,4Klasse">3, 4 Klasse</label><br>
  <input type="radio" name="post-class" value="5,6Klasse">
  <label for="5,6Klasse">5, 6 Klasse</label>
  <p>Anzahl teilnehmender Schüler:</p>
  <input class="textarea" type = "text" value="<?php if (isset ($postStudents)) { echo $postStudents;} ?>" name="post-students" placeholder="Wert in Zahl angeben">
  <p>Telefonnummer der Lehrperson:</p>
  <input class="textarea" type = "text" value="<?php if (isset ($postNumberteacher)) { echo $postNumberteacher;} ?>" name="post-numberteacher">
  <p>Telefonnummer des Trainners/ der Trainerin:</p>
  <input class="textarea" type = "text" value="<?php if (isset ($postNumbertrainer)) { echo $postNumbertrainer;} ?>" name="post-numbertrainer">
  <p>Email-Adresse der Lehrperson:</p>
  <input class="textarea" type = "text" value="<?php if (isset ($postEmailteacher)) { echo $postEmailteacher;} ?>" name="post-emailteacher">
  <p>Email-Adresse des Trainers/ der Trainerin:</p>
  <input class="textarea" type = "text" value="<?php if (isset ($postEmailtrainer)) { echo $postEmailtrainer;} ?>" name="post-emailtrainer">
  <input class = "bottom" type = "submit">
</form>  
       </div>
   </main>
</body>
</html>