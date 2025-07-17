<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>&#x1F399; Mon jukebox avec BD</title>
  <link rel="stylesheet" type="text/css" href="view/design/style.css">
  <title></title>
</head>

<body>
  <header>
    <h1>Ma musique dans mon Jukebox</h1>
  </header>
  <!-- Navigation -->
  <nav>
    <p>
      <a href="?ctrl=jukebox&page=1&pageSize=<?= $pageSize ?>">
        <span class="arrow left"></span><span class="arrow left"></span>
      </a>
      <a href="?ctrl=jukebox&page=<?= $prev ?>&pageSize=<?= $pageSize ?>">
        <span class="arrow left"></span>
      </a>
      <a class="selected" href="?ctrl=jukebox&page=<?= $page ?>&pageSize=<?= $pageSize ?>"><?= $page ?>
      </a>
      <?php for ($i = $page + 1; $i < $page + $nbButtonPage && $i <= $lastPage; $i++) : ?>
        <a href="?ctrl=jukebox&page=<?= $i ?>&pageSize=<?= $pageSize ?>"><?= $i ?>
        </a>
      <?php endfor; ?>
      <a href="?ctrl=jukebox&page=<?= $next ?>&pageSize=<?= $pageSize ?>">
        <span class="arrow right"></span>
      </a>
      <a href="?ctrl=jukebox&page=<?= $lastPage ?>&pageSize=<?= $pageSize ?>">
        <span class="arrow right"></span><span class="arrow right"></span>
      </a>
    </p>
    <form action="?ctrl=jukebox&page=<?= $page ?>" method="get">
      <p>Musiques/page</p>
      <input type="text" name="pageSize" value="<?= $pageSize ?>" maxlength="4" size="2">
      <input type="hidden" name="page" value="<?= $page ?>">
    </form>
  </nav>

  <!-- Contenu principal -->
  <main>
    <section>
      <?php foreach ($list as $music) :  ?>
        <figure>
          <a href="?ctrl=playId&id=<?= $music->getId() ?>&page=<?= $page ?>&pageSize=<?= $pageSize ?>">
            <img src="<?= $music->getCover() ?>" />
          </a>
          <figcaption>
            <music-song><?= $music->getTitle() ?></music-song>
            <music-group><?= $music->getAuthor() ?></music-group>
            <music-category><?= $music->getCategory() ?></music-category>
          </figcaption>
        </figure>
      <?php endforeach; ?>
    </section>
  </main>
  <footer>
    Jukebox IUT
  </footer>
</body>

</html>