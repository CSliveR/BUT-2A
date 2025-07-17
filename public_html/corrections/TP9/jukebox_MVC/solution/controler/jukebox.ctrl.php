<?php
require_once('model/music.class.php');
require_once('model/dao.class.php');
require_once('framework/view.fw.php');

// Nombre de boutons de choix de page
$nbButtonPage = 8;

// Partie analyse des valeurs de la query string
$page = $_GET['page'] ?? 1;

// Nombre de musiques par page
if (isset($_GET['pageSize'])) {
  $pageSize = intVal($_GET['pageSize']);
} else {
  // Valeur par défaut
  $pageSize = 8;
}

// Calcul de la dernière page : division entière
$lastPage = intdiv(Music::maxId(),$pageSize);

// Test si la page prévue est correcte
if ($page < 1 || $page > $lastPage ) {
  $page = 1;
}

// Calcul du premier id de la page
$firstId = ($page - 1)*$pageSize +1;

$list = array();
// Récupération des données à placer dans la vue à partir du modèle
for($i=$firstId; $i<$firstId+$pageSize && $i <= Music::maxId();$i++){
  // Récupération de l'objet Music
  $m = Music::read($i);
  // Ajout à la liste des images à afficher
  $list[] =$m;
}

////////////////////////////////
// Passage des données à la vue
///////////////////////////////

// Les positions pour les boutons
if ( $page > $nbButtonPage) {
  $prev = $page - $nbButtonPage;
} else {
  $prev = 1;

}
if ($page + $nbButtonPage <= $lastPage) {
  $next = $page + $nbButtonPage;
} else {
  $next = $page;
}
////////////////////////////////
///////// AJOUTE POUR MVC
////////////////////////////////

$view = new View();
// Passage des paramètres à la vue
$view->assign("page",$page);
$view->assign("pageSize",$pageSize);
$view->assign("prev",$prev);
$view->assign("next",$next);
$view->assign("nbButtonPage",$nbButtonPage);
$view->assign("list",$list);
$view->assign("lastPage",$lastPage);
// Appel de la vue
$view->display("jukebox");
?>