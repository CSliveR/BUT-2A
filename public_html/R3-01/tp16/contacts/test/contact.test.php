<?php
// Test de la classe Article 
require_once(__DIR__ . '/../model/contact.class.php');
// Fonctions d'aide
require_once(__DIR__ . '/../test/helper.php');

// Test si deux contacts sont égaux sans l'id
function egalContact(Contact $c1, Contact $c2): bool
{
  return $c1->getPrenom() == $c2->getPrenom() && $c1->getNom() == $c2->getNom() && $c1->getMobile() == $c2->getMobile();
}

try {

  // Vérification de l'accès à un contact
  print("Lecture d'un contact : "); // 1|Melba|Varde|0607080910
  $nom = 'Varde';
  $values = Contact::read($nom);
  $expected = new Contact('Melba', 'Varde', 748097761);
  if (count($values) == 0) {
    print("Attendu : \n");
    var_dump($expected);
    throw new Exception("Contact non trouvé");
  }
  if (!egalContact($values[0], $expected)) {
    var_dump($values);
    print("Attendu : \n");
    var_dump($expected);
    throw new Exception("Erreur sur le contact trouvé");
  }
  OK();

  // Vérification que la tentative d'un contact inexistant retourne un tableau vide
  print("Tentative de lecture d'un contact inexistant : ");
  $values = Contact::read('CONTACT INEXISTANT');
  if (count($values) != 0) {
    var_dump($values);
    throw new Exception('Contact inexistant trouvé');
  }
  OK();

  // Recherche avec un motif sur le nom ou sur le prénom
  print("Recherche des contacts : ");
  $contacts = Contact::readlike('al');
  $value = count($contacts);
  $expected = 9;
  // ne vérifie que le nombre de contacts trouvés 
  if ($value != $expected) {
    var_dump($contacts);
    var_dump($value);
    print("Attendu : \n");
    var_dump($expected);
    throw new Exception("Le bon nombre de contacts n'a pas été trouvé");
  }
  OK();

  //  

} catch (Exception $e) {
  printCol("\nLe test produit l'erreur suivante :\n");
  print($e->getMessage() . ".\n");
  print('File: '.$e->getFile()."\n");
  print('Line: '.$e->getLine()."\n");
  print($e->getTraceAsString());
}



?>