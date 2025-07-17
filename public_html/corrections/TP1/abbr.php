<?php
// Données globlales pour quelques abréviations
$data = array (
  'HTML' => 'HyperText Markeup Language',
  'XML'  =>'eXtended Markeup Language',
  'PHP' => 'Hypertext PreProcessor',
  'CSS' => 'Cascading Style Sheets'
);


// Produit en sortie (i.e. return) une chaîne avec balise abbr et le détail
// de l'abréviation si elle existe sinon, retourne la valeur $abbr
function abbr(string $abbr): string {
  global $data;
  if (isset($data[$abbr])){
    return '<abbr title="'.$data[$abbr].'">'.$abbr.'</abbr>';
  } else {
    return $abbr;
  }
}

// Produit en sortie (i.e. return) une chaîne contenant un
// tableau HTML de toutes les abrévations connues
function abbrAll() : string {
  global $data;
  // Variable pour la production du résultat en HTML
  $out = "<table>\n";
  foreach($data as $key => $value) {
    $out .= "<tr><th>$key</th><td>$value</td></tr>\n";
  }
  $out .= "</table>\n";
  return $out;
}

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Test abbr</title>
</head>
<style media="screen">
  abbr,th {
    color: blue;
  }
</style>
<body>

  <h1>Exemple d'utilisation des abréviations en HTML</h1>

  <p>Le langage <?= abbr('PHP') ?> produit généralement
    du <?= abbr('HTML') ?> mais peu produire aussi
    du <?= abbr('XML') ?> ou même du <?= abbr('CSS') ?>.
  </p>
  <p>Voici toutes les abbréviations connues : </p>
  <?= abbrAll() ?>

</body>
</html>
