<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Erreur interne du backoffice</title>
  <meta name="author" content="Jean-Pierre Chevallet" />
  <link rel="stylesheet" type="text/css" href="public/design/style.css">
</head>

<body>
  <header>
    <h1>Bricomachin: backoffice</h1>
  </header>
  <aside>
    <!-- Menu -->
    <?php include('menu.viewpart.php'); ?>
  </aside>
  <main>
    <h2>Erreur interne</h2>
    <p>Une erreur interne est survenue avec le message suivant :</p>
    <output class="error"><?= $error ?></output>
  </main>
</body>

</html>