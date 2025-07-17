<?php
// Vérification de la présence du paramètre
if (isset($_GET['music'])) {
  $music = $_GET['music'];
} else {
  /// En l'absence du paramètre prend une valeur par défaut
  $music = 'Justice/D.A.N.C.E';
}
// calcule les chemin des fichiers
$musicPath = 'data/'.$music;
$mp3 = $musicPath.'.mp3';
$cover = $musicPath.'.jpeg';
?>
<html>
<head>
  <meta charset="UTF-8">
  <title>Mon jukebox static: play</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <header>
    <h1>Playing : <?= $music ?></h1>
  </header>
  <main>
    <nav>
      <a href="<?=$_SERVER["HTTP_REFERER"]?>">&#x2B05; Retour</a>
    </nav>
    <section>
      <figure>
        <img src="<?= $cover ?>"/>
        <audio src="<?= $mp3 ?>" controls autoplay ></audio>
      </figure>
    </section>
  </main>
  <footer>
  </footer>
</body>
</html>
