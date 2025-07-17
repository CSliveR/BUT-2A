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
  <!--    -->
  <h2><?=$categorie->getNom()?></h2>
  <nav>
    <!-- Bouton de retour au début de la liste -->
    <a href="?ctrl=afficherArticles"><img src="view/design/home.png"/></a>
  </nav>
  <nav>
    <form class="categorie" method="get">
      <input type="hidden" name="ctrl" value="choisirCategorie"/>
      <?php foreach ($sousCategories as $categorie): ?>
        <!-- On utilise des boutons car on peut leur appliquer du CSS -->
        <button type="submit" name="idCategorie" value="<?=$categorie->getId()?>"><?=$categorie->getNom()?> </button>
      <?php endforeach; ?>
    </form>
  </nav>
  <!--  -->
</body>
</html>
