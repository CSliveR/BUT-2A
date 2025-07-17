<?php
// Controleur pour l'action sur les articles
// 
// Inclusion du framework
include_once("framework/view.fw.php");
// Inclusion du modèle
include_once("model/Article.class.php");
// Nom du répertoire ou stocker les images téléchargées
$imgPath = "public/img/";

// 
///////////////////////////////////////////////////////
// A COMPLETER
///////////////////////////////////////////////////////
$ref = isset($_POST['ref']) ? new Article($ref) : -1;
$article = Article::read($ref); 
$libelle = $article->setLibelle($_POST['libelle']);
$prix = $article->setLibelle($_POST['prix']);
$image = $article->setImage($_POST['image']);
$error = array("La référence doit être non nulle", "Le libelle doit être non vide", "le prix doit être non nul",
"Il faut indiquer le nom du fichier", "la taille du fichier doit être non nulle", "l'erreur 4 a été détectée lors du transfert de l'image",
"L'erreur doit être de type JPEG ou PNG");

$view = new View();

$view->assign('ref', $ref);
$view->assign('libelle', $libelle);
$view->assign('prix', $prix);
$view->assign('image', $image);
$view->assign('error', $error);

$view->display("article.create");




// 
?>
