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
    <?php include(__DIR__.'/menu.viewpart.php'); ?>
  </aside>
  <main>
    <h2>Suppression d'un article</h2>
      <form action="?ctrl=article.delete" method="get">
      <input type="hidden" name="ctrl" value="article.delete">
        <!--  COMPLETER LE FORMULAIRE -->
          
        <!--  -->
      </form>
    <?php if (isset($error) && count($error) != 0) : ?>
      <output class="error">
        <p>La suppression n'a pas été réalisée à cause des erreurs suivantes : </p>
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
