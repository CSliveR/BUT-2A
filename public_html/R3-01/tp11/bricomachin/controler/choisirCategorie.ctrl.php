<?php
/////////////////////////////////////////////////////////////////////
// A completer
/////////////////////////////////////////////////////////////////////
// Inclusion du framework
include_once('framework/view.fw.php');
// Inclusion du modèle
include_once('model/article.class.php');
include_once('model/categorie.class.php');

$idCategorie = isset($_GET['idCategorie']) ? (int)$_GET['idCategorie'] : 1;
$categorie = Categorie::read($idCategorie);
$nomCategorie = $categorie->getNom();
$subCategories = $categorie->readSubCategorie();

// Numero de page
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$articlePerPage = 12;
$totalPages = ceil(Article::count()/$articlePerPage);
$pagePrec = ($page > 1) ? $page - 1 : 1;
$pageSuiv = ($page < $totalPages) ? $page + 1 : $totalPages;
$articles = Article::readPageCategorie($page, $articlePerPage, $categorie); 

////////////////////////////////////////////////////////////////////////////
// Construction de la vue
////////////////////////////////////////////////////////////////////////////
$view = new View();

// Passe les paramètres à la vue
$view->assign('idCategorie',$idCategorie);
$view->assign('categorie', $categorie);
$view->assign('nomCategorie',$nomCategorie);
$view->assign('subCategories', $subCategories);

$view->assign('articles',$articles);
$view->assign('page',$page);
$view->assign('pagePrec',$pagePrec);
$view->assign('pageSuiv',$pageSuiv);

// Charge la vue
$view->display("categorie");
?>
