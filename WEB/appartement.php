<?php 
session_start(); 
include "header.php";/*un include qui permais de ce connecter a la BDD */

if (isset($_POST["idBatiment"])) { /*condition qui vérifie l'ID envoyer par la page précédente pour n'affiche que les données avec les même ID */

    $_SESSION['ID_batiment'] = $_POST["idBatiment"];
}

$reponse=$bdd->query("SELECT * FROM appartement where ID_Batiment =".$_SESSION['ID_batiment']); 
/* requet MYSQL qui va selection dans la basse de donné tout les donné de la table appartement qui respécte la condtion avec les ID*/
?>
<html>
    <head>
        <link rel="stylesheet" href="bootstrap.min.css" /><!-- Appel CSS boostrap-->
        <link rel="stylesheet" href="style.css" /><!-- Appel le style.CSS -->
    </head>
    <body>
    <a href="index.php">retour</a><br> <!-- bouton de retour a la page précédente -->
        <?php 
            while ($donnees1 = $reponse->fetch()) /* boucle pour afficher les information de la requet MYSQL*/
            {   
                ?><p><?php
                echo "numéro : ";
                echo htmlspecialchars ($donnees1['num_appartement'])."<br>";
                echo "nom du locataire : "; 
                echo htmlspecialchars ($donnees1['locataire'])."<br>"; 
                ?></p><?php  
                ?><form action="chauffage.php" method="post"><!-- bouton qui envoi a la page des chauffage et qui envoi a cette page l'ID de l'appartement séléctionner-->
                <input type="hidden" name="idAppartement" value="<?php echo $donnees1['ID'];?>"> 
                <input type="submit" value="sélectionner" name="appartement"><br> </form> <?php  
            }   
        ?>
    </body>
</html>