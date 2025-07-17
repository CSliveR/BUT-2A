<?php

// Une heure dans le monde 
class Time implements JsonSerializable
{
  
  private DateTime $dateTime; // L'objet PHP qui représente le temps
  private string $timeZone; // Un fuseau horaire

  // Constructeur
  public function __construct(string $timeZone = 'Europe/Paris'){
    // A COMPLETER
    $this->timeZone = $timeZone;
    $this->dateTime = new DateTime();
    $this->dateTime->setTimeZone(new DateTimeZone($timeZone));
  }

  // Transforme la date en une chaine
  public function dateToString() : string{
  // A COMPLETER
    return $this->dateTime->format('Y-m-d H:i:s');
  }

  // Informations à produire quand l'objet est tranformé en JSON
  public function jsonSerialize(): mixed
  {
    return array(
      "timeZone" => $this->timeZone,
      "date" => $this->dateToString()
    );
  }

}
?>