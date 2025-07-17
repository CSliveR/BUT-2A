<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
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
      <h2><?= $title ?></h2>
      <p>
        <?= $message ?>
      </p>
    </main>
  </body>
</html>
