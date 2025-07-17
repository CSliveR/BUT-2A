<?php
require_once(__DIR__ . '/dao.class.php');

// Un contact 
class Contact implements JsonSerializable
{
  private int $id; // Identifiant unique. ATTENTION: à laisser gérer par la BD
  private string $nom; // Nom du contact
  private string $prenom; // Prénom du contact
  private int $mobile; // No de téléphone mobile

  // Constructeur
  public function __construct(string $prenom = '', string $nom = '', int $mobile = 0)
  {
    $this->id = -1; // Indique que cet objet n'est pas (encore) dans la BD
    $this->prenom = $prenom;
    $this->nom = $nom;
    $this->mobile = $mobile;
  }


  public function jsonSerialize(): mixed
  { // 
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    // 
  }

  // Getters
  public function getId(): int
  {
    return $this->id;
  }

  public function getNom(): string
  {
    return $this->nom;
  }

  public function getPrenom(): string
  {
    return $this->prenom;
  }

  public function getMobile(): int
  {
    return $this->mobile;
  }



  //]])////////////////////////////////////////////////////////////////////////////
  // Gestion de la persistance, Acces CRUD
  // CRUD = Create Read Update Delete
  //////////////////////////////////////////////////////////////////////////////

  /////////////////////////// READ /////////////////////////////////////

  // Acces à un Contact connaissant son nom, il peux y en avoir plusieurs, ou aucun
  // Si le contact n'est pas trouvé, le tableau en retour est vide
  public static function read(string $nom): array
  {
    // Acces au DAO
    $dao = DAO::get();
    $query = $dao->prepare('SELECT * FROM contact WHERE nom = :nom');
    var_dump($query);
    $query->execute([':nom' => $nom]);
    // Récupère le résultat
    $table = $query->fetchAll();
    var_dump($table);
    // Récupération des données dans un array
    $contacts = [];
    foreach ($table as $row) {
      $contact = new Contact($row['prenom'], $row['nom'], $row['mobile']);
      // Ajoute l'id, car il n'est pas dans le constructeur
      $contact->id = $row['id'];
      // Ajoute le nouvel objets à la liste
      $contacts[] = $contact;
    }
    return $contacts;
    // fin méthode read 
  }

  // Recherche des contact sachant le début d'un nom ou d'un prénom 
  // $pattern : séquence de lettres d'un début de nom ou prénom
  public static function readLike(string $pattern): array
  {
    // 
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    // 
  }
}
