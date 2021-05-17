<?php
include "header.php";
// On ajoute une entrée dans la table messages
$req = $bdd->prepare('INSERT INTO admin (user, mdp, droit, adresse_mail ) VALUES(:user, :mdp, :droit, :adresse_mail)');
$req->execute(array(
	'user' => $_POST["user"],
    'mdp' => $_POST["mdp"],
    'droit' => $_POST["droit"],
    'adresse_mail' => $_POST["adresse_mail"],	
	));
header('Location: creeutilisateur.php');
?>