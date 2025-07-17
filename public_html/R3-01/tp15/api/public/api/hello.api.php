<?php
// API de type REST qui envoit une salutation à la personne 
// 
///////////////////////////////////////////////////////
// A COMPLETER
///////////////////////////////////////////////////////

header("Content-type: text/plain; charset=utf-8");

$nom = isset($_GET['nom']) ? $_GET['nom'] : "bel inconnu";
print("Hello $nom ! ");

// 
?>