<?php
include('readDelimitedData.php');
// Lecture de toutes les musiques
$musics = readDelimitedData('jukeboxData.txt');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>&#x1F399; Mon jukebox static</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <header>
    <h1>Ma musique dans mon Jukebox</h1>
  </header>
  <main>
    <section>
    <!-- Placer ici une boucle d'affichage des musiques -->
     <?php foreach($musics as $music) : ?>
      <tr>
        <td> <?= $music ?></td>
      </tr>
      <?php endforeach; ?>
    </section>
  </main>
  <footer>
  </footer>
</body>
</html>
