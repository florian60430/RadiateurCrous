<?php
include "header.php"; /*un include qui permais de ce connecter a la BDD */

$req = $bdd->prepare('DELETE FROM consigne_prog where ID = :ID');/* requet MYSQL pour supprimer une consigne quand les ID corésponde*/
$req->execute(array(
    'ID'=> $_POST["ID"]
));
header('Location: suppconsigne.php');
?>