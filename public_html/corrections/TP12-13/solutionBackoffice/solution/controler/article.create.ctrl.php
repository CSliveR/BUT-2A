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
//
///////////////////////////////////////////////////////////////////////////////
// Partie récupération des données
///////////////////////////////////////////////////////////////////////////////

$ref = $_POST['ref'] ?? 0;
$libelle = $_POST['libelle'] ?? '';
$idCategorie = $_POST['categorie'] ?? 0;
$prix = $_POST['prix'] ?? 0;

// Récupération de l'image
$file_tmp_name = $_FILES['image']['tmp_name'] ?? '';
$file_size = $_FILES['image']['size'] ?? 0;
$file_error = $_FILES['image']['error'] ?? -1;
$file_type = $_FILES['image']['type'] ?? '';

///////////////////////////////////////////////////////////////////////////////
// Partie calculs avec le modèle
///////////////////////////////////////////////////////////////////////////////

// Test pour afficher les erreurs
$error=array();
if ($ref==0) {
  $error[] = 'La reférence doit être non nulle';
}
if ($libelle == '') {
  $error[] = 'Le libelle doit être non vide';
}
if ($idCategorie == 0) {
  $error[] = 'La catégorie doit être indiquée';
}
if ($prix == 0) {
  $error[] = 'Le prix doit être non nul';
}
if ($file_tmp_name == '') {
  $error[] = 'Il faut indiquer le nom du fichier';
}
if ($file_size == 0) {
  $error[] = 'La taille du fichier image doit être non nulle';
}
if ($file_error != 0) {
  $error[] = "L'erreur $file_error a été detectée lors du transfert de l'image";
}
if ($file_type != 'image/jpeg' && $file_type != 'image/png') {
  $error[] ="L'image doit être de type JPEG ou PNG";
}

// S'il n'y a pas d'erreur on récupère l'image
$filename = '';
if (count($error) == 0) {
  // Construit le nom de l'image
  // IL n'y a que deux types possibles
  if ($file_type == 'image/jpeg') {
    $filename = $ref.".jpeg";
  } else {
    $filename = $ref.".png";
  }
  // Stocke l'image dans le répertoire approprié
  if ( ! move_uploaded_file($file_tmp_name, $imgPath.$filename)) {
    $error[] = "L'image n'a pas pu être copiée";
  }
}

// S'il n'y a toujours pas d'erreur, on ajoute l'image à la base
if (count($error) == 0) {
  // Récupère la catégorie de l'article
  $categorie = new Categorie($idCategorie);
  // Crée un nouvel article
  // Comme l'image est locale, l'indique en ajoutant le '/' en début de nom
  $article = new Article($ref,$libelle,$categorie,$prix,'/'.$filename);
  // Sauvegarde dans la base
  try {
    $article->create();
  } catch (Exception $e) {
    switch ($e->getCode()) {
      case 23000:
        $error[] = "La référence existe déjà";
      break;
      default:
        $error[] = $e->getMessage();
      break;
    }
  }
}

// Si finalement aucune erreur, on envois le message Ok
if (count($error)==0) {
  $message = "L'article a correctement été inséré dans la base";
} else {
  $message = '';
}


////////////////////////////////////////////////////////////////////////////
// Construction de la vue
////////////////////////////////////////////////////////////////////////////
$view = new View();
$view->assign('ref',$ref);
$view->assign('libelle',$libelle);
$view->assign('prix',$prix);
$view->assign('error',$error);
$view->assign('message',$message);
$view->display("article.create");

// 
?>
