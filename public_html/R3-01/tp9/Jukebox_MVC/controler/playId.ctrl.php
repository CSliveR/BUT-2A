<?php
// Joue une musique connue par son Id
// Inclusion du modèle
require_once('model/music.class.php');
require_once('model/dao.class.php');
require_once('framework/view.fw.php');

//////////////////////////////////////////////////////////////////////////////
// PARTIE RECUPERATION DES DONNEES
//////////////////////////////////////////////////////////////////////////////

// Récupération de l'ID via la query string
$id = isset($_GET['id']) ? intval($_GET['id']) : '';

// Vérification que l'ID est valide
if ($id === '') {
    $view = new View();
    $view->assign('error', 'ID non défini');
    $view->display('error');
    exit;
}

//////////////////////////////////////////////////////////////////////////////
// PARTIE ACTIVATION DU MODELE
//////////////////////////////////////////////////////////////////////////////

try {
    // Récupération de la musique par son ID
    $music = Music::read($id);
} catch (Exception $e) {
    // Si une exception est levée, afficher l'erreur
    $view = new View();
    $view->assign('error', $e->getMessage());
    $view->display('error');
    exit;
}

//////////////////////////////////////////////////////////////////////////////
// PARTIE ACTIVATION DE LA VUE
//////////////////////////////////////////////////////////////////////////////

// Création de la vue et assignation des variables
$view = new View();
$view->assign('music', $music);      // L'objet music pour afficher les infos
$view->display('playId');            // Affichage de la vue playId

?>