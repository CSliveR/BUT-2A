<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Calculatrice PHP</title>
</head>
<body>
    <h1>Calcul</h1>

    <?php
    $a = $_GET['a'] ?? null;  // Récupérer la valeur de 'a' ou null si absente
    $b = $_GET['b'] ?? null;  // Récupérer la valeur de 'b' ou null si absente
    $op = $_GET['op'] ?? null; // Récupérer l'opérateur ou null si absent
    
    if (isset($_GET['a']) && isset($_GET['b']) && isset($_GET['op'])) {
        // Convertir les opérandes en valeurs numériques uniquement si elles sont fournies
        $a = (float)$a;
        $b = (float)$b;
    
        switch ($op) {
            case '-':
                echo $a - $b;
                break;
            case '*':
                echo $a * $b;
                break;
            case '/':
                if ($b != 0) {
                    echo $a / $b;
                } else {
                    echo "Error: divide by zero";
                }
                break;
        }
    } else {
        // Messages d'erreur si les paramètres sont manquants
        if (!isset($_GET['a'])) {
            echo "The left operand is missing";
        } elseif (!isset($_GET['b'])) {
            echo "The right operand is missing";
        } elseif (!isset($_GET['op'])) {
            echo "Operator op is missing";
        }
    }

    ?>

</body>
</html>
