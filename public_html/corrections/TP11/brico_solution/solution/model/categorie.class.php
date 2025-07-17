<?php
require_once(__DIR__.'/dao.class.php');

// Définition d'une catégorie 
class Categorie {
  private int  $id;     // Identifiant
  private string  $nom; // nom de la catégorie
  private int  $pere;   // catégorie parente

  // Constructeur
  public function __construct(int $id=-1,string $nom='',int $pere=-1) {
    $this->id = $id;
    $this->nom = $nom;
    $this->pere = $pere;
  }

  // Getters
  public function getId() : int {
    // 
    return $this->id;
    // 
  }

  public function getNom() : string {
    // 
    return $this->nom;
    // 
  }

  public function getPere() : int {
    // 
    return $this->pere;
    // 
  }

  ////////////// Gestion de la persistance (méthodes CRUD) ////////////////


  ////////////// Partie READ /////////////////////////////////////////////

  // Acces à une catégorie
  // Retourne un objet de la classe Categorie connaissant son identifiant
  // $id : l'identifiant de la catégorie que l'on recherche
  public static function read(int $id): Categorie {
    // Acces au DAO
    $dao = DAO::get();
    // Prépare la requête SQL
    $query = $dao->prepare('SELECT * FROM categorie WHERE id = :id');
    // Exécute la requête SQL en lui passant les paramètres
    $query->execute([':id' => $id]);
    // Récupère le résultat
    $table = $query->fetchAll();
    // Il ne doit y avoir qu'un seul résultat dans la table
    if (count($table) == 0) {
      throw new Exception("Erreur:  Categorie $id non trouvée");
    }
    // Il ne peux pas y avoir plus d'une instance avec cet id
    if (count($table) > 1) {
      throw new Exception("Incohérence:  Categorie $id existe en ".count($table)." exemplaires");
    }
    // Les données de cette catégorie
    $row = $table[0];
    // Crée l'instance
    $categorie = new Categorie($row['id'],$row['nom'],$row['pere']);
    return $categorie;
  }


  // Donne la liste des sous-categories directes de la catégorie
  public function readSubCategorie(): array {
    // 
    // Idf de la catégorie père
    $id=$this->getId();
    // Acces au DAO
    $dao = DAO::get();
    // Prépare la requête SQL
    $query = $dao->prepare('SELECT * FROM categorie WHERE pere = :id');
    // Exécute la requête SQL en lui passant les paramètres
    $query->execute([':id' => $id]);
    // Récupère le résultat
    $table = $query->fetchAll();
    // Création de tous les objets Categorie
    $categories = [];
    foreach ($table as $row) {
      $categories[] = new Categorie($row['id'],$row['nom'],$row['pere']);
    }
    return $categories;
    // fin méthode readSubCategorie 
  }

}


?>
