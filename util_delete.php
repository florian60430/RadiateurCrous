<?php
include "header.php"; /*un include qui permais de ce connecter a la BDD */

$req = $bdd->prepare('DELETE FROM admin where ID = :ID');/* requet MYSQL pour supprimé l'utilisateur quand les ID corrésponde*/
$req->execute(array(
    'ID'=> $_POST["ID"]
));
header('Location: supputilisateur.php');
?>