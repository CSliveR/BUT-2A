<?php
// 
// 
// Inclusion du modèle
include_once(__DIR__."/../model/categorie.class.php");
// Inclusion du framework
include_once(__DIR__."/../framework/view.fw.php");

/////////////////////////////////////////////////////////////////////
// Récupération des données
/////////////////////////////////////////////////////////////////////
// Récupère l'identifiant de la catégorie courante
// S'il y en n'a pas, on débute à la première catégorie
$idCategorie = $_GET['idCategorie'] ?? 1;

/////////////////////////////////////////////////////////////////////
// Utilisation du modèle
/////////////////////////////////////////////////////////////////////

// Récupération de la catégorie sachant son id
$categorie = Categorie::read($idCategorie);

// Récupération de la liste des sous catégories
$sousCategories = $categorie->readSubCategorie();

// Si la liste est vide alors c'est une catégorie terminale
// Il faut revenir à l'affichage des articles
if (count($sousCategories)== 0) {
  // Place l'id de la catégorie dans le tableau des attributs de la query string
  $_GET['idCategorie'] = $idCategorie;
  // Appelle le controleur d'affichage des articles
  include("afficherArticles.ctrl.php");
} else {
  /////////////////////////////////////////////////////////////////////
  // Déclanchement de la vue
  /////////////////////////////////////////////////////////////////////
  $view = new View();
  $view->assign('categorie',$categorie);
  $view->assign('sousCategories',$sousCategories);
  $view->display("categorie");
}
// 
?>
