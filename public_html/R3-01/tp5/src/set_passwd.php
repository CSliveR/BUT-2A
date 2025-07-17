<?php
/*$passwdFile = fopen("passwd.txt", "w") or die("File already exists !");
$passwd = $_POST['firstPasswd'];
$confirmPasswd = $_POST['confirmPasswd'];
fwrite($passwdFile, $passwd);
fclose($passwdFile);*/

$mdp = $_POST['firstPasswd'];
file_put_contents("passwd.txt", $mdp);
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Password updated</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <section>
    <h2>Password updated</h2>
  </section>
</body>

</html>