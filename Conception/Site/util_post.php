<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=crous;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// On ajoute une entrée dans la table messages



$req = $bdd->prepare('INSERT INTO util (user, MDP, droit, mail ) VALUES(:user, :MDP, :droit, :mail)');
$req->execute(array(
	'user' => $_POST["user"],
    'MDP' => $_POST["MDP"],
    'droit' => $_POST["droit"],
    'mail' => $_POST["mail"],
	
	));
header('Location: creeutilisateur.php');
?>