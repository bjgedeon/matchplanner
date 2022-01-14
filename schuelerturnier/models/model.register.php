<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }

$userDb = 'root';
$passwordDb = '';
$database = 'matchplanner';

$pdo = new PDO('mysql:host=localhost;dbname=' . $database, $userDb, $passwordDb, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    if (!empty($_POST['post-username'])) {
    $postUsername = $_POST['post-username'];
    }
    else {
        $errors[] = 'Geben Sie bitte ein Benutzernamen ein.';
    }
    if (!empty($_POST['post-password1'])) {
    $postPassword1 = $_POST['post-password1'];
    }
    else {
        $errors[] = 'Geben Sie bitte ein Passwort ein.';
    }
    if (!empty($_POST['post-password2'])) {
        $postPassword2 = $_POST['post-password2'];
    }
    else {
        $errors[] = 'Geben Sie bitte das Passwort erneut ein.';
    }



    
    if (empty($errors)) {
        if ($postPassword1 != $postPassword2) {
            $errors[] = 'Die beiden Passwörter stimmen nicht miteinander überein.';
         }
    else {     
    $postPassword = $postPassword1;
    $stmt = $pdo->prepare("SELECT * FROM register WHERE post_username = :post_username");
    $stmt->execute(array('post_username' => $postUsername));
    $user = $stmt->fetch();

    if ($user === false) {
        $stmt = $pdo->prepare("INSERT INTO register (post_username, post_password) VALUES (:postUsername, :postPassword)");
        $stmt->execute(['postUsername' => $postUsername, 'postPassword' => $postPassword]);

    } else {
            $errors[] = 'Benutzername schon vergeben.';
        }   
    }
}
}
?>