<?php
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
       <div class="main">
       <form>
  <input type="radio" name="klasse" value="1,2Klasse">
  <label for="1,2Klasse">1, 2 Klasse</label><br>
  <input type="radio" name="klasse" value="3,4Klasse">
  <label for="3,4Klasse">3, 4 Klasse</label><br>
  <input type="radio" name="klasse" value="5,6Klasse">
  <label for="5,6Klasse">5, 6 Klasse</label>
</form>  
       </div>
   </main>
</body>
</html>