<?php
    $input = file('data-source.txt');
    $liste = [];
    foreach($input as $line) {
        $data = explode(' ',trim($line));
        $tel = random_int(611111111,799999999);
        $liste[] = $data[0].'|'.$data[1].'|'.$tel."\n";
    }
    $id = 1;
    $max = count($liste) - 1;
    $output = '';
    while ($max > 0) {
        $i = random_int(0,$max);
        $output .= $id.'|'.$liste[$i];
        $id++;
        if ($i != $max) {
            $liste[$i] = $liste[$max];
        }
        $liste[$max] = "";
        $max --;
    }
    file_put_contents('contacts.txt',$output);
?>