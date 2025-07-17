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
    <!-- Menu -->
    <?php include(__DIR__.'/menu.viewpart.php'); ?>
  </aside>
  <main>
    <h2>Ajout d'un nouvel article</h2>
    <form action="?ctrl=article.create" enctype="multipart/form-data" method="post">
      <p>
        <label for="ref">Référence</label>
        <input type="number" id="ref" name="ref" value="<?= $ref ?>">
      </p>
      <p>
        <label for="libelle">Libéllé</label>
        <textarea id="libelle" name="libelle" rows="1" cols="30"><?= $libelle ?></textarea>
      </p>
      <p>
        <label for="categorie">Catégorie</label>
        <select id="categorie" name="categorie">
          <option value="11">Clé et douille</option>
          <option value="12">Petit rangement (coffre, étagère, ...)</option>
          <option value="14">Coussin et housse de coussin</option>
          <option value="16">Embrasse et gland</option>
          <option value="17">Galette de chaise, coussin de sol et pouf</option>
          <option value="18">Garage et carport</option>
          <option value="21">Jonc de mer, sisal et fibre naturelle pour sol</option>
          <option value="22">Lampe</option>
          <option value="23">Lustre, suspension et plafonnier</option>
          <option value="24">Marteau</option>
          <option value="25">Moquette de sol en rouleau</option>
          <option value="27">Paillasson, tapis de propreté</option>
          <option value="29">Perceuse sans fil et visseuse</option>
          <option value="30">Rideau</option>
          <option value="31">Spot</option>
          <option value="32">Tapis de décoration</option>
          <option value="33">Vitrage, brise-bise</option>
          <option value="34">Voilage</option>
        </select>
      </p>
      <p>
        <label for="prix">Prix</label>
        <input type="number" step=".01" id="prix" name="prix" value="<?= $prix ?>">
      </p>
      <p>
        <label for="image">Image</label>
        <input type="file" id="image" name="image" accept="image/png, image/jpeg">
      </p>
      <button type="submit" name="add">Envoyer</button>
    </form>
    <?php if (isset($error) && count($error) != 0) : ?>
      <output class="error">
        <p>L'insertion n'a pas été réalisée à cause des erreurs suivantes : </p>
        <ul>
          <?php foreach ($error as $ligne) : ?>
            <li>
              <?= $ligne ?>
              <//li>
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
