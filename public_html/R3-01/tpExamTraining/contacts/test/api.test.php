<?php
// Modèle
require_once(__DIR__ . '/../model/contact.class.php');
// Fonctions d'aide
require_once(__DIR__ . '/../test/helper.php');

// Lance un test de l'api
// $data : un tableaux de noms, valeurs qui sera transformé en query string
function runAPI(array $data = [])
{
    // Création de la query string
    $querystring = http_build_query($data);
    // Fait croire à un mode GET
    $_SERVER['REQUEST_METHOD'] = 'GET';
    // Dérivation de toutes les sorties dans un buffer
    $res = ob_start();
    if (!$res) {
        print("Error ob_start\n");
        exit(1);
    }
    // Appel de l'api sans query string
    $_SERVER['QUERY_STRING'] = $querystring;
    // Fabrique le contenu de _GET
    parse_str($querystring, $_GET);
    // Lance le code de l'API
    include(__DIR__ . '/../api/contact.api.php');
    // Recupération des sorties
    $value = ob_get_contents();
    ob_end_clean(); // Fin de la dérivation des sorties
    // Retourne ce que l'API a produit
    return $value;
}

try {
    // Test des erreurs
    print_err("Test queryString vide : ");
    $value = runAPI();
    $expected = '{"error":"incorrect action"}';
    if ($value != $expected) {
        print("Retourné : \n");
        var_dump($value);
        print("Attendu : \n");
        var_dump($expected);
        throw new Exception('Mauvaise réponse querystring vide');
    }
    OK();

    print_err("Test delete : ");
    $nom = 'Varde';
    // Recherche un contact de ce nom
    $contacts = Contact::readFromLike($nom);
    if (count($contacts) == 0) {
        throw new Exception("Contact '$nom' non trouvé");
    }
    if (count($contacts) != 1) {
        throw new Exception("Trop de contact '$nom' pour réussi le test");
    }
    // Selectionne le premier contact
    $contact = $contacts[0];
    // et son id
    $id = $contact->getId();
    // Conserve les informations de ce contact
    $saved = new Contact($contact->getNom(), $contact->getPrenom(), $contact->getMobile());
    // Test l'API pour la suppression de ce contact
    $query = array(
        'action' => 'delete',
        'id' => $id
    );
    $value = runAPI($query);
    // Test si l'objet a bien été supprimé
    $search = Contact::readFromLike($nom);
    if (count($search) != 0) {
        throw new Exception("Contact '$nom' n'a pas été supprimé");
    }
    // Rajoute le contact dans la base
    $saved->create();
    OK();


} catch (Exception $e) {
    printCol("\nErreur sur l'API : " . $e->getMessage() . "\n");
}

?>