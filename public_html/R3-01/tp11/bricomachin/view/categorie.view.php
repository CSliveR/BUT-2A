<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="author" content="Jean-Pierre Chevallet" />
  <link rel="stylesheet" type="text/css" href="view/design/style.css">
  <title>Selection des categorie</title>
</head>
<body>
  <h1>Choisir une catégorie</h1>
  <h2><?=$nomCategorie?></h2>
  <!-- Bouton de retour au début de la liste -->
  <!--    -->
  <!-- Placer ici le formulaire de sélection des sous catégories -->
  <!--  -->
  <form class="categorie" method="get">
    <input type="hidden" name="ctrl" value="choisirCategorie">
    <?php if(!empty($subCategories)) : ?>
    <?php foreach($subCategories as $subCategorie) : ?>
      <button type="submit" name="idCategorie" value="<?= $subCategorie->getId() ?>">
          <?= $subCategorie->getNom() ?>
      </button>
    <?php endforeach; ?>
    <?php else: ?>
  <!-- Attention : pour ajouter un nom=valeur à la query string dans un formulaire il faut une entrée cachée -->
  <nav>
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
  <?php foreach($articles as $article) :  ?>
  <article>
    <h2><?= $article->getlibelle();?></h2>
    <img src="<?= $article->getImageURL();?>" alt="image d'un article de bricomachin">
    <p><?= $article->getPrix();?></p>
  </article>
</form>
  <?php endforeach; ?>
<?php endif; ?>
</body>
</html>
