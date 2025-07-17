<?php
// 
// Inclusion du framework
include_once('framework/view.fw.php');
// Inclusion du modèle
include_once('model/article.class.php');
include_once('model/categorie.class.php');

// 
///////////////////////////////////////////////////////
// A COMPLETER
///////////////////////////////////////////////////////

// Numero de page
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$articlePerPage = 12;
$totalPages = ceil(Article::count()/$articlePerPage);
$pagePrec = ($page > 1) ? $page - 1 : 1;
$pageSuiv = ($page < $totalPages) ? $page + 1 : $totalPages;

// Pas de filtrage par catégorie
$idCategorie = 0;
$nomCategorie = "Tous les produits";
$articles = Article::readPage($page, $articlePerPage);
//

////////////////////////////////////////////////////////////////////////////
// Construction de la vue
////////////////////////////////////////////////////////////////////////////
$view = new View();

// Passe les paramètres à la vue
$view->assign('nomCategorie',$nomCategorie);
$view->assign('articles',$articles);
$view->assign('idCategorie',$idCategorie);
$view->assign('page',$page);
$view->assign('pagePrec',$pagePrec);
$view->assign('pageSuiv',$pageSuiv);
// Charge la vue
$view->display("articles");
?>
