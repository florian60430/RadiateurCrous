<?php
session_start();

include "header.php";
include "fonction.php";

if (isset($_POST['mdp'], $_POST['identifiant'])) {

    $result = verification($bdd, $_POST['identifiant'], $_POST['mdp']);
    if ($result == true) {
        $_SESSION['connect'] = 1;
    } else 
    {
        echo "<p style='color:red'>utilisateur ou mot de passe incorrect</p>";
    }
}

if (isset($_SESSION['connect'])) {

    if ($_SESSION['connect']) {

        include 'site.php';
        ?> <a href="index.php">Accueil</a> <?php 
    } else {
        include 'login.php';
    }
} else {
    include 'login.php';
}



?>

</html>