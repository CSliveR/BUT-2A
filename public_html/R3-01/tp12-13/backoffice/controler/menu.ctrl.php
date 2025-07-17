<?php
// Réaction à tous les boutons du menu
// 
// Inclusion du framework
include_once('framework/view.fw.php');
// Inclusion du modèle
include_once('model/Article.class.php');

// 
///////////////////////////////////////////////////////
// A COMPLETER
///////////////////////////////////////////////////////

$viewName = isset($_GET['viewName']) ? $_GET['viewName'] : '';

// Instanciation de la vue
$view = new View();
$view->assign("$viewName"); 
