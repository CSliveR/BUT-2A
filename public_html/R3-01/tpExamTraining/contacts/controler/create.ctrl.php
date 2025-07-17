<?php
// 
// Inclusion du framework
include_once(__DIR__."/../framework/view.class.php");
// Inclusion du modèle
include_once(__DIR__."/../model/contact.class.php");

////////////////////////////////////////////////////////////////////////////
// Récupération des données
////////////////////////////////////////////////////////////////////////////

// Ouverture de la sessions pour récupérer le pattern s'il existe
session_start();
$pattern = $_SESSION['pattern'] ?? '';

// Récupération des données du formulaire 
$nom = $_GET['nom'] ?? '';
$prenom = $_GET['prenom'] ?? '';
$mobile = intval($_GET['mobile'] ?? 0);

////////////////////////////////////////////////////////////////////////////
// Activation du modèle
////////////////////////////////////////////////////////////////////////////

// Est-ce qu'il y a des données à ajouter ?
// Il faut soit un nom soit un prénom
$adding = false;
if ($prenom != '' || $nom != '' ) {
    $adding = true;
    $contact = new Contact($nom,$prenom,$mobile);
    $contact->create();
} 

// Relecture des données pour afficher à nouveau la table avec le bon pattern
$contacts = Contact::readFromLike($pattern);

////////////////////////////////////////////////////////////////////////////
// Construction de la vue
////////////////////////////////////////////////////////////////////////////
$view = new View();

// Conserve l'information du pattern
$view->assign('pattern', $pattern);
// Charge la vue en fonction ce que qui a été fait
if ($adding) {
    $view->assign('contacts',$contacts);
    $view->display("main.view.php");
} else {
    $view->display("create.view.php");
}
?>
