<?php

// Classe chargée de réaliser un change entre deux monnaies
Class Change {
  // Liste des taux indexés par deux IDF de taux séparé par un espace
  private array $rates = array();
  // Liste des IDF des devises
  // Est utile pour afficher les devises que l'on peut choisir
  private array $devises = array();

  // Constructeur
  function __construct(string $filename) {
    // Lecture des taux
    $this->load($filename);
  }

  // Charge la liste des Taux et des idf de devises
  private function load(string $filename) {
    $file = fopen($filename, 'r');
    fgets($file); //ignorer la ligne d'en-tête
    // $line = fgets($file);
    // Lire chaque ligne du fichier jusqu'à la fin
    while (($line = fgetcsv($file)) !== false) {
      // La ligne contient les valeurs séparées par des virgules : from, to, rate
      list($from, $to, $rate) = $line;

      // Stocker le taux dans le tableau associatif $rates
      $this->rates["$from $to"] = $rate;

      // Ajouter les devises dans $devises si elles n'existent pas déjà
      if (!in_array($from, $this->devises)) {
          $this->devises[] = $from;
      }
      if (!in_array($to, $this->devises)) {
          $this->devises[] = $to;
      }
    }
    fclose($file); 
  }

  // Calcul du taux entre deux IDF de devises
  function getRate(string $from,string $to) : float {
    if(in_array("$from $to", array_keys($this->rates))){
      return $this->rates["$from $to"];
    }else if(in_array("$to $from", array_keys($this->rates))){
      return 1/$this->rates["$to $from"];
    }else if($from == $to){
      return 1;
    }else{
      throw new Exception("Taux inexistants : " . $from . " -> " . $to);
    }
  }

  // Retourne toutes les devises disponibles dans un tableau de strings
  function getDevises() : array {
    return $this->devises;
  }

  // Calcul une conversion
  // Arrondit à 2 après la virgule
  function change(string $from, string $to,float $amount) : float {
    return round($this->getRate($from, $to) *$amount, 2);
  }
}

?>
