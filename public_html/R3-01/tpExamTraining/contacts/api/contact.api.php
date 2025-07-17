<?php

// Besoin de la classe pour lancer les requêtes 
require_once(__DIR__ . "/../model/contact.class.php");

// Tableau qui contient la réponse
$out = [];
// Examine l'action demandée
$action = $_GET['action'] ?? '';

switch ($action) {
    // Suppressions des contacts sachant leur id
    case 'delete':
        // 
        ///////////////////////////////////////////////////////
        //  A COMPLETER
        ///////////////////////////////////////////////////////
        // 
        break;
    default:
        $out['error'] = 'incorrect action';
}

// Sort la réponse
// Change le code en cas d'erreur
if (isset($out['error'])) {
    http_response_code(400);
}
// Indique dans le header que l'on sort du JSON
header('Content-Type: application/json; charset=utf-8');
print(json_encode($out));
?>