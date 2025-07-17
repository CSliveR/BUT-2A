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
      <?php foreach ($musics as $music):
        // Identifie les noms de groupes et de musiques
        $group = $music[0];
        $song  = $music[1];
         ?>
      <figure>
        <a href="playPath.php?music=<?=$group?>/<?=$song?>">
          <img src="data/<?=$group?>/<?=$song?>.jpeg" />
        </a>
        <figcaption>
          <music-song><?=$group?></music-song>
          <music-group><?=$song?></music-group>
        </figcaption>
      </figure>
    <?php endforeach; ?>
    </section>
  </main>
  <footer>
  </footer>
</body>
</html>
