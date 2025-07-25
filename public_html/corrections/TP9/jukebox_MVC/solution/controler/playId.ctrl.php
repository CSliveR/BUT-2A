<?php
require_once('model/music.class.php');
require_once('framework/view.fw.php');


// récupération des valeurs de la query string
if (isset($_GET['id'])) {
  $id = intVal($_GET['id']);
} else {
  exit("Erreur : id non définit");
}

// Si la page n'est pas indiquée, on repart à 1
if (isset($_GET['page'])) {
  $page = intVal($_GET['page']);
} else {
  $page = 1;
}

// Si le nombre de musique par page n'est pas indiqué, on choisit 8
if (isset($_GET['pageSize'])) {
  $pageSize = intVal($_GET['pageSize']);
} else {
  $pageSize = 8;
}

// Récupération de l'objet musique correspondant à l'id
$music = Music::read($id);

///////// AJOUTE POUR MVC
$view = new View();

// Passage des paramètres à la vue
$view->assign("music",$music);
$view->assign("page",$page);
$view->assign("pageSize",$pageSize);

// Appel de la vue
$view->display("playId");
?>
