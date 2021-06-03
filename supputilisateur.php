<?php
include "header.php"; /*un include qui permais de ce connecter a la BDD */
session_start();
if ($_SESSION['connect'] == 2){
$reponse=$bdd->query('SELECT * FROM admin ORDER BY ID '); /*requet MYSQL qui va selection tout les données de la table admin et les classe par ordre d'ID */
?>
<html>
    <head>
        <link rel="stylesheet" href="bootstrap.min.css" /><!-- Appel CSS boostrap-->
        <link rel="stylesheet" href="style.css" /><!-- Appel le style.CSS -->
    </head>
    <a href="param.php">retour</a><br><!--bouton pour retourné a la page des paramétre  -->
    <body>
        <?php
            while ($donnees = $reponse->fetch()) /* boucle pour afficher les données de la requete MYSQL*/
            {
                ?><p><?php   
                echo "ID : ";
                echo htmlspecialchars ($donnees['ID'])."<br>"; 
                echo "user : ";
                echo htmlspecialchars ($donnees['user'])."<br>";
                echo "mot de passe : ";   
                echo htmlspecialchars ($donnees['mdp'])."<br>";
                echo "droit : "; 
                echo htmlspecialchars ($donnees['droit'])."<br>";
                echo "adressse mail : "; 
                echo htmlspecialchars ($donnees['adresse_mail'])."<br>"; 
                ?></p><?php ?> 
                <form action="util_delete.php" method="post"><!--appéle de la fonction util_delete -->
                <input type="hidden" name="ID" value="<?php echo $donnees['ID'];?>"> <!-- envoi l'ID de l'utilisateur selectionner-->
                <input type="submit" value="supprimer"><br> </form> <?php
            }          
        ?>  
        <?php } 
        else{
            echo"<p style='color:red'>Vous n'avez pas le droit d'accéder a cette page</p>";
            ?><a href="index.php">retour</a><br> <!-- bouton de retour a la page précédente --><?php
        }
        ?>   
    </body>
</html>