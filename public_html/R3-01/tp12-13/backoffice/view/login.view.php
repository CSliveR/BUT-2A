<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Vue login du backoffice</title>
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
    <h2>Login</h2>
    <form action="index.php?ctrl=login" method="post">
      <p>
        <label for="login">Login</label>
        <input id="login" type="text" name="login" value="">
      </p>
      <p>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" value="">
      </p>
      <button type="submit" name="ok">ok</button>
    </form>
  </main>
</body>

</html>