<?php
// Joue une musique connue par son Id
// Inclusion du modèle
require_once('model/music.class.php');

// récupération des valeurs de la query string
if (isset($_GET['id'])) {
  $id = intVal($_GET['id']);
} else {
  exit("Erreur : id non définit");
}

// Si la page n'est pas indiquée, on repart à 1
if (isset($_GET['page'])) {
  $page = intVal($_GET['page']);
} else {
  $page = 1;
}

// Si le nombre de musique par page n'est pas indiqué, on choisit 8
if (isset($_GET['pageSize'])) {
  $pageSize = intVal($_GET['pageSize']);
} else {
  $pageSize = 8;
}

// Récupération de l'objet musique correspondant à l'id
$music = Music::read($id);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="design/style.css">
    <title></title>
  </head>
  <body>
    <header>
      <h1>Playing : <?=$music->getTitle()?> from <?=$music->getAuthor()?></h1>
    </header>
    <nav>
      <a href="jukebox.php?page=<?=$page?>&pageSize=<?=$pageSize?>">
        back
      </a>
    </nav>
    <section>
      <figure>
        <img src="<?= $music->getCover() ?>">
        <audio src="<?= $music->getMp3() ?>" controls autoplay ></audio>
      </figure>
    </section>
    <br/>
  </body>
</html>
