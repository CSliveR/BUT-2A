<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="view/design/style.css">
    <title></title>
  </head>
  <body>
    <header>
      <h1>Playing : <?=$music->getTitle()?> from <?=$music->getAuthor()?></h1>
    </header>
    <nav>
      <a href="?ctrl=jukebox&page=<?=$page?>&pageSize=<?=$pageSize?>">
        back
      </a>
    </nav>
    <section>
      <figure>
        <img src="<?= $music->getCover() ?>">
        <audio src="<?= $music->getMp3() ?>" controls autoplay ></audio>
      </figure>
    </section>
    <br/>
  </body>
</html>