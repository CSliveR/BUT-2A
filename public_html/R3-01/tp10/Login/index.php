<?php
session_start();

// Envoit sur le login
include("view/login.html");

$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';
$submit = $_POST['submit'] ?? '';

$validLogin = 'martin';
$validPassword = '1234';

// Vérifie si l'utilisateur est déjà connecté
$isLoggedIn = isset($_SESSION['login']);

var_dump($_POST);
var_dump($_SESSION);

switch($submit){
    case 'login':
        if($login === $validLogin && $password === $validPassword){
            $_SESSION['login'] = $login;
            include("view/main.php");
        }else{
            echo "<p style='color: red;'>Nom d'utilisateur ou mot de passe incorrect</p>";
            include("view/login.html");
        }
        break;

    case 'new': 
        include("view/not_implemented.html");
        break;

    default:
        // Cas où l'utilisateur n'a pas utilisé le formulaire
        if ($isLoggedIn) {
            include("view/main.php");
        } else {
            include("view/login.html");
        }
        break;
}

/* 
// Vérification de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Le formulaire a été soumis !<br>";
    var_dump($_POST);  // Affiche le contenu de $_POST
} else {
    echo "Le formulaire n'a pas encore été soumis.<br>";
}
 */
?>
