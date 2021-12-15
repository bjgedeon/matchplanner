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
 
if(isset($_GET['login'])) {
    $postUsername = $_POST['post_username'];
    $postPasswort = $_POST['post_passwort'];
    
    $stmt = $pdo->prepare("SELECT * FROM register WHERE post_username = :postUsername");
    $result = $stmt->execute(array('post_username' => $postUsername));
    $user = $stmt->fetch();
        
    if ($user !== false && password_verify($postPassword, $user['post_password'])) {
    $user['id'];
    } else {
        $erorrs[] = 'Sie sind nicht registriert';
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
 </main>
 <div class="main">
    <div>
    <?php
if (isset($_POST['bottom']) && (count($errors) === 0)) { ?>
    <div class="bestaetigungsbox"> <ul>
    <li>Sie sind eingellogt. Melden Sie sich <a href="anmeldung.php">hier</a> für das Turnier an.</li>
    <div>
    <?php } ?>
</ul>
   </div>
            <a class="link2" href="register.php">registrieren</a>
            <a class="link2" href="login.php">einloggen</a>
        <form method="post" action="login.php">
            <h1>einloggen</h1>
          <p>Benutzername:</p>
       <input class="textarea" type = "text" value="<?php if (isset ($postUsername)) { echo $postUsername;} ?>" name="post-username">    
       <p>Passwort:</p>
       <input class="textarea" type = "password" value="<?php if (isset ($postPassword)) { echo $postPassword;} ?>" name="post-password">
       <input class = "bottom" type = "submit" name="bottom"> 
      </div>
    </form>
</body>
</html>