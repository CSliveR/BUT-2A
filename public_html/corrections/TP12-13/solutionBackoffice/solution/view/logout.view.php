<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Vue logout du backoffice</title>
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
    <h2>Logout</h2>
    <form action="index.php?ctrl=logout" method="post">
      <p>
        Êtes-vous sur de vouloir vous déconnecter du backoffice ?
      </p>
      <div>
        <button type="submit" name="reponse" value="oui">Oui</button>
        <button type="submit" name="reponse" value="non">Non</button>
      </div>
    </form>
  </main>
</body>

</html>