<?php
$music = $_GET['music'] ?? 'Justice/D.A.N.C.E';

function initCover(string $music) : string{
  $coverLink = "data/$music.jpeg";
  $output = "<img src='{$coverLink}' alt='Cover de {$music}'/>";
  return $output;
}

function initMusic(string $music) : string{
  $musicLink = "data/$music.mp3";
  $output = "<audio src='{$musicLink}' controls autoplay></audio>";
  return $output;
}

function backBtn() : string {
  $content = "<nav><a href='staticJukebox.html'>Retour</a></nav>";
  return $content;
}
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
    <h1>Playing: <?= htmlspecialchars($music); ?></h1>
  </header>
  <main>
    <?= backBtn(); ?>
  <section>
      <figure>
        <?= initCover($music)?>
        <?= initMusic($music)?>
      </figure>
    </section>
    </main>
  <footer>
  </footer>
</body>
</html>
