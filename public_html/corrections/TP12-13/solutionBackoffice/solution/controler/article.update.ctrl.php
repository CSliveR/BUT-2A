<?php
// Controleur pour l'action sur les articles
// 
// Inclusion du framework
include_once('framework/view.fw.php');
// Inclusion du modèle
include_once('model/Article.class.php');

// 
//
///////////////////////////////////////////////////////////////////////////////
// Partie récupération des données
///////////////////////////////////////////////////////////////////////////////

$ref = $_GET['ref'];
// Seul le libelle et le prix sont modifiables
$libelle = $_GET['libelle'] ?? '';
$prix = $_GET['prix'] ?? 0;

///////////////////////////////////////////////////////////////////////////////
// Partie calculs avec le modèle
///////////////////////////////////////////////////////////////////////////////

// Test pour afficher les erreurs
$error=array();
$imageURL = '';

if ($libelle == '') {
  $error[] = 'Le libelle doit être non vide';
}
if ($prix == 0) {
  $error[] = 'Le prix doit être non nul';
}


// S'il n'y  pas d'erreur, on fait la mise à jour
if (count($error) == 0) {
  // Récupère l'article
  $article = Article::read($ref);
  // Applique les mises à jour
  $article->setPrix($prix);
  $article->setLibelle($libelle);
  // Sauvegarde dans la base
  try {
    $article->update();
  } catch (Exception $e) {
      $error[] = $e->getMessage();
  }
}


// Si finalement aucune erreur, on envois le message Ok
if (count($error)==0) {
  $message = "L'article a correctement été mise à jour dans la base";
} else {
  $message = '';
}


////////////////////////////////////////////////////////////////////////////
// Construction de la vue
////////////////////////////////////////////////////////////////////////////
$view = new View();
$view->assign('article',$article);
$view->assign('error',$error);
$view->assign('message',$message);
$view->display('article.update');

// 
?>
