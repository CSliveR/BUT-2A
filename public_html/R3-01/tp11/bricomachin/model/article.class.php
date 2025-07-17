<?php
require_once(__DIR__ . '/dao.class.php');
require_once(__DIR__ . '/categorie.class.php');

// Un article en vente 
class Article
{
  private int     $ref;         // Référence unique
  private string  $libelle;     // Nom de l'article
  private Categorie  $categorie; // La catégorie de cet attribut
  private float   $prix;        // Le prix
  private string  $image;       // Nom du fichier image
  // URL absolue pour les images
  private const URL = 'https://www-info.iut2.univ-grenoble-alpes.fr/intranet/enseignements/ProgWeb/data/bricomachin/img/';

  // Constructeur
  public function __construct(int $ref = -1, string $libelle = '', Categorie $categorie = NULL, float $prix = 0.0, string $image = '') {
    $this->ref = $ref;
    $this->libelle = $libelle;
    // On ne peux pas affecter NULL à un attribut de type Categorie
    if ($categorie === NULL) {
      $this->categorie = new Categorie();
    } else {
      $this->categorie = $categorie;
    }
    $this->prix = $prix;
    $this->image = $image;
  }

  // Getters
  public function getRef(): int{
    //  A COMPLETER
    return $this->ref;

  }

  public function getLibelle(): string{
    //  A COMPLETER
    return $this->libelle;
  }

  public function getCategorie(): Categorie{
    //  A COMPLETER
    return $this->categorie;
  }

  public function getPrix(): float{
    //  A COMPLETER
    return $this->prix;
  }

  public function getImage(): string{
    //  A COMPLETER
    return $this->image;
  }

  // Retourne l'URL complete de l'image pour une utilisation dans la vue.
  public function getImageURL(): string{
    //  A COMPLETER
    return self::URL . $this->getImage();
  }

  ////////////// Gestion de la persistance (méthodes CRUD) ////////////////

  // Retourne le nombre total d'articles dans la base
  // Est utilisé pour calculer le nombre de pages
  public static function count(): int{
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    // Acces au DAO
    $dao = DAO::get();
    // Prépare la requête SQL
    $query = $dao->prepare('SELECT count(*) FROM article');
    // Exécute la requête SQL en lui passant les paramètres
    $query->execute();
    
    $nbArticles = $query->fetchColumn();
    return $nbArticles;
  }

  ////////////// READ /////////////////////////////////////////////

  // Acces à un article connaissant sa référence
  // $ref : la référence de l'article
  public static function read(int $ref): Article{
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    // Acces au DAO
    $dao = DAO::get();
    // Prépare la requête SQL
    $query = $dao->prepare('SELECT * FROM article WHERE ref = :ref');
    // Exécute la requête SQL en lui passant les paramètres
    $query->execute([':ref' => $ref]);
    //Récupère la ligne complète d'un article de référence ref passée en paramètre avec toutes ses colonnes.
    //fetch(PDO::FETCH_ASSOC) => tableau associatif où chaque clé correspond au nom d'une colonne.
    $article = $query->fetch(PDO::FETCH_ASSOC);

    if ($article === 0) {
      throw new Exception("Erreur: Article $ref non trouvé");
    }

    // Crée l'instance
    $categorie = Categorie::read($article['categorie']);
    $article = new Article($article['ref'],$article['libelle'],$categorie,$article['prix'],$article['image']);
    return $article;
  }

  // Récupère des articles étant donné un No de page
  // Les articles sont triés par No de référence
  // $page : le No de page qui débute à 1
  // $pageSize : le nombre de référence d'articles par pages
  public static function readPage(int $page, int $pageSize): array{
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    $listArticles = array();
    // Acces au DAO
    $dao = DAO::get();
    $offset = ($page -1)* $pageSize;
    // Prépare la requête SQL
    $query = $dao->prepare('SELECT * FROM article ORDER BY ref LIMIT :pageSize OFFSET :offset');
    // Exécute la requête SQL en lui passant les paramètres
    $query->bindValue(':pageSize', $pageSize, PDO::PARAM_INT);
    $query->bindValue(':offset', $offset, PDO::PARAM_INT);
    $query->execute();
    // Récupère le résultat
    $articles = $query->fetchAll();

    foreach($articles as $article){
      $categorie = Categorie::read($article['categorie']);
      $listArticles[] = new Article($article['ref'],$article['libelle'],$categorie,$article['prix'],$article['image']);
    }
    return $listArticles;
  }

  // Récupère des articles étant donné un No de page et une catégorie
  // Les articles sont triés par No de référence
  // $page : le No de page qui débute à 1
  // $pageSize : le nombre de référence d'articles par pages
  // $categorie : la categorie qui sert de filtre
  public static function readPageCategorie(int $page, int $pageSize, Categorie $categorie): array{
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    $listArticlesCat = array();
    // Acces au DAO
    $dao = DAO::get();
    $offset = ($page - 1) * $pageSize;
    // Prépare la requête SQL
    $query = $dao->prepare('SELECT * FROM article WHERE categorie = :categorie ORDER BY ref LIMIT :pageSize OFFSET :offset');
    // Exécute la requête SQL en lui passant les paramètres
    $query->bindValue(':categorie', $categorie->getId(), PDO::PARAM_INT);
    $query->bindValue(':pageSize', $pageSize, PDO::PARAM_INT);
    $query->bindValue(':offset', $offset, PDO::PARAM_INT);
    $query->execute();
    //Récupère le résultat
    $articlesCat= $query->fetchAll();

    foreach($articlesCat as $articleCat){
      $listArticlesCat[] = new Article($articleCat['ref'],$articleCat['libelle'],$categorie,$articleCat['prix'],$articleCat['image']);
    }

    return $listArticlesCat;
  }
}
