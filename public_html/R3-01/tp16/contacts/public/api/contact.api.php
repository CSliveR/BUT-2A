<?php
// Besoin de la classe pour lancer les requêtes 
require_once(__DIR__ . "/../../model/contact.class.php");

// Tableau qui contient la réponse
$out = [];
// Un parametre action est obligatoire
if (! isset($_GET['action'])) {
    $out['error'] = "parameter 'action' is missing";
} else {
    // Examine l'action demandée
    $action = $_GET['action'];

    switch ($action) {
            // Lecture des contacts sachant le nom
        case 'read':
            // Il faut un nom
            $nom = $_GET['nom'] ?? '';
            if ($nom == '') {
                $out['error'] = "nom missing for read";
                break;
            }
            // Lance la demande
            try {
                $contacts = Contact::read($nom);
                // Passe tous les objets en résultat
                $out['contacts'] = $contacts;
            } catch (Exception $e) {
                // Retourne le message d'erreur
                $out['error'] = $e->getMessage();
            }
            break;
            // 
            ///////////////////////////////////////////////////////
            //  A COMPLETER
            ///////////////////////////////////////////////////////
            // 
        default:
            $out['error'] = "incorrect action '$action'";
    }
}

// Sort la réponse
// 
///////////////////////////////////////////////////////
//  A COMPLETER
///////////////////////////////////////////////////////
// 
