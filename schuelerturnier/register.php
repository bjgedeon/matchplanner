<?php
session_start();
$user = 'root';
$password = '';
$database = 'matchplanner';

$pdo = new PDO('mysql:host=localhost;dbname=' . $database, $user, $password, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);
$errors[] = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
if(isset($_GET['register'])) {

    $postEmail = $_POST['post_email'];
    $postPassword = $_POST['post_password'];
    $postUsername = $_POST['post_username'];
  
    if (!empty($_POST['post-email'])) {
        $postEmail = $_POST['post-email'];
        if (strpos($postEmail, '@') === false) {
            $errors[] = 'Geben Sie bitte eine gültige E-mail-Adresse ein.';
        }
    }
    else {
        $errors[] = 'Geben Sie bitte eine E-mail-Adresse ein.';
    }
    if (!empty($_POST['post-username']))
    $postUsername = $_POST['post-username'];
    }
    else {
        $errors[] = 'Geben Sie bitte ein Benutzernamen ein.';
    }
    if (!empty($_POST['post-password'])) {
    $postPassword = $_POST['post-password'];
    }
    else {
        $errors[] = 'Geben Sie bitte ein Benutzernamen ein.';
    }



    $stmt = $pdo->prepare("INSERT INTO register (post_username, post_password, post_email) VALUES (:postUsername, :postPassword, :postEmail)");
    $stmt->execute([':postUsername' => $postUsername, 'postPassword' => $postPassword, 'postEmail']);
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
        <a class="link" href="home.php">Home</a>
        <a class="link" href="register.php">Anmeldung</a>
        <div class="dropdown">
        <button class="dropbtn" href="spielplan.php">Spielplan</a>
        <div class="dropdown-content">
        <a href="12klasse.php">1 + 2 Klasse</a>
        <a href="34klasse.php">3 + 4 Klasse</a>
        <a href="56klasse.php">5 + 6 Klasse</a>
        </div>
</div>
        <a class="link" href="rangliste.php">Rangliste</a>
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
         
            <?php } ?>
            <?php
if (isset($_POST['bottom']) && (count($errors) === 0)) { ?>
    <div class="bestaetigungsbox"> <ul>
    <li>Ihre Registration war erfolgreich</li>
    <div>
    <?php } ?>
</ul>
   </div>
            </main>
            <div class="main">
            <a class="link2" href="register.php">registrieren</a>
            <a class="link2" href="login.php">einloggen</a>
        <form method="post" action="register.php">
          <h1>registrieren</h1>  
          <p>Benutzername:</p>
       <input class="textarea" type = "text" value="<?php if (isset ($postUsername)) { echo $postUsername;} ?>" name="post-username">    
       <p>Passwort:</p>
       <input class="textarea" type = "password" value="<?php if (isset ($postPassword)) { echo $postPassword;} ?>" name="post-password">
       <input class = "bottom" type = "submit" name="bottom"> 
      </div>
    </form>
</body>
</html>