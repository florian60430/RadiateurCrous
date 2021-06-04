<?php include "header.php"; /*un include qui permais de ce connecter a la BDD */?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css" /><!-- Appel CSS boostrap-->
    <link rel="stylesheet" href="style.css" /><!-- Appel le style.CSS -->
    <title>Document</title>
</head>
<?php
session_start();
if ($_SESSION['connect'] == 2){
    ?>
<body>
    <form action="" method="post"> <!-- différent champ qui pour que l'utilisateur puisse rentre les donnée du nouvelle utilisateur -->
        <input type="text" name="user" placeholder="identifiant">
        <input type="text" name="mdp" placeholder="mot de passe">
        <input type="email" name='mail' placeholder="email">   
        <input type="radio" id="admin" name="droit" value="utilisateur">
        <label for="1">user</label>
        <input type="radio" id="utilisateur" name="droit" value="admin">
        <label for="2">admin</label>
        <input type="submit" name="droitForm" value="valider"> <!-- bouton pour valider les info et appele la fonction droitForm -->
    </form>
<?php

if(isset($_POST['droitForm'])) /*fonction qui va crée un nouvelle admin dans basse de donnée dans la table admin  */
{

   $result =  $bdd->query("INSERT INTO `admin` (`ID`, `user`, `mdp`, `droit`, `adresse_mail`) VALUES (NULL, '".$_POST['user']."', '".$_POST['mdp']."', '".$_POST['droit']."', '".$_POST['mail']."');");
} 

?>
<a href="param.php">retour</a>  <!--bouton pour retourné a la page des paramétre -->
</body>
<?php } 
else{
    echo"<p style='color:red'>Vous n'avez pas le droit d'accéder a cette page</p>";
    ?><a href="index.php">retour</a><br> <!-- bouton de retour a la page précédente --><?php
}
?>
</html>