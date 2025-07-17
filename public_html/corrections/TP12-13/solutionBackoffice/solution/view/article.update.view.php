<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Vue principale du backoffice</title>
  <meta name="author" content="Jean-Pierre Chevallet" />
  <link rel="stylesheet" type="text/css" href="public/design/style.css">
</head>

<body>
  <header>
    <h1>Bricomachin: backoffice</h1>
  </header>
  <aside>
    <!-- Menu  -->
    <?php include(__DIR__ . '/menu.viewpart.php'); ?>
  </aside>
  <main>
    <h2>Mise à jour d'un article</h2>
    <form method="get">
      <input type="hidden" name="ctrl" value="article.update">
      <!--  -->
      <p>
        <label for="ref">Référence</label>
        <input type="number" id="ref" name="ref" value="<?= $article->getRef() ?>" readonly>
      </p>
      <p>
        <label for="libelle">Libéllé</label>
        <textarea id="libelle" name="libelle" rows="1" cols="30"><?= $article->getLibelle() ?></textarea>
      </p>
      <p>
        <label for="categorie">Catégorie</label>
        <input type="text" id="categorie" name="categorie" value="<?= $article->getCategorieNom() ?>" readonly>
      </p>
      <p>
        <label for="prix">Prix</label>
        <input type="number" step=".01" id="prix" name="prix" value="<?= $article->getPrix() ?>">
      </p>
      <p>
        <img src="<?= $article->getImageURL() ?>" alt="Photo produit">
      </p>
      <button type="submit" name="update">Modifier</button>
      <!--  -->
    </form>
    <?php if (isset($error) && count($error) != 0) : ?>
      <output class="error">
        <p>La modification n'a pas été réalisée à cause des erreurs suivantes : </p>
        <ul>
          <?php foreach ($error as $ligne) : ?>
            <li>
              <?= $ligne ?>
              </ /li>
            <?php endforeach; ?>
        </ul>
      </output>
    <?php endif; ?>
    <?php if (isset($message) && $message != "") : ?>
      <output>
        <?= $message ?>
      </output>
    <?php endif; ?>
  </main>
</body>

</html>