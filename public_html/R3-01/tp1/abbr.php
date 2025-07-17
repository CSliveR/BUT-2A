<?php
    global $tab;
    $tab = array('HTML' => 'HyperText Markeup Language',
    'XML' => 'eXtended Markeup Language', 
    'PHP' => 'Hypertext PreProcessor', 
    'CSS' => 'Cascading Style Sheets');

    // Produit en sortie (i.e. return) une chaîne avec balise abbr et le détail
    // de l'abréviation si elle existe sinon, retourne la valeur $abbr
    function abbr(string $abbr): string {
        global $tab;
        if(isset($tab[$abbr])){
            return "<abbr title='{$tab[$abbr]}'>{$abbr}</abbr>";
        }else{
            return $abbr;
        }
    }  

    // Produit en sortie (i.e. return) une chaine contenant un
    // tableau HTML de toutes les abrévations connues
    function abbrAll(): string {
        global $tab;
        $output = "<table><tr><th>Abréviation</th><th>Description</th></tr>";

        // Ajout de chaque ligne pour chaque abréviation
        foreach ($tab as $abbr => $description) {
            $output .= "<tr><td><abbr title='{$description}'>{$abbr}</abbr></td><td>{$description}</td></tr>";
        }
        
        $output .= "</table>";

        return $output;
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abréviations</title>
</head>
<body>
    <h1>Abréviations connues</h1>
    
    <?php
    // Affiche toutes les abréviations dans un tableau HTML
    echo abbrAll();
    // Exemple d'utilisation de la fonction abbr() pour une abréviation spécifique
    echo "<p>Un exemple d'abréviation : " .abbr('HTML') ."</p>";
    ?>
</body>
</html>
