<?php

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

    $postUsername = $_POST['post-username'];
    $postPassword = $_POST['post-password'];
    
    if (empty($postUsername)) {
        $errors[] = 'Geben Sie bitte einen Benutzernamen ein.';
    }
    if (empty($postPassword)) {
        $errors[] = 'Geben Sie bitte ein Passwort ein.';
    } 

    if (count($errors) === 0) {

        $stmt = $pdo->prepare("SELECT * FROM register WHERE post_username = :post_username");
        $result = $stmt->execute(array('post_username' => $postUsername));
        $user = $stmt->fetch();
         
        if ($user === false) {
         $errors[] = 'Login fehlgeschlagen.';
        } else {
            if ($user["post_username"] == $postUsername && $user["post_password"] == $postPassword) {
                $_SESSION['userid'] = $user['id'];
            }   
            else {
                $_SESSION['userid'] = -1; 
            } 
        } 
    }
}
?>