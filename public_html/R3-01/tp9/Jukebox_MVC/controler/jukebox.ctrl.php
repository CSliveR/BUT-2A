<?php
// Inclusion des fichiers nécessaires
require_once('model/music.class.php');
require_once('model/dao.class.php');
require_once('framework/view.fw.php');

// Récupération des informations de la query string (pagination)
$page = $_GET['page'] ?? 1;
$pageSize = $_GET['pageSize'] ?? 8;

// Calcul de la pagination
$nbButtonPage = 8;
$lastPage = ceil(Music::maxId() / $pageSize);

// Test si la page est correcte
if ($page < 1 || $page > $lastPage) {
    $page = 1;
}

$firstId = ($page - 1) * $pageSize + 1;

// Récupération des musiques
$list = array();
for ($i = $firstId; $i < $firstId + $pageSize && $i <= Music::maxId(); $i++) {
    $m = Music::read($i);
    $list[] = $m;
}

// Variables de navigation
$prev = $page > $nbButtonPage ? $page - $nbButtonPage : 1;
$next = $page + $nbButtonPage <= $lastPage ? $page + $nbButtonPage : $page;

// Création de la vue et passage des données
$view = new View();
$view->assign('page', $page);
$view->assign('pageSize', $pageSize);
$view->assign('list', $list);
$view->assign('nbButtonPage', $nbButtonPage);
$view->assign('lastPage', $lastPage);
$view->assign('prev', $prev);
$view->assign('next', $next);

// Affichage de la vue 'jukebox'
$view->display('jukebox');
?>
