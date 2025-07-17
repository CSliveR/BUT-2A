<?php
// Taux atuel de la TVA mis comme une constante
const TVA = 20.0;

// Définition d'un article
class Article {
  // Identifiant unique de l'article
  private $id;
  // Description
  private $libelle;
  // Montant sans la taxe
  private $montant_HT;
  // Quantité de l'article
  private $quantite;

  // Construction d'un article
  function __construct(string $id,string $libelle,float $montant_HT,int $quantite = 1) {
    $this->id = $id;
    $this->libelle = $libelle;
    $this->montant_HT = $montant_HT;
    $this->quantite = ($quantite > 0) ? $quantite : 1;
  }

  function __get(string $property) {
    if ($property === "montant_TTC") {
      return $this->quantite * $this->montant_HT * (1+TVA/100);
    } else if (isset($this->$property) && ($property != 'id')) {
      return $this->$property;
    } else if($property === "quantite"){
      return $this->quantite;
    }else {
      throw new Exception("reading property '$property' is not allowed");
    }
  }

  public function __set(string $property, $value) : void{
    if($property === "quantite" && $value > 0){
      $this->quantite = $value;
    }else{
      $this->quantite = 1;
    }
  }
}
 ?>
