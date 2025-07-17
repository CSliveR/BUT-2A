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
  public function __construct(
    int $ref = -1,
    string $libelle = '',
    Categorie $categorie = NULL,
    float $prix = 0.0,
    string  $image = ''
  ) {
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
  public function getRef(): int
  {
    // 
    return $this->ref;
    // 
  }

  public function getLibelle(): string
  {
    // 
    return $this->libelle;
    // 
  }

  public function getCategorie(): Categorie
  {
    // 
    return $this->categorie;
    // 
  }

  public function getPrix(): float
  {
    // 
    return $this->prix;
    // 
  }

  public function getImage(): string
  {
    // 
    return $this->image;
    // 
  }

  // Retourne l'URL complete de l'image pour une utilisation dans la vue.
  public function getImageURL(): string
  {
    // 
    // Ajoute l'URL au nom du fichier image
    return self::URL . $this->image;
    // 
  }

  ////////////// Gestion de la persistance (méthodes CRUD) ////////////////

  // Retourne le nombre total d'articles dans la base
  // Est utilisé pour calculer le nombre de pages
  public static function count(): int
  {
    // 
    // Acces au DAO
    $dao = DAO::get();
    // Prépare le requête SQL
    $query = $dao->prepare('SELECT COUNT(*) FROM article');
    // Exécute la requête SQL
    $query->execute();
    // Récupère le résultat
    $table = $query->fetchAll();
    if (count($table) != 1) {
      throw new Exception("Erreur: nbArticle");
    }
    return $table[0][0];
    // fin méthode count 
  }

  ////////////// READ /////////////////////////////////////////////

  // Acces à un article connaissant sa référence
  // $ref : la référence de l'article
  public static function read(int $ref): Article
  {
    // 
    // Acces au DAO
    $dao = DAO::get();
    // Prépare la requête SQL
    $query = $dao->prepare('SELECT * FROM article WHERE ref = :ref');
    // Exécute la requête SQL en lui passant les paramètres
    $query->execute([':ref' => $ref]);
    // Récupère le résultat
    $table = $query->fetchAll();
    // Il ne doit y avoir qu'un seul résultat dans la table
    if (count($table) == 0) {
      throw new Exception("Erreur: Article $ref non trouvée");
    }
    // Il ne peux pas y avoir plus d'une instance avec cet id
    if (count($table) > 1) {
      throw new Exception("Incohérence: Article $ref existe en " . count($table) . " exemplaires");
    }
    // Récupération des données
    $row = $table[0];
    // Recupération de la catégorie qui doit être un objet
    $categorie = Categorie::read($row['categorie']);
    // Création de l'article
    $article = new Article($row['ref'], $row['libelle'], $categorie, $row['prix'], $row['image']);
    return $article;
    // fin méthode read 
  }

  // Récupère des articles étant donné un No de page
  // Les articles sont triés par No de référence
  // $page : le No de page qui débute à 1
  // $pageSize : le nombre de référence d'articles par pages
  public static function readPage(int $page, int $pageSize): array
  {
    // 
    // Calcul de l'offset
    $offset = ($page - 1) * $pageSize;
    // Acces au DAO
    $dao = DAO::get();
    // Prépare la requête SQL
    $query = $dao->prepare('SELECT * FROM article ORDER BY ref ASC LIMIT :pageSize OFFSET :offset');
    // Exécute la requête SQL en lui passant les paramètres
    $query->execute([':pageSize' => $pageSize, ':offset' => $offset ]);
    // Récupère le résultat
    $table = $query->fetchAll();
    $articles = array();
    // Création des Articles
    foreach ($table as $row) {
      // Recupération de la catégorie qui doit être un objet
      $categorie = Categorie::read($row['categorie']);
      // Ajoute un article à la liste
      $articles[] = new Article($row['ref'], $row['libelle'], $categorie, $row['prix'], $row['image']);
    }
    return $articles;
    // 
  }

  // Récupère des articles étant donné un No de page et une catégorie
  // Les articles sont triés par No de référence
  // $page : le No de page qui débute à 1
  // $pageSize : le nombre de référence d'articles par pages
  // $categorie : la categorie qui sert de filtre
  public static function readPageCategorie(int $page, int $pageSize, Categorie $categorie): array
  {
    // 
    // Calcul de l'offset
    $offset = ($page - 1) * $pageSize;
    // Le idf de la categorie
    $idCat = $categorie->getId();
    // Acces au DAO
    $dao = DAO::get();
    // Peux s'écrire en ne récupérant que l'identifiant puis en utilisant le read, ou en une seule requête
    // Prépare la requête SQL
    $query = $dao->prepare('SELECT * FROM article WHERE categorie=:idCat ORDER BY ref ASC LIMIT :pageSize OFFSET :offset');
    // Exécute la requête SQL en lui passant les paramètres
    $query->execute([':idCat' => $idCat, ':pageSize' => $pageSize, ':offset' => $offset ]);
    // Récupère le résultat
    $table = $query->fetchAll();
    $articles = array();
    // Création des Articles
    foreach ($table as $row) {
      // Recupération de la catégorie qui doit être un objet
      $categorie = Categorie::read($row['categorie']);
      // Ajoute un article à la liste
      $articles[] = new Article($row['ref'], $row['libelle'], $categorie, $row['prix'], $row['image']);
    }
    return $articles;
    // 
  }
}
