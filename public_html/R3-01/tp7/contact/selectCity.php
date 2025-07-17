<?php
// Connexion à la base de données SQLite via PDO
$dataSourceName = 'sqlite:'.__DIR__.'/data/contact.db';
$db = new PDO($dataSourceName);

// Requête SQL pour récupérer les villes uniques de la table contact
const QUERY = 'SELECT DISTINCT city FROM contact ORDER BY city';

try {
    // Préparation et exécution de la requête pour obtenir les villes uniques
    $requete = $db->prepare(QUERY);
    $requete->execute();
    $cities = $requete->fetchAll(PDO::FETCH_COLUMN); // On récupère seulement les noms de villes
} catch (PDOException $e) {
    // Gestion des erreurs de requête
    die('Erreur de requête PDO : '.$e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Sélectionner une ville</title>
    <link rel="stylesheet" href="design/style.css">
</head>
<body>
    <h1>Sélectionnez une ville pour voir les contacts</h1>

    <form action="contact.php" method="get">
        <?php if (count($cities) > 0): // Vérifie s'il y a des villes disponibles ?>
            <?php foreach ($cities as $city): ?>
                <label>
                    <input type="radio" name="city" value="<?= htmlspecialchars($city) ?>" required>
                    <?= htmlspecialchars($city) ?>
                </label><br>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucune ville trouvée dans la base de données.</p>
        <?php endif; ?>
        <br>
        <button type="submit">Voir les contacts</button>
    </form>
</body>
</html>