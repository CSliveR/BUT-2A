<?php
// 
// Inclusion du framework
include_once(__DIR__."/../framework/view.class.php");

////////////////////////////////////////////////////////////////////////////
// Construction de la vue
////////////////////////////////////////////////////////////////////////////
$view = new View();

// Pas de contacts a afficher au début
$view->assign('contacts', []);
// Pas de patterns de filtrage
$view->assign('pattern', '');
// Charge la vue
$view->display("main.view.php")
?>
