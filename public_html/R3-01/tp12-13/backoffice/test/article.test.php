<?php
// Test de la classe Article
require_once(__DIR__.'/../model/Article.class.php');
require_once(__DIR__.'/../model/Categorie.class.php');

// Affiche un texte avec des couleurs ANSI dans le shell
function printCol(string $text,string $col='red') {
  switch ($col) {
    case 'red':
      print("\e[1;4;31m");
          break;
    case 'green':
      print("\e[1;32m");
    default:
      break;
  }
  print($text."\e[0m");
}

// Affiche "OK en vert"
function OK() {
  printCol("OK\n",'green');
}

try {

  // Vérification de l'accès à une catégorie
  print("Lecture d'une catégorie : ");
  $value = Categorie::read(22);
  $expected = new Categorie(22,"Lampe",6);
  if ( $value != $expected) {
    var_dump($value);
    print("Attendu : \n");
    var_dump($expected);
    throw new Exception("Categorie 22 non trouvé");
  }
  OK();

  // Vérification de l'accès à un article
  print("Lecture d'un article : ");
  $value = Article::read(68393374);
  $categorie = Categorie::read(18);
  $expected = new Article(68393374,"Garage en bois Neuvy, 17 m²",$categorie,1650.00,"68393374.jpg");
  if ( $value != $expected) {
    var_dump($value);
    print("Attendu : \n");
    var_dump($expected);
    throw new Exception("Article 68393374 non trouvé");
  }
  OK();

  // Vérification que la tentative d'acces à un article inexistant provoque une exception
  print("Tentative de lecture d'un article inexistant : ");
  try {
    $article = Article::read(0);
    var_dump($article);
    throw new Exception("Article inexistant de ref 0 trouvé");
  } catch (Exception $e) {
    OK();
  }

  // Vérification de la sauvegarde d'un nouvel article
  print("Création d'un article : ");
  $categorie = Categorie::read(7);
  $article = new Article(99,"Test Applique murale",$categorie,150.00,"image.jpg");
  $article->create();
  // Vérifie que l'article existe
  $value = new Article(99,"Test Applique murale",$categorie,150.00,"image.jpg");
  $expected = Article::read(99);
  if ( $value != $expected) {
    var_dump($value);
    print("Attendu : \n");
    var_dump($expected);
    throw new Exception("Article 99 non inséré dans la base");
  }
  OK();

  // Vérification qu'on ne peut pas ajouter un autre article avec la même référence
  // Cette contrainte est normalement gérée par la base de donnée
  print("Refus de création d'un article avec même référence : ");
  $categorie = Categorie::read(7);
  $article = new Article(99,"Test",$categorie,10.00,"image.jpg");
  try {
    $article->create();
    throw new Exception("Article 99 inséré en double dans la base");
  } catch (Exception $e) {
    OK();
  }

  // Vérification de la modification d'un article
  print("Mise à jour d'un article : ");
  $expected = Article::read(99);
  // Modification du prix
  $expected->setPrix(112.00);
  // Mise à jour
  $expected->update();
  $value = Article::read(99);
  if ( $value != $expected) {
    var_dump($value);
    print("Attendu : \n");
    var_dump($expected);
    throw new Exception("Article 99 n'a pas été mis à jour");
  }
  OK();

  // Vérification de la destruction d'un article
  print("Suppression d'un article : ");
  $article = Article::read(99);
  $article->delete();
  // Verification qu'il n'y a plus cet article
  try {
    $article = Article::read(99);
    throw new Exception("L'article de reference 99 n'a pas été supprimé");
  } catch (Exception $e) {
    OK();
  }

} catch (Exception $e) {
  printCol("\nLe test produit l'erreur suivante :\n");
  exit($e->getMessage()."\n");
}



?>
