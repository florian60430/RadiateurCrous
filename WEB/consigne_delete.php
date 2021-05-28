<?php
include "header.php"; 

$req = $bdd->prepare('DELETE FROM consigne_prog where ID = :ID');
$req->execute(array(
    'ID'=> $_POST["ID"]
));
header('Location: suppconsigne.php');
?>