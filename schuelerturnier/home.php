<?php

include '../includes/sessionhandler.php';

$user = 'root';
$password = '';
$database = 'matchplanner';

$pdo = new PDO('mysql:host=localhost;dbname=' . $database, $user, $password, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

$stmt = $pdo->query('SELECT * FROM `info`');
$infos = $stmt->fetchALL(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300&display=swap" rel="stylesheet">
</head>
<body>


         <header class="header">
         <?php 
    if ($_SESSION["userid"] > 0) { ?>
  
      <button class="loggedinbutton"> <?php echo 'Eingeloggt, User ID: '  . $_SESSION["userid"]; ?></button>
  
    <?php }
    else {?>
       <div class="dropdown2">
        <button class="loggedoutbutton"> <?php echo 'NICHT EINGELOGGT'; ?> </button>
        <div class="dropdown-content2">
        <a href="register.php">registrieren</a>
        <a href="login.php">login</a>
        </div>
       </div>
         <?php } ?>

<?php
  if (isset($_POST['logout'])) {
        $_SESSION['userid'] = -1;
    }?>
        <h1 class="titlehome">Schülerturnier Ebikon 2022</h1>
        
        <div class="div">
        <a class="link" href="home.php">Home</a>
        <a class="link" href="register.php">Anmeldung</a>
        <div class="dropdown">
        <button class="dropbtn" href="spielplan.php">Spielplan</a>
        <div class="dropdown-content">
        <a href="spielplan12klasse.php">1 + 2 Klasse</a>
        <a href="spielplan34klasse.php">3 + 4 Klasse</a>
        <a href="spielplan56klasse.php">5 + 6 Klasse</a>
        </div>
</div>
<div class="dropdown">
        <button class="dropbtn" href="spielplan.php">Rangliste</a>
        <div class="dropdown-content">
        <a href="rangliste12klasse.php">1 + 2 Klasse</a>
        <a href="rangliste34klasse.php">3 + 4 Klasse</a>
        <a href="rangliste56klasse.php">5 + 6 Klasse</a>
        </div>
</div>
    </div>
    </header>
    <main>
    <?php
foreach($infos as $info)  { ?>
<div class="main">
    <h2 class="block"><?= htmlspecialchars($info['info_title'])?></h2> <br>
    <p class="block"><?= htmlspecialchars($info['info_text'])?></p>
</div>
<?php
}
?>
    
   </main>
</body>
</html>