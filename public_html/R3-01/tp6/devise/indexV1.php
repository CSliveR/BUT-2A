<?php
require_once(dirname(__FILE__).'/model/change.php');

// Crée l'objet pour gérer le change
$change = new Change('data/exchangeRate.csv');

// Récupère toutes les devises disponibles
$devises = $change->getDevises();

// Initialisation de la variable $result
$result = null;

// Vérifie si les paramètres de conversion sont passés via GET et si le montant est valide
if (isset($_GET['montant'], $_GET['source'], $_GET['cible']) && is_numeric($_GET['montant'])) {
    $montant = (float)$_GET['montant'];
    $source = $_GET['source'];
    $cible = $_GET['cible'];

    try {
        // Effectue la conversion
        $result = $change->change($source, $cible, $montant);
    } catch (Exception $e) {
        // Stocke le message d'erreur si une exception est levée
        $result = "Erreur : " . $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="design/w3.css">
  <link rel="stylesheet" href="design/style.css">
  <title></title>
</head>
<body>

  <header class="w3-container w3-teal">
    <h1>Outil de convertion de devises</h1>
  </header>

  <main class="w3-container">
    <p>
      Boursomachin met à votre disposition ce convertisseur de devises, qui vous permet de convertir des monnaies instantanément et gratuitement.
      Vous pouvez convertir entre elles les devises les plus populaires comme,  Euro EUR, Dollar US USD, Yen japonais JPY, Livre Sterling GBP.
    </p>
    <p>
      Usage : vous entrez dans le convertisseur le montant que vous souhaitez convertir,  indiquez la devise d'origine et la devise qui vous intéresse. Et vous obtenez instantanément le montant dans la devise souhaitée, avec le taux de change entre les 2 monnaies.
    </p>



    <h2>Convertisseur</h2>
    <div>
    <form  id="convertisseur" action="indexV1.php" method="get" class="w3-panel w3-card-2">
      <input id="montant" type="number" name="montant" placeholder="Montant" value="" required>
      
      <!-- Sélection de la devise source -->

      <select id="source" name="source" required>
        <?php foreach ($devises as $devise): ?>
          <option value="<?= htmlspecialchars($devise) ?>" <?= isset($_GET['source']) && $_GET['source'] === $devise ? 'selected' : '' ?>>
            <?= htmlspecialchars($devise) ?>
          </option>
        <?php endforeach; ?>
      </select>
    
      <img src="design/arrow-icon.png" alt="">

      <!-- Sélection de la devise cible -->

      <select id="cible" name="cible">
        <?php foreach ($devises as $devise): ?>
          <option value="<?= htmlspecialchars($devise) ?>" <?= isset($_GET['source']) && $_GET['source'] === $devise ? 'selected' : '' ?>>
            <?= htmlspecialchars($devise) ?>
          </option>
          <?php endforeach; ?>
      </select>

      <button  name="button" type="submit" class="w3-button w3-teal">Convertir</button>
    </form>

    <?php if ($result !== null): ?>
        <output class="w3-container w3-teal w3-xlarge">
          <?php
          if (is_numeric($result)) {
            printf("Le montant converti est de : %.2f %s", $result, htmlspecialchars($_GET['cible']));
          } else {
            echo htmlspecialchars($result);
          }
          ?>
        </output>
    <?php endif; ?>
</div>
  </main>

</body>
</html>
