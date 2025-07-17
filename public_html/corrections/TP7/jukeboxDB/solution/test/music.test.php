<?php
require_once(__DIR__ . '/../model/music.class.php');
$class = 'Music';
function assert_failure($file, $line, $assertion, $message)
{
  global $class;
  echo "*** La classe '$class' n'est pas correcte.\n*** L'assertion à la ligne $line a échoué pour $assertion $message\n";
}

const URL = 'http://www-info.iut2.upmf-grenoble.fr/intranet/enseignements/ProgWeb/data/musiques/';

$music = new $class(1, 'Passenger', 'Community Centre', '1.jpg', '1.mp3', 'Acoustic');

// Test l'acces avec un getteur
$value = $music->getId();
$expected = 1;
assert($value == $expected, "'$value'.\n Valeur attendue : '$expected'");
$value = $music->getAuthor();
$expected = 'Passenger';
assert($value == $expected, "'$value'.\n Valeur attendue : '$expected'");
$value = $music->getTitle();
$expected = 'Community Centre';
assert($value == $expected, "'$value'.\n Valeur attendue : '$expected'");
$value = $music->getCover();
$expected = URL . 'img/1.jpg';
assert($value == $expected, "'$value'.\n Valeur attendue : '$expected'");
$value = $music->getMp3();
$expected = URL . 'mp3/1.mp3';
assert($value == $expected, "'$value'.\n Valeur attendue : '$expected'");
$value = $music->getCategory();
$expected = 'Acoustic';
assert($value == $expected, "'$value'.\n Valeur attendue : '$expected'");


// Lecture de la première musique
$music = Music::read(1);
// Test l'acces avec un getteur
$value = $music->getId();
$expected = 1;
assert($value === $expected, "'$value'.\n Valeur attendue : '$expected'");
$value = $music->getAuthor();
$expected = 'Passenger';
assert($value === $expected, "'$value'.\n Valeur attendue : '$expected'");
$value = $music->getTitle();
$expected = 'Community Centre';
assert($value === $expected, "'$value'.\n Valeur attendue : '$expected'");
$value = $music->getCover();
$expected = URL . 'img/1.jpg';
assert($value === $expected, "'$value'.\n Valeur attendue : '$expected'");
$value = $music->getMp3();
$expected = URL . 'mp3/1.mp3';
assert($value === $expected, "'$value'.\n Valeur attendue : '$expected'");
$value = $music->getCategory();
$expected = 'Acoustic';
assert($value === $expected, "'$value'.\n Valeur attendue : '$expected'");

$music = Music::read(554);
// Test l'acces avec un getteur
$value = $music->getId();
$expected = 554;
assert($value == $expected, "'$value'.\n Valeur attendue : '$expected'");
$value = $music->getAuthor();
$expected = 'Scambo';
assert($value == $expected, "'$value'.\n Valeur attendue : '$expected'");
$value = $music->getTitle();
$expected = 'Mundo Branco';
assert($value == $expected, "'$value'.\n Valeur attendue : '$expected'");
$value = $music->getCover();
$expected = URL . 'img/default_album_medium.png';
assert($value == $expected, "'$value'.\n Valeur attendue : '$expected'");
$value = $music->getMp3();
$expected = URL . 'mp3/554.mp3';
assert($value == $expected, "'$value'.\n Valeur attendue : '$expected'");
$value = $music->getCategory();
$expected = '90s';
assert($value == $expected, "'$value'.\n Valeur attendue : '$expected'");

echo "OK : la classe '$class' a passé les tests\n";
