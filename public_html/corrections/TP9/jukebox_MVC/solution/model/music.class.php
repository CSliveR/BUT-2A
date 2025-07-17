<?php
require_once(__DIR__ . "/dao.class.php");

// Description d'une musique
class Music
{
  private int $id;
  private string $author;
  private string $title;
  private string $cover;
  private string $mp3;
  private string $category;
  // Chemin URL à ajouter pour avoir l'URL du MP3 et du COVER
  private const URL = 'http://www-info.iut2.upmf-grenoble.fr/intranet/enseignements/ProgWeb/data/musiques/';

  function __construct(int $id, string $author, string $title, string $cover, string $mp3, string $category)
  {
    $this->id = $id;
    $this->author = $author;
    $this->title = $title;
    $this->cover = $cover;
    $this->mp3 = $mp3;
    $this->category = $category;
  }

  // Solution avec tous les getters explicites
  function getId()
  {
    return $this->id;
  }

  function getAuthor()
  {
    return $this->author;
  }

  function getTitle()
  {
    return $this->title;
  }

  function getCover()
  {
    return self::URL . 'img/' . $this->cover;
  }

  function getMp3()
  {
    return self::URL . 'mp3/' . $this->mp3;
  }

  function getCategory()
  {
    return $this->category;
  }

  ////////////// READ /////////////////////////////////////////////

  // Acces à une musique connaissant sa référence
  // $id : l'identifiant de la musique
  public static function read(int $id): Music
  {
    // Ouverture le la BD par création d'un DAO
    $dao = new DAO();
    // Prépare la requête
    $query = $dao->prepare('SELECT * FROM music WHERE id = :id');
    // Lance la requête
    $query->execute([':id' => $id]);
    $resultat = $query->fetchAll();
    // Il ne doit y avoir qu'un seul résultat dans la table
    if (count($resultat) == 0) {
      throw new Exception("Erreur: musique $id non trouvée");
    }
    // Il ne peux pas y avoir plus d'une instance avec cet id
    if (count($resultat) > 1) {
      throw new Exception("Incohérence: musique $id existe en " . count($table) . " exemplaires");
    }
    // Récupère l'unique donnée
    $d = $resultat[0];
    // Création de l'objet
    $music = new Music($d['id'], $d['author'], $d['title'], $d['cover'], $d['mp3'], $d['category']);
    return $music;
    // fin méthode read 
  }

  // Max Id
  public static function maxId() : int{
    return 554;
  }
}
