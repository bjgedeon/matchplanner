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
$errors = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['post-username'])) {
        $postUsername = $_POST['post-username'];
    }
    else {
        $errors[] = 'Geben Sie bitte einen Benutzername ein';
    }

    if (!empty($_POST['post-password'])) {
        $postPassword = $_POST['post-password'];
    }
    else {
    $errors[] = 'Geben Sie bitte ein Passwort ein';
    }
  
        if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO register (post_username, post_password) VALUES (:postUsername, :postPassword)");
        $stmt->execute(array(':postUsername' => $postUsername, ':postPassword' => $postPassword));
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
        <a class="link" href="home.php">Home</a>
        <a class="link" href="register.php">Anmeldung</a>
        <a class="link" href="spielplan.php">Spielplan</a>
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
            </div>
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