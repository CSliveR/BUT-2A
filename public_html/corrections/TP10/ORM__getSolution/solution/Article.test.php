<?php
// Test de la classe Article
// Lancer le test en mode shell par : php Article.test.php
require_once("Article.class.php");

// Crée un nouvel article
$article = new Article("68733560","Coffret de douilles 91 pièces",79.90);

// Affichage de cet objet
var_dump($article);

printf("Article : %s\n",$article->libelle);
printf("Prix TTC : %s\n",$article->montant_TTC);
//printf("Prix TTC : %s\n",$article->id);





 ?>
