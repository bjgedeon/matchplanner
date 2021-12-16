
<?php
$user = 'root';
$password = '';
$database = 'matchplanner';

$pdo = new PDO('mysql:host=localhost;dbname=' . $database, $user, $password, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

$stmt = $pdo->query('SELECT * FROM `sign_up`');
$sign_ups = $stmt->fetchALL(); 
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spielplan</title>
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300&display=swap" rel="stylesheet">
</head>
<body>
<header class="header">
        <h1 class="title">Spielplan 5, 6 Klasse</h1>
        <div class="div">
        <a class="link" href="home.php">Home</a>
        <a class="link" href="register.php">Anmeldung</a>
        <div class="dropdown">
        <button class="dropbtn" href="spielplan.php">Spielplan</a>
        <div class="dropdown-content">
        <a href="12klasse.php">1, 2 Klasse</a>
        <a href="34klasse.php">3, 4 Klasse</a>
        <a href="56klasse.php">5, 6 Klasse</a>
        </div>
</div>
        <a class="link" href="56klasse.php">Rangliste</a>
    </div>
    </header>
    <table>
    <tr class="th">
    <th>Klassenname</th>
    <th>Teamname</th>
</tr>
    <div>
    <?php
foreach($sign_ups as $sign_up)  { ?>
<?php
if ($sign_up['post_class'] == '5,6Klasse') {?>
<tr>
    <th><?= htmlspecialchars($sign_up['post_classname'])?></th>  
    <th><?= htmlspecialchars($sign_up['post_teamname'])?></th>
</tr>
<?php } ?>
<?php
} ?>
</body>
</html>