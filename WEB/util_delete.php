<?php
include "header.php"; 

$req = $bdd->prepare('DELETE FROM admin where ID = :ID');
$req->execute(array(
    'ID'=> $_POST["ID"]
));
header('Location: supputilisateur.php');
?>