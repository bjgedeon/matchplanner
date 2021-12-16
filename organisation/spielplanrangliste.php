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
    if (!empty($_POST['post-team1'])) {
        $postTeam1 = $_POST['post-team1'];
    } else {
        $errors[] = 'Team1 eingeben';
    }
    if (!empty($_POST['post-team2'])) {
        $postTeam2 = $_POST['post-team2'];
    } else {
        $errors[] = 'Team2 eingeben';
    }
    if (!empty($_POST['post-time'])) {
        $postTime = $_POST['post-time'];
        if (!preg_match('/[0-9]+:+[0-9]/', $postTime)) {
            $errors[] = 'Die Zeit nach Vorschrift eingeben.';
        }
    } else {
        $errors[] = 'Zeit eingeben';
    }
 
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO `matchplan` (post_team1, post_team2, post_time) VALUES (:postTeam1, :postTeam2, :postTime)");
        $stmt -> execute([':postTeam1' => $postTeam1, ':postTeam2' => $postTeam2, ':postTime' => $postTime]);
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

    <h2>Information eingeben</h2>
     <p>Team1:</p> 
     <input class="textarea" type = "text" value="<?php if (isset ($postTeam1)) { echo $postTeam1;} ?>" name = "post-team1"> 
     <p>Team2:</p>
     <input class="textarea" type = "text" value="<?php if (isset ($postTeam2)) { echo $postTeam2;} ?>" name = "post-team2">
     <p>Spielzeit:</p>
     <input class="textarea" type = "text" value="<?php if (isset ($postTime)) { echo $postTime;} ?>" name = "post-time" placeholder="XX:XX">
    <input class = "bottom" type = "submit" name="bottom">
    </div>
</form>
 </main>
</body>
</html>