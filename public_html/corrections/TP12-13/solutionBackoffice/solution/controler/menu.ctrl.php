<?php
// Réaction à tous les boutons du menu
// 
// Inclusion du framework
include_once('framework/view.fw.php');
// Inclusion du modèle
include_once('model/Article.class.php');

// 
//

// Récupération de la vue à lancer
$viewName = $_GET['viewName'] ?? 'main';

// Erreurs potentielles
$error = array();

// Objet vue
$view = new View();

// Autres choix du menu
// Récupére l'article s'il est connu de la session, sinon crée un article vide
$ref = $_SESSION['ref'] ?? 0;
if ($ref != 0) {
    $article = Article::read($ref);
} else {
    $article = new Article();
}

// Passe l'article aux vues
$view->assign('article',$article);

// Lance la vue
$view->display($viewName);

// 
