<?php
// récupère les informations de la query string
$city = $_GET['city'] ?? 'Dallas';
$dataSourceName = 'sqlite:'.__DIR__.'/data/contact.db';
$db = new PDO($dataSourceName);

const QUERY = 'SELECT * FROM contact where city=:city';

try {
  $requete = $db->prepare(QUERY);
} catch (PDOException $e) {
  die('PDO query Error on "'.QUERY.'" '.$e->getMessage());
}
$requete->execute([':city' => $city]);
$data = $requete->fetchAll();

// Récupère la ligne $i du résultat de la requête
for($i=0; $i < count($data); $i++){
  $line = $data[$i];
}
// Accès à toutes les colonnes de la ligne $i
$id    = $line['id'];
$name  = $line['name'];
$phone = $line['phone'];
$city  = $line['city'];


?>  


<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="design/style.css">
    <title>My contacts</title>
  </head>
  <body>
    <h1>My contacts from <?= $city ?></h1>

    <?php if (count($data) > 0): // Vérifie s'il y a des résultats ?>
      <table>
        <tr>
          <th>Nom</th>
          <th>Téléphone</th>
        </tr>
        <?php foreach ($data as $contact): ?>
          <tr>
            <td><?= htmlspecialchars($contact['name']) ?></td>
            <td><?= htmlspecialchars($contact['phone']) ?></td>
          </tr>
        <?php endforeach; ?>
      </table>
    <?php else: // Si aucun contact n'est trouvé ?>
      <p>Aucun contact trouvé pour la ville de <?= htmlspecialchars($city) ?>.</p>
    <?php endif; ?>
  </body>
</html>