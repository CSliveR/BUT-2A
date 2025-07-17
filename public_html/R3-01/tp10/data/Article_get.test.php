<?php
// Test de la classe Article
// Lancer le test en mode shell par : php Article.test.php
require_once("Article_get.class.php");

// Crée un nouvel article
$invalidArticle = new Article("68733559","Coffret de douilles 91 pièces",79.90, -3);
$article = new Article("68733560","Coffret de douilles 91 pièces",79.90);
$severalArticle = new Article("68733561","Coffret de douilles 91 pièces",79.90, 3);

// Affichage de cet objet
printf("Article : %s\n",$invalidArticle->__get('libelle'));
printf("Prix TTC : %s\n",$invalidArticle->__get('montant_TTC'));

printf("Article : %s\n",$article->__get('libelle'));
printf("Prix TTC : %s\n",$article->__get('montant_TTC'));

printf("Article : %s\n",$severalArticle->__get('libelle'));
printf("Prix TTC : %s\n",$severalArticle->__get('montant_TTC'));
?>
