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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anmeldungen</title>
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300&display=swap" rel="stylesheet">
</head>
<body>
<header class="header">
 <h1 class="title">Anmeldungen</h1>
 <div class="div">
        <a href="home.php">Home</a>
        <a href="information.php">Information</a>
        <a href="anmeldungen.php">Anmeldungen</a>
        <a href="spielplanrangliste.php">Spielplan und Rangliste</a>
    </div>
</header>   
<table>
    <tr class="th">
    <th>Kategorie</th>
    <th>Klassenname</th>
    <th>Teamname</th>
    <th>Anzahl teilnehmender Spieler</th>
    <th>Name der Lehrperson</th>
    <th>Name des Trainers/ der Trainerin</th>
    <th>Telefonnummer der Lehrperson</th>
    <th>Telefonnummer des Trainers/ der Trainerin</th>
    <th>Email-Adresse der Lehrperson</th>
    <th>Email-Adresse des Trainers/ der Trainerin</th>
</tr>
    <main>
    <?php
foreach($sign_ups as $sign_up)  { ?>
<tr>
    <th><?= htmlspecialchars($sign_up['post_class'])?></th>
    <th><?= htmlspecialchars($sign_up['post_classname'])?></th>  
    <th><?= htmlspecialchars($sign_up['post_teamname'])?></th>
    <th><?= htmlspecialchars($sign_up['post_students'])?></th>
    <th><?= htmlspecialchars($sign_up['post_teacher'])?></th>
    <th><?= htmlspecialchars($sign_up['post_trainer'])?></th>
    <th><?= htmlspecialchars($sign_up['post_numberteacher'])?></th>
    <th><?= htmlspecialchars($sign_up['post_numbertrainer'])?></th>
    <th><?= htmlspecialchars($sign_up['post_emailteacher'])?></th>
    <th><?= htmlspecialchars($sign_up['post_emailtrainer'])?></th>
</tr>
</div>
<?php
} ?>
   </main>
</body>
</html>