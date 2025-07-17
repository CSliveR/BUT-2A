<?php
// Création de la liste des musiques
// On suppose que chaque groupe a un répertoire et que dans
// chaque réprtoire il y a des fichiers MP3 et avec le même nom de fichier
// un fichier image au format jpeg avec le suffixe .jpeg

// Construit la liste de tous les noms de fichiers MP3 du répertoire $groupDir
function findMP3(string $groupDir): array {
  $res = array();
  $dh = opendir($groupDir);
  while (false != ($entry = readdir($dh))) {
    $path_parts = pathinfo($entry);
    if ($path_parts['extension'] == 'mp3') {
      $res[] = $path_parts['filename'];
    }
  }
  return $res;
}

// Construit la liste des toutes les musiques de tous les groupes
function scanMusic(string $dataDir): array {
  $res = array();
  $dh = opendir($dataDir);
  while (false != ($entry = readdir($dh))) {
    if ($entry[0] != '.') {
      $res[$entry] = findMP3($dataDir.'/'.$entry);
    }
  }
  return $res;
}

$musics = scanMusic("data");

// Sortie de la liste de tous les groupes et toutes les musiques
$id = 1; // Pour identifier les musiques
foreach ($musics as $group => $mp3s) {
  foreach ($mp3s as $song) {
    //print("$id|$group|$song\n");
    print("$group|$song\n");
    $id++;
  }
}

?>
