<?php
// Inclusion du modèle
require_once('model/music.class.php');

// Nombre de boutons de choix de page
$nbButtonPage = 8;

// Partie analyse des valeurs de la query string
$page = $_GET['page'] ?? 1;

// Nombre de musiques par page
if (isset($_GET['pageSize'])) {
  $pageSize = intVal($_GET['pageSize']);
} else {
  // Valeur par défaut
  $pageSize = 8;
}



// Calcul de la dernière page
$lastPage = Music::maxId()/$pageSize+1;

// Test si la page prévue est correcte
if ($page < 1 || $page > $lastPage ) {
  $page = 1;
}


// Calcul du premier id de la page
$firstId = ($page - 1)*$pageSize +1;

$list = array();
// Récupération des données à placer dans la vue à partir du modèle
for($i=$firstId; $i<$firstId+$pageSize && $i <= Music::maxId();$i++){
  // Récupération de l'objet Music
  $m = Music::read($i);
  // Ajout à la liste des images à afficher
  $list[] =$m;
}

////////////////////////////////
// Passage des données à la vue
///////////////////////////////

// Les positions pour les boutons
if ( $page > $nbButtonPage) {
  $prev = $page - $nbButtonPage;
} else {
  $prev = 1;

}
if ($page + $nbButtonPage <= $lastPage) {
  $next = $page + $nbButtonPage;
} else {
  $next = $page;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>&#x1F399; Mon jukebox avec BD</title>
    <link rel="stylesheet" type="text/css" href="design/style.css">
    <title></title>
  </head>
  <body>
    <header>
      <h1>Ma musique dans mon Jukebox</h1>
    </header>
    <!-- Navigation -->
    <nav>
      <p>
        <a href="jukebox.php?page=1&pageSize=<?=$pageSize?>">
          <span class="arrow left"></span><span class="arrow left"></span>
        </a>
        <a href="jukebox.php?page=<?=$prev?>&pageSize=<?=$pageSize?>">
          <span class="arrow left"></span>
        </a>
        <a class="selected" href="jukebox.php?page=<?=$page?>&pageSize=<?=$pageSize?>"><?=$page?>
        </a>
        <?php for($i = $page+1; $i < $page + $nbButtonPage && $i<= $lastPage; $i++ ) : ?>
          <a href="jukebox.php?page=<?=$i?>&pageSize=<?=$pageSize?>"><?=$i?>
          </a>
        <?php endFor; ?>
        <a href="jukebox.php?page=<?=$next?>&pageSize=<?=$pageSize?>">
          <span class="arrow right"></span>
        </a>
        <a href="jukebox.php?page=<?=$lastPage?>&pageSize=<?=$pageSize?>">
          <span class="arrow right"></span><span class="arrow right"></span>
        </a>
      </p>
      <form action="jukebox.php?page=<?=$page?>" method="get">
        <p>Musiques/page</p>
        <input type="text" name="pageSize" value="<?=$pageSize?>" maxlength="4" size="2">
        <input type="hidden" name="page" value="<?=$page?>">
      </form>
    </nav>

    <!-- Contenu principal -->
    <main>
      <section>
      <?php foreach($list as $music) :  ?>
        <figure>
          <a href="playId.php?id=<?= $music->getId() ?>&page=<?=$page?>&pageSize=<?=$pageSize?>">
            <img src="<?= $music->getCover() ?>" />
          </a>
          <figcaption>
            <music-song><?= $music->getTitle()?></music-song>
            <music-group><?= $music->getAuthor()?></music-group>
            <music-category><?= $music->getCategory()?></music-category>
          </figcaption>
        </figure>
        <?php endForeach; ?>
        </section>
      </main>
      <footer>
        Jukebox IUT
      </footer>
  </body>
</html>
