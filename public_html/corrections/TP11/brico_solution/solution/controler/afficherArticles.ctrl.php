<?php
// 
// Inclusion du framework
include_once('framework/view.fw.php');
// Inclusion du modèle
include_once('model/article.class.php');
include_once('model/categorie.class.php');


// 
//
///////////////////////////////////////////////////////////////////////////////
// Partie récupération des données
///////////////////////////////////////////////////////////////////////////////

// Le No de page
$page = $_GET['page'] ?? 1;
// Récupère l'identifiant de la catégorie courante
$idCategorie = $_GET['idCategorie'] ?? 0;  // Zéro signifie toutes les catégories

///////////////////////////////////////////////////////////////////////////////
// Partie calculs avec le modèle
///////////////////////////////////////////////////////////////////////////////


// Nombre de produits par pages
$pageSize = 12;

// Regarde s'il y a un filtre par catégories
if ($idCategorie == 0) {
  // on récupère les 12 articles de la page courante
  $articles = Article::readPage($page,$pageSize);
  // le nom de la catégorie à afficher dans la vue
  $nomCategorie = "Tous les produits";
} else {
  // Récupère la catégorie
  $categorie = Categorie::read($idCategorie);
  // le nom de la catégorie à afficher dans la vue
  $nomCategorie = $categorie->getNom();
  // Filtre selon cette catégorie
  $articles = Article::readPageCategorie($page,$pageSize,$categorie);
}

// Calcul du No de la page précécent
if ($page > 1) {
  // il suffit de passer à la précédente
  $pagePrec = $page -1;
} else {
  $pagePrec = 1;
}

// Calcul du No de la page suivante

// Calcule le nombre de pages maximum
$pageMax = intval((Article::count() / $pageSize) + 1);
// Si la page est indiquée, il suffit de passer à la suivante
if ($page < $pageMax) {
  $pageSuiv = $page +1;
} else {
  $pageSuiv = $pageMax;
}

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
$view->display("articles")
?>
