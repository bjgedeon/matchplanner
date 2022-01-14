<?php
    include '../includes/sessionhandler.php';   

    $page = 'home';
    $title = 'Schülerturnier Ebikon 2022';

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }
  
    if ($page === 'home') {
        $title = 'Schülerturnier Ebikon 2022';
    }
    else if($page === 'anmeldung') {
        $title = 'Anmeldung';
    }
    else if ($page === 'register' || $page === 'login') {
    $title = 'Anmeldung';
    }
  else if ($page === 'rangliste12klasse') {
      $title = 'Rangliste 1 + 2 Klasse';
  }
  else if ($page === 'rangliste34klasse') {
    $title = 'Rangliste 3 + 4 Klasse';
}
else if ($page === 'rangliste56klasse') {
    $title = 'Rangliste 5 + 6 Klasse';
}
else if ($page === 'spielplan12klasse') {
    $title = 'Spielplan 1 + 2 Klasse';
}
else if ($page === 'spielplan34klasse') {
    $title = 'Spielplan 3 + 4 Klasse';
}
else if ($page === 'spielplan56klasse') {
    $title = 'Spielplan 5 + 6 Klasse';
}

else {
    $page = '404';
    $title = '404';
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
<?php 
    if ($_SESSION["userid"] > 0) { ?>
  
      <button class="loggedinbutton"> <?php echo 'eingeloggt, User ID: '  . $_SESSION["userid"]; ?></button>
  
    <?php }
    else {?>
       <div class="dropdown2">
        <button class="loggedoutbutton"> <?php echo 'nicht eingeloggt'; ?> </button>
        <div class="dropdown-content2">
        <a href="index.php?page=register">registrieren</a>
        <a href="index.php?page=login">login</a>
        </div>
       </div>
         <?php } ?>

<?php
  if (isset($_POST['logout'])) {
        $_SESSION['userid'] = -1;
    }?>
        <h1 class="title"><?=$title?></h1>
        <div class="div">
        <a class="link" href="index.php">Home</a>
        <a class="link" href="index.php?page=register">Anmeldung</a>
        <div class="dropdown">
        <button class="dropbtn" href="spielplan.php">Spielplan</a>
        <div class="dropdown-content">
        <a href="index.php?page=spielplan12klasse">1 + 2 Klasse</a>
        <a href="index.php?page=spielplan34klasse">3 + 4 Klasse</a>
        <a href="index.php?page=spielplan56klasse">5 + 6 Klasse</a>
        </div>
</div>
<div class="dropdown">
        <button class="dropbtn" href="spielplan.php">Rangliste</a>
        <div class="dropdown-content">
        <a href="index.php?page=rangliste12klasse">1 + 2 Klasse</a>
        <a href="index.php?page=rangliste34klasse">3 + 4 Klasse</a>
        <a href="index.php?page=rangliste56klasse">5 + 6 Klasse</a>
        </div>
</div>
    </div>
    </header>
    
    <?php include 'views/view.' . $page . '.php';
    ?>

</body>
</html>