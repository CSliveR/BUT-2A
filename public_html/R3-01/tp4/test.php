<?php
$a = 1;
$a .='0 est une chaîne';
$b = 2*5;
if ($a == $b ) {
    echo "<p>'$a' et '$b' sont équivalents</p>";
}
if ($a === $b ) {
    echo "<p>'$a' et '$b' sont identiques</p>";
} else {
    echo "<p>'$a' et '$b' sont différents</p>";
}
/*L'opérateur == essaie de convertir les 2 opérandes au même type et de les comparer ensuite alors que l'opérateur === compare les types et les valeurs des 2 opérandes.*/
?>


