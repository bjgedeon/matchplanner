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
    <title>Home</title>
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300&display=swap" rel="stylesheet">
</head>
<body>
<header class="header">
 <h1 class="title">Organisation Schülerturnier Ebikon
 </h1>
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
</body>
</html>