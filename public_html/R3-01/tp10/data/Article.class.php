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

  // Construction d'un article
  function __construct(string $id,string $libelle,float $montant_HT) {
    $this->id = $id;
    $this->libelle = $libelle;
    $this->montant_HT = $montant_HT;
  }

  function getLibelle() : string {
    return $this->libelle;
  }

  function getMontant_HT() : float {
    return $this->montant_HT;
  }

  function getMontant_TTC() : float {
    return $this->montant_HT * (1+TVA/100);
  }

}
?>
