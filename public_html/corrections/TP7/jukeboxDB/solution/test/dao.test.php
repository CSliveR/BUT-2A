<?php
require_once(__DIR__.'/../model/dao.class.php');

const URL='http://www-info.iut2.upmf-grenoble.fr/intranet/enseignements/ProgWeb/data/musiques/';

// Creation de l'instance DAO
$dao = new DAO();

// Prépare une requête pour savoir combien il y a de musiques dans la BD
$query = $dao->prepare('SELECT count(*) FROM music');
// Lance la requête
$query->execute();
// Récupère le résultat
$resultat = $query->fetchall();
//var_dump($resultat);

$value = $resultat[0]['count(*)'];
$expected = 554;
assert($value == $expected, "'$value'.\n Valeur attendue : '$expected'");

echo "OK : la classe 'DAO' a passé les tests\n";


 ?>
