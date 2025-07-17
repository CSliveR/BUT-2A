<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Tables de multiplication</title>
    <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Tables de multiplication</h1>
    <table>
        <thead>
            <tr>
                <th></th>
                <?php
                // Génération de la première ligne avec les en-têtes des colonnes (1 à 10)
                for ($i = 1; $i <= 10; $i++) {
                    echo "<th>$i</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            // Génération des lignes de la table de multiplication
            for ($row = 1; $row <= 10; $row++) {
                echo "<tr>";
                // En-tête de la ligne (colonne de gauche avec les numéros 1 à 10)
                echo "<th>$row</th>";
                
                // Génération des cellules de la ligne
                for ($col = 1; $col <= 10; $col++) {
                    $result = $row * $col;
                    echo "<td>$result</td>";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>