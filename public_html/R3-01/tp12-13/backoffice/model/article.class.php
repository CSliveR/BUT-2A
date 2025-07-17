<?php
require_once(__DIR__ . '/dao.class.php');
require_once(__DIR__ . '/categorie.class.php');

// Un article en vente 
class Article {
  private int     $ref;         // Référence unique
  private string  $libelle;     // Nom de l'article
  private Categorie  $categorie; // La catégorie de cet attribut
  private float   $prix;        // Le prix
  private string  $image;       // Nom du fichier image
  // URL absolue pour les images
  const distantURL =  'https://www-info.iut2.univ-grenoble-alpes.fr/intranet/enseignements/ProgWeb/data/bricomachin/img/';
  const localURL = "public/img/";

  // Constructeur
  public function __construct(int $ref = -1, string $libelle = '', Categorie $categorie = NULL, float $prix = 0.0, string $image = '') {
    if ($ref === 0) {
      throw new Exception("Erreur: La référence doit être non nulle");
    }
    $this->ref = $ref;
    $this->setLibelle($libelle);    
    // On ne peux pas affecter NULL à un attribut de type Categorie
    if ($categorie === NULL) {
      $this->categorie = new Categorie();
    } else {
      $this->setCategorie($categorie);
    }  
    $this->setPrix($prix);
    $this->setImage($image);
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

  public function getCategorieNom(): string{
    //  A COMPLETER
    return $this->categorie->getNom();
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
    return ($this->image[0] === '/') ? self::localURL.$this->image : self::distantURL.$this->image;
  }

  // Setter
  // NB: on n'a pas le droit de changer la référence car cela devient un autre objet

  ///////////////////////////////////////////////////////
  //  A COMPLETER
  ///////////////////////////////////////////////////////

  public function setLibelle(string $libelle){
    if($libelle === ""){
      throw new Exception("Le libelle doit être non vide");
    }
    $this->libelle = $libelle;
  }

  public function setCategorie(Categorie $categorie){
    $this->categorie = $categorie;
  }

  public function setPrix(float $prix){
    if($prix === 0.0){
      throw new Exception("le prix doit être non nul");
    }
    $this->prix = $prix;
  }

  public function setImage(string $image){
    if($image === ""){
      throw new Exception("Il faut indiquer le nom du fichier");
    }
    $this->image = $image;
  }
  // ////////////////////////////////////////////////////////////////////////////
  // Gestion de la persistance, Acces CRUD
  // CRUD = Create Read Update Delete
  //////////////////////////////////////////////////////////////////////////////

  // Retourne le nombre total d'articles dans la base
  // Est utilisé pour calculer le nombre de pages
  public static function count(): int {
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    $dao = DAO::get();
    $query = $dao->prepare('SELECT count(*) FROM article');
    $query->execute();
    
    $nbArticles = $query->fetchColumn();
    return $nbArticles;
  }

  /////////////////////////// CREATE /////////////////////////////////////

  // Création d'un nouvel article dans la base de données
  // Si le résultat de excec sur la base de donnée ne retourne pas 1
  // alors lève une exception pour signaler que l'insertion a échoué
  public function create(){
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    $dao = DAO::get();

    $query = $dao->prepare('SELECT count(*) FROM article WHERE ref = :ref');
    $query->execute([':ref'=> $this->ref]);
    if($query->fetchColumn() > 0){
      throw new Exception("Un article avec la référence {$this->ref} existe déjà.");
    }

    $query = $dao->prepare('INSERT INTO article(ref, libelle, categorie, prix, image) VALUES (:ref, :libelle, :categorie, :prix, :image)');
    $query->bindValue(":ref", $this->ref, PDO::PARAM_INT);
    $query->bindValue(":libelle", $this->libelle, PDO::PARAM_STR);
    $query->bindValue(":categorie", $this->categorie->getId(), PDO::PARAM_INT);
    $query->bindValue(":prix", $this->prix, PDO::PARAM_INT);
    $query->bindValue(":image", $this->image, PDO::PARAM_STR);
    $resQuery = $query->execute();
    if (!$resQuery || $query->rowCount() != 1) {
      throw new Exception("l'insertion a échoué");
    }
  }

  /////////////////////////// READ /////////////////////////////////////

  // Acces à un article connaissant sa référence
  // $ref : la référence de l'article
  public static function read(int $ref): Article{    
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    $dao = DAO::get();
    $query = $dao->prepare('SELECT * FROM article WHERE ref = :ref');
    $query->bindValue(':ref', $ref, PDO::PARAM_INT);
    $query->execute();
    $article = $query->fetch(PDO::FETCH_ASSOC);

    if (!$article) {
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
    $dao = DAO::get();
    $offset = ($page -1) * $pageSize;
    $query = $dao->prepare('SELECT * FROM article ORDER BY ref LIMIT :pageSize OFFSET :offset');
    $query->execute([':pageSize' => $pageSize,':offset' => $offset]);
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
    $dao = DAO::get();
    $offset = ($page - 1) * $pageSize;
    $query = $dao->prepare('SELECT * FROM article WHERE categorie = :categorie ORDER BY ref LIMIT :pageSize OFFSET :offset');
    $query->execute([':categorie' => $categorie->getId(),':pageSize' => $pageSize,':offset' => $offset]);
    $articlesCat= $query->fetchAll();

    foreach($articlesCat as $articleCat){
      $listArticlesCat[] = new Article($articleCat['ref'],$articleCat['libelle'],$categorie,$articleCat['prix'],$articleCat['image']);
    }

    return $listArticlesCat;
  }

  /////////////////////////// UPDATE /////////////////////////////////////

  // Mise à jour d'un article
  public function update(){
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    $dao = DAO::get();
    $query = $dao->prepare('UPDATE article SET libelle = :libelle, categorie = :categorie, prix = :prix, image = :image');
    $query->execute([':libelle' => $this->libelle,':categorie' => $this->categorie->getId(),':prix' => $this->prix,':image' => $this->image]);
  }

  /////////////////////////// DELETE /////////////////////////////////////

  // Suppression d'un article
  public function delete(){
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    //////////////////////////////////////////////////////

    $dao = DAO::get();
    $query = $dao->prepare('DELETE FROM article WHERE ref = :ref');
    $query->execute([':ref' => $this->ref]);
  }
}