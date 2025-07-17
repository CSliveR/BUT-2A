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
  print("Lecture d'un contact : "); // 25|Lazare|Garcin|749589930
  $id = 25;
  $contact = Contact::read($id);
  $expected = new Contact('Lazare', 'Garcin', 749589930);
  if (!egalContact($contact, $expected)) {
    throw new Exception("Erreur sur le contact trouvé");
  }
  OK();
} catch (Exception $e) {
  FAILED();
  printCol("Le test produit l'erreur suivante :\n");
  print($e->getMessage() . "\n");
  printCol("Trouvé : \n");
  var_dump($contact);
  printCol("Attendu : \n");
  var_dump($expected);

}

// Vérification que la tentative d'un contact inexistant retourne un tableau vide
print("Tentative de lecture d'un contact inexistant : ");
try {
  $contact = Contact::read(1000);
  FAILED();
  printCol("Trouvé : \n");
  var_dump($contact);
  printCol('Contact inexistant trouvé');
} catch (Exception $e) {
  OK();
}

// Vérification de create
print("Création d'un contact : ");
try {
  $value = new Contact('Neymar', 'Jean', 699887766);
  $value->create();
  // Vérifie que le contact existe
  $expected = Contact::read($value->getId());
  if ($value != $expected) {
    throw new Exception("Contact non inséré dans la base");
  }
  OK();
} catch (Exception $e) {
  FAILED();
  printCol("Le test produit l'erreur suivante :\n");
  print($e->getMessage() . "\n");
  printCol("Crée: \n");
  var_dump($value);
  printCol("Attendu : \n");
  var_dump($expected);

}



// Vérification de la modification d'un contact
print("Mise à jour d'un contact : ");
try {
  $expected = Contact::read(33);
  // Conserve le No de téléphone
  $mobile = $expected->getMobile();
  // Modification du telephone
  $expected->setMobile(5566778899);
  // Mise à jour
  $expected->update();
  $value = Contact::read(33);
  if ($value != $expected) {
    throw new Exception("Contact n'a pas été modifié");
  }
  // Remet la valeur originale
  $expected->setMobile($mobile);
  $expected->update();
  // Test à nouveau
  $value = Contact::read(33);
  if ($value != $expected) {
    throw new Exception("Contact n'a pas été remis à la valeur initiale");
  }
  OK();
} catch (Exception $e) {
  FAILED();
  printCol("Le test produit l'erreur suivante :\n");
  print($e->getMessage() . "\n");
  printCol("Modifié: \n");
  var_dump($value);
  printCol("Attendu : \n");
  var_dump($expected);

}


// Recherche avec un motif sur le nom ou sur le prénom
print("Recherche des contacts avec un motif : ");
try {
  $contacts = Contact::readFromLike('Ver');
  $value = count($contacts);
  $expected = 2;
  // ne vérifie que le nombre de contacts trouvés 
  if ($value != $expected) {
    throw new Exception("Le bon nombre de contacts n'a pas été trouvé");
  }
  OK();
} catch (Exception $e) {
  FAILED();
  printCol("Le test produit l'erreur suivante :\n");
  print($e->getMessage() . "\n");
  printCol("Obtenu: \n");
  var_dump($value);
  printCol("Attendu : \n");
  var_dump($expected);
}


// Vérification de la destruction 
print("Suppression d'un contact : ");
try {
  // Recherche un contact
  $pattern = 'Verse';
  $contacts = Contact::readFromLike('Verse');
  // Vérifie qu'on l'a trouvé
  if (count($contacts) == 0) {
    throw new Exception("Contact non trouvé : '$pattern'");
  }
  // prend le premier contact de la liste s'il y en a plusieurs
  $contact= $contacts[0];
  // Conserve l'id
  $id = $contact->getId();
  // Supprime le contact
  $contact->delete();
  // Vérifie que l'id de l'objet est passé à -1 pour signifier que le contact n'est plus dans la base
  if ($contact->getId() != -1) {
    throw new Exception("L'identifiant du contact n'a pas été mis à -1 après sa suppression de la base");
  }
  // Verification qu'il n'y a plus ce contact dans la base
  try {
    $value = contact::read($id);
    // Doit générer une exception sinon c'est une erreur
    FAILED();
    printCol("Le test produit l'erreur suivante :\n");
    print("Le contact n'a pas été suprimé de la base.\n");
    printCol("Contact initial: \n");
    var_dump($contact);
    printCol("Contact retrouvé dans la base : \n");
    var_dump($$value);
  } catch (Exception $e) {
    // Sauvegarde à nouveau l'objet dans la BD
    $contact->create();
    OK();
  }
} catch (Exception $e) {
  FAILED();
  printCol("Le test produit l'erreur suivante :\n");
  print($e->getMessage() . "\n");
}




?>