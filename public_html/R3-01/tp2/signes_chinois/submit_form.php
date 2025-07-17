<?php
// Récupération des valeurs
$nom = $_GET['nom'] ?? "inconnu";
$age = $_GET['age'] ?? "inconnu";
$presentation = $_GET['genre'] ?? "inconnu";

// Calculs
// Année de naissance
$currentYear = date('Y');
$yearOfBirth = $currentYear - $age;

// Liste des signes astrologiques chinois (commençant par l'année du Coq en 1921)
$signes = array('Coq', 'Chien', 'Cochon', 'Rat', 'Buffle', 'Tigre', 'Lapin', 'Dragon', 'Serpent', 'Cheval', 'Chèvre', 'Singe');

// Calcul du signe astrologique basé sur l'année de naissance
$index = ($yearOfBirth - 1921) % 12;
$signeChinois = $signes[$index];
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="styles.css">
  <title>Signe Chinois</title>
</head>

<body>
  <header>
    <h1>Signes Astrologiques Chinois</h1>
  </header>
  <main>
    <p>
      Bonjour <?= $presentation ?> <?= $nom ?>, vous etes né en  <?= $yearOfBirth ?>.
      Vous êtes du signe suivant :
    </p>
    <section>
      <p> <?= $signes[$index] ?></p>
    </section>
    
  </main>
  <footer>
    <p>&copy; 2024 Votre Site Astrologique</p>
  </footer>
</body>

</html>