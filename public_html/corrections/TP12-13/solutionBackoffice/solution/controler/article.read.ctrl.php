<?php
// Controleur pour l'action sur les articles
// 
// Inclusion du framework
include_once("framework/view.fw.php");
// Inclusion du modèle
include_once("model/Article.class.php");
// Nom du répertoire ou stocker les images téléchargées
$imgPath = "/public/img/";

// 
//
///////////////////////////////////////////////////////////////////////////////
// Partie récupération des données
///////////////////////////////////////////////////////////////////////////////

$ref = $_GET['ref'] ?? 0;

///////////////////////////////////////////////////////////////////////////////
// Partie calculs avec le modèle
///////////////////////////////////////////////////////////////////////////////

// Test pour afficher les erreurs
$error=array();
if ($ref==0) {
  $error[] = 'La reférence doit être non nulle';
}

// S'il n'y a  pas d'erreur, on recherche l'objet
if (count($error) == 0) {
  try {
    $article = Article::read($ref);
    // Stocke dans la session la réference de l'article lu pour la mise à jour
    $_SESSION['ref'] = $ref;
  } catch (Exception $e) {
    // Conserve l'erreur pour l'afficher
    $error[] = $e->getMessage();
    // Crée un article vide pour l'affichage
    $article = new Article();
  }
}

////////////////////////////////////////////////////////////////////////////
// Construction de la vue
////////////////////////////////////////////////////////////////////////////
$view = new View();
$view->assign('article',$article);
$view->assign('error',$error);
$view->display('article.read');

// 
?>
