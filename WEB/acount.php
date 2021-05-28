<?php include "header.php"; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <input type="text" name="user" placeholder="identifiant">
        <input type="text" name="mdp" placeholder="mot de passe">
        <input type="email" name='mail' placeholder="email">   
        <input type="radio" id="admin" name="droit" value="utilisateur">
        <label for="1">user</label>
        <input type="radio" id="utilisateur" name="droit" value="admin">
        <label for="2">admin</label>
        <input type="submit" name="droitForm" value="valider">
    </form>
<?php

if(isset($_POST['droitForm'])) 
{

   $result =  $bdd->query("INSERT INTO `admin` (`ID`, `user`, `mdp`, `droit`, `adresse_mail`) VALUES (NULL, '".$_POST['user']."', '".$_POST['mdp']."', '".$_POST['droit']."', '".$_POST['mail']."');");
} 

?>
<a href="param.php">retour</a>  
</body>

</html>