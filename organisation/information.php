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
    if (!empty($_POST['post-title'])) {
        $postTitle = $_POST['post-title'];
    } else {
        $errors[] = 'Titel eingeben';
    }
    if (!empty($_POST['post-text'])) {
        $postText = $_POST['post-text'];
    } else {
        $errors[] = 'Text eingeben';
    }
 
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO `info` (info_title, info_text) VALUES (:postTitle, :postText)");
        $stmt -> execute([':postTitle' => $postTitle, ':postText' => $postText]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information</title>
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300&display=swap" rel="stylesheet">
</head>
<body>
 <header class="header">
 <h1 class="title">Information</h1>
 <div class="div">
        <a href="home.php">Home</a>
        <a href="information.php">Information</a>
        <a href="anmeldungen.php">Anmeldungen</a>
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
            <div class="main">
<form method="post" action="information.php">

    <h2>Information eingeben</h2>
     <p>Titel:</p> 
     <input class="textarea" type = "text" value="<?php if (isset ($postTitle)) { echo $postTitle;} ?>" name = "post-title"> 
     <p>Text:</p>
    <textarea class="textarea" value="<?php if (isset ($postText)) { echo $postText;} ?>" name = "post-text" rows = "5" cols = "40" placeholder="Text"></textarea> 
    <input class = "bottom" type = "submit">
                    </div>
</form>
 </main>
</body>
</html>