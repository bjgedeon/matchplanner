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
    if (empty($_POST['post-group'])) {
        $postGroup = rand(1,2);
    }
    if (!empty($_POST['post-classname'])) {
        $postClassname = $_POST['post-classname'];
    } else {
        $errors[] = 'Klassenamen';
    }
    if (!empty($_POST['post-teamname'])) {
        $postTeamname = $_POST['post-teamname'];
    } else {
        $errors[] = 'Teamnamen';
    }
    if (!empty($_POST['post-class'])) {
        $postClass = $_POST['post-class'];
    } else {
        $errors[] = 'Kategorie';
    }
    if (!empty($_POST['post-students'])) {
        $postStudents = $_POST['post-students'];
        if (!is_numeric($postStudents)) {
            $errors[] = 'Anzahl teilnehmender Spieler in einer Zahl';
        }
    }
    else {
        $errors[] = 'Anzahl teilnehmender Spieler';
    }
    if (!empty($_POST['post-teacher'])) {
        $postTeacher = $_POST['post-teacher'];
    } else {
        $errors[] = 'Namen der Lehrperson.';
    }
    if (!empty($_POST['post-numberteacher'])) {
        $postNumberteacher = $_POST['post-numberteacher'];
        if (!preg_match('/^[\+ 0-9]+$/', $postNumberteacher)) {
            $errors[] = 'gültige Telefonnummer bei der Lehrperson';
        }
    }
    else {
        $errors[] = 'Telefonnummer bei der Lehrperson';
    }
    if (!empty($_POST['post-emailteacher'])) {
        $postEmailteacher = $_POST['post-emailteacher'];
        if (strpos($postEmailteacher, '@') === false) {
            $errors[] = 'gültige Email-Adresse bei der Lehrperson';
        }
    }
    else {
        $errors[] = 'Email-Adresse bei der Lehrperson';
    }
    if (!empty($_POST['post-trainer'])) {
        $postTrainer = $_POST['post-trainer'];
    } else {
        $errors[] = 'Namen des Betreuers/ der Betreuerin';
    }
  
    if (!empty($_POST['post-numbertrainer'])) {
        $postNumbertrainer = $_POST['post-numbertrainer'];
        if (!preg_match('/^[\+ 0-9]+$/', $postNumbertrainer)) {
            $errors[] = 'gültige Telefonnummer bei dem Betreuer/ der Betreuerin';
        }
    }
    else {
        $errors[] = 'Telefonnummer, bei dem Betreuers/ der Betreuerin';
    }

    if (!empty($_POST['post-emailtrainer'])) {
        $postEmailtrainer = $_POST['post-emailtrainer'];
        if (strpos($postEmailtrainer, '@') === false) {
            $errors[] = 'gültige E-mail-Adresse, bei dem Betreuers/ der Betreuerin';
        }
    }
    else {
        $errors[] = 'E-mail-Adresse, bei dem Betreuers/ der Betreuerin';
    }
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO `sign_up` (post_group, post_class, post_students, post_classname, post_teamname, post_numberteacher, post_numbertrainer, post_emailteacher,  post_emailtrainer, post_teacher, post_trainer) VALUES (:postGroup, :postClass, :postStudents, :postClassname, :postTeamname, :postNumberteacher, :postNumbertrainer, :postEmailteacher, :postEmailtrainer, :postTeacher, :postTrainer)");
        $stmt -> execute([':postGroup' => $postGroup,':postClass' => $postClass, ':postStudents' => $postStudents, ':postClassname' => $postClassname, ':postTeamname' => $postTeamname, ':postNumberteacher' => $postNumberteacher, ':postNumbertrainer' => $postNumbertrainer, ':postEmailteacher' => $postEmailteacher, ':postEmailtrainer' => $postEmailtrainer, ':postTeacher' => $postTeacher, ':postTrainer' => $postTrainer]);
    }
}
?>