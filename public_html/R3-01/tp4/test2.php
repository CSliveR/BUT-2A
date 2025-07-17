<?php 

function bonjour() {
    if (isset($nom)) {
      echo "Bonjour $nom</br>";
    } else {
    echo "Mais qui êtes vous ?</br>";
    }
}

function hello() {
    global $nom;
    if (isset($nom)) {
      echo "Hello $nom</br>";
    } else {
      echo "Mais qui êtes vous ?</br>";
    }
}

function salut() {
    static $nom;
    if (isset($nom)) {
      echo "Salut $nom</br>";
    } else {
      echo "Mais qui êtes vous ?</br>";
    }
    $nom = "Cyprien";
}

bonjour(); //Mais qui êtes vous ?
$nom="Arthur";
bonjour(); //Mais qui êtes vous ?

hello(); //Hello Arthur
$nom="Marcel";
hello(); //Hello Marcel

salut(); //Mais qui êtes vous ?
$nom="Mohamed";
salut(); //Salut Cyprien

/*
Dans la 1ère fonction, la portée de la variable est limitée à la fonction. La variable $nom reste vide (not set)
Dans la 2ème fonction, la portée de la variable est globale et donc sa portée s'étend à tout le programme (C'est pour ça que le nom )
Dans la 3ème fonction, 
*/


?>
