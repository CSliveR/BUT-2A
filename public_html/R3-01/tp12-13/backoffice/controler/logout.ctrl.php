<?php
// Inclusion du framework
include_once("framework/view.fw.php");

// Récupération des données du formulaire
$reponse = $_REQUEST['reponse'] ?? 'oui';

// On est forcément connecté (on pourrait détecter cette incohérence)
$connected = true;

if ($reponse == 'oui') {
  $connected = false;
  $_SESSION['connected'] = $connected; // A priori c'est inutile si la session est détruite
  // Detruit la session
  session_destroy();
}

////////////////////////////////////////////////////////////////////////////
// Construction de la vue
////////////////////////////////////////////////////////////////////////////
$view = new View();
if ($connected) {
  $view->assign('title', "Vous êtes resté connecté.");
  $view->assign('message', 'Vous pouvez continuer à utiliser le backoffice.');
} else {
  $view->assign('title', "Vous n'êtes plus connecté au backoffice.");
  $view->assign('message', "Pour l'utiliser à nouveau, vous devez recommencer la procédure de loggin.");
}
$view->display('message');
