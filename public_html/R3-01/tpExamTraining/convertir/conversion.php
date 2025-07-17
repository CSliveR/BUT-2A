<?php
//   Ecrire votre PHP ici 
$tInput = $_GET['tInput'] ?? '';
$tOutput = $_GET['tOutput'] ?? 'X';

if($tInput != ''){
  $tOutput = $tInput*pi()/180.0;
}else{
  $tOutput = 'X';
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Conversion Degré/Radian</title>
    <link rel="stylesheet" href="design/style.css">
  </head>
  <body>
    <h1>Conversion Degré/Radian</h1>
    <form  action="conversion.php" method="get"> 
      <input id="tInput" type="number" step="any" name="tInput" value="">
      <label for="tInput">Degré</label>
      égal
      <output id="tOutput" name="tOutput"><?= $tOutput?> </output> radian 
      <button type="submit" name="action" value="convertir">Convertir</button>
    </form>
  </body>
</html>
