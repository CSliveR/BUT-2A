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
  public function __construct(string $nom = '', string $prenom = '', int $mobile = 0)
  {
    $this->id = -1; // Indique que cet objet n'est pas (encore) dans la BD
    $this->nom = $nom;
    $this->prenom = $prenom;
    $this->mobile = $mobile;
  }

  public function jsonSerialize(): mixed
  {
    return get_object_vars($this);
  }

  // Getters
  public function getId(): int
  { return $this->id; }

  public function getNom(): string
  { return $this->nom; }

  public function getPrenom(): string
  { return $this->prenom; }

  public function getMobile(): int
  { return $this->mobile; }


  // Setter
  // NB: on n'a pas le droit de changer l'id car sinon cela devient un autre contact ou la BD devient incohérente

  public function setNom(string $nom)
  {
    $this->nom = $nom;
  }

  public function setPrenom(string $prenom)
  {
    $this->prenom = $prenom;
  }

  public function setMobile(int $mobile)
  {
    $this->mobile = $mobile;
  }

  //////////////////////////////////////////////////////////////////////////////
  // Gestion de la persistance, Acces CRUD
  // CRUD = Create Read Update Delete
  //////////////////////////////////////////////////////////////////////////////


  /////////////////////////// CREATE /////////////////////////////////////


  // Création d'un nouveau contact dans la base de données
  // ATTENTION : il ne faut pas explicitement gérer les identifiants, 
  // mais laisser faire la BD 
  public function create() : void
  {
    // Cet objet ne doit pas être déjà dans la base donc son id doit être -1
    if ($this->id !== -1) {
      throw new Exception("Create impossible : déjà dans la base avec cet id=" . $this->id);
    }
    // 
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    // 
  }

  /////////////////////////// READ /////////////////////////////////////


  // Acces à un Contact connaissant son id
  // Lève une exception si non trouvé
  public static function read(int $id): Contact
  {
    // 
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    // 
  }

  // Recherche d'une liste de contacts dont le nom ou le prénom débute par $pattern
  public static function readFromLike(string $pattern): array
  {
    // 
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    // 
  }

  /////////////////////////// UPDATE /////////////////////////////////////

  // Mise à jour d'un contact
  // Important : le contact doit déjà être dans la base donc avoir un id différent de -1
  public function update(): void
  {
    if ($this->id === -1) {
      throw new Exception("Update impossible : ce contact n'est pas dans la base");
    }
    // 
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    // 
  }

  /////////////////////////// DELETE /////////////////////////////////////

  // Suppression d'un article
  public function delete(): void
  {
    if ($this->id === -1) {
      throw new Exception("Delete impossible : ce contact n'est pas dans la base");
    }
    // 
    ///////////////////////////////////////////////////////
    //  A COMPLETER
    ///////////////////////////////////////////////////////
    // 
  }
}
?>