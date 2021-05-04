<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=crous;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$req = $bdd->prepare('DELETE FROM util where ID = :ID');
$req->execute(array(
    'ID'=> $_POST["ID"]
));
header('Location: supputilisateur.php');
?>