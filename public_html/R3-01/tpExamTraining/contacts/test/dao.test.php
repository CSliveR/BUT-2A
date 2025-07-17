<?php
// Test de la classe DAO
require_once(__DIR__ . '/../model/dao.class.php');
// Fonctions d'aide
require_once(__DIR__ . '/../test/helper.php');

try {
  print("Création d'un objet DAO : ");
  $dao = DAO::get();
  OK();

  print("Test d'une lecture par query : ");
  $query = "SELECT * FROM contact WHERE id=?";
  $id = 1;
  $data = [$id];
  $value = $dao->query($query, $data);
  $expected = array(
    array(
      "id" => 1,
      0 => 1,
      "nom" => "Rouana",
      1 => "Rouana",
      "prenom" => "Marie",
      2 => "Marie",
      "mobile" => 765468937,
      3 => 765468937
    )
  );
  if ($value != $expected) {
    printCol("\nTrouvé : \n");
    var_dump($value);
    printCol("Attendu : \n");
    var_dump($expected);
    throw new Exception("Contact No $id non trouvé");
  }
  OK();

  print("Test d'insertion ");
  $query = "INSERT INTO contact (prenom,nom,mobile) VALUES (?,?,?)";
  $data = ['Aretha', 'Connery', 655667788];
  $dao->exec($query, $data);
  // Récupère le nouvel Id
  $id = $dao->lastInsertId();
  print('(id=' . $id . ') : ');
  OK();

  print("Vérification de l'insertion : ");
  $query = "SELECT id,nom FROM contact WHERE prenom=?";
  $nom = 'Aretha';
  $data = [$nom];
  $value = $dao->query($query, $data);
  $expected = 'Connery';
  if ($value[0]['nom'] != $expected) {
    var_dump($value);
    print("Attendu : \n");
    var_dump($expected);
    throw new Exception("Contact de nom '$nom' non trouvé");
  }
  OK();

  print("Test de suppression : ");
  $query = "DELETE FROM contact WHERE id=?";
  $id = $value[0]['id'];
  $data = [$id];
  $dao->exec($query, $data);
  OK();

} catch (Exception $e) {
  printCol("\nErreur sur DAO : " . $e->getMessage() . "\n");
}


?>