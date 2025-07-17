<html>
<head>
  <title>Bricomachin</title>
  <meta charset="UTF-8"/>
  <meta http-equiv="content-type" content="text/html;" />
  <meta name="author" content="Jean-Pierre Chevallet" />
  <link rel="stylesheet" type="text/css" href="view/design/style.css">
</head>

<body>
  <!--  -->
  <header>
    <h1>Bricomachin, le bricolage malin </h1>
    <p><img src="view/design/pub.png"/></p>
  </header>
  <nav>
    <!-- Bouton de retour au début de la liste -->
    <a href="?ctrl=afficherArticles"><img src="view/design/home.png"/></a>
    <!-- Attention : pour ajouter un nom=valeur à la query string dans un formulaire il faut une entrée cachée -->
    <form method="get">
      <input type="hidden" name="ctrl" value="choisirCategorie">
      <button type="submit">
        Choisir une catégorie
      </button>
    </form>
    <!-- Bouton de retour à la page précédente -->
    <a href="?ctrl=afficherArticles&page=<?=$pagePrec?>&idCategorie=<?=$idCategorie?>">&lt; </a>
    <!-- Informations sur le No de page -->
    <?= $page ?>
    <!-- Bouton pour passer à la page suivante -->
    <a href="?ctrl=afficherArticles&page=<?=$pageSuiv?>&idCategorie=<?=$idCategorie?>">></a>
  </nav>


  <h2><?=$nomCategorie?></h2>
  <?php
  // 
  foreach($articles as $a ) : ?>
  <article>
    <h2><?= $a->getLibelle() ?></h2>
    <img src="<?=$a->getImageURL()?>"/>
    <p><?=number_format($a->getPrix(),2)?>€</p>
  </article>
<?php endforeach; // 
?>
<footer>
  <p>Site fictif, issus de données réelles du Web</p>
</footer>
</body>
</html>
