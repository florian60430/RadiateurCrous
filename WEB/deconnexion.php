<?php

session_start();
session_destroy();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css" /><!-- Appel CSS boostrap-->
    <link rel="stylesheet" href="style.css" /><!-- Appel le style.CSS -->
    <title>Document</title>
</head>

<body>
    vous êtes déconnecté <a href="index.php"> accueil </a><!-- bouton qui renvoy a l'index-->
</body>

</html>