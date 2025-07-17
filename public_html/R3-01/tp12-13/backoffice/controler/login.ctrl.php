<?php
// 
// Inclusion du framework
include_once("framework/view.fw.php");

// 
///////////////////////////////////////////////////////
// A COMPLETER
///////////////////////////////////////////////////////
$expectedLogin = "Iriesu";
$expectedPassword = "setsuzoku";
$login = isset($_POST['login']) ? $_POST['login'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
$connected = ($login === $expectedLogin && $password === $expectedPassword); 

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