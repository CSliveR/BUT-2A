<?php
// 
// Inclusion du framework
include_once("framework/view.fw.php");

// 
//
///////////////////////////////////////////////////////////////////////////////
// Partie récupération des données
///////////////////////////////////////////////////////////////////////////////

$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';

///////////////////////////////////////////////////////////////////////////////
// Partie calculs avec le modèle
///////////////////////////////////////////////////////////////////////////////

// Vérification du mot de passe
if ($login == 'admin' && $password == 'admin') {
  $connected = true;
} else {
  $connected = false;
}
// Conserve l'information dans la session
$_SESSION['connected'] = $connected;


// 

////////////////////////////////////////////////////////////////////////////
// Construction de la vue
////////////////////////////////////////////////////////////////////////////
$view = new View();

if ($connected) {
  $view->assign('title', 'Vous êtes connecté');
  $view->assign('message','Vous pouvez utiliser les boutons du menu.');
} else {
  $view->assign('title', "Vous n'êtes pas connecté.");
  $view->assign('message','Vous devez vous logger.');
}
$view->display('message');
?>