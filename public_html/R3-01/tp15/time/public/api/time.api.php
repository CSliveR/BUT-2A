<?php
require_once(__DIR__.'/../../model/time.class.php');

// Tableau qui contient la réponse 
$out = [];
// Examine l'action demandée
$action = $_GET['action'] ?? '';
$time = $_GET['timeZone'] ?? '';

switch ($action) {
    // Lecture de la date sachant la time zone
    case 'read':
        ///////////////////////////////////////////////////////
        // A COMPLETER
        ///////////////////////////////////////////////////////
        $out['time'] = new Time($time);
        break;
    default:
        $out['error'] = 'incorrect action';
}

// Change le status en cas d'erreur
// 
///////////////////////////////////////////////////////
// A COMPLETER
///////////////////////////////////////////////////////

if($action === ''){
    header('HTTP/1.1');
}

//  
// Sort la réponse
// Indique dans le header que l'on sort du JSON
header('Content-Type: application/json; charset=utf-8');
print(json_encode($out));
?>