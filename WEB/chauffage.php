<?php
session_start(); 
include "header.php";/*un include qui permais de ce connecter a la BDD */

if (isset($_POST["idAppartement"])) { /*condition qui vérifie l'ID envoyer par la page précédente pour n'affiche que les données avec les même ID */


    $_SESSION['ID_appartement'] = $_POST["idAppartement"];
}

$reponse=$bdd->query("SELECT * FROM chauffage where ID_appartement=".$_SESSION['ID_appartement']);
/* requet MYSQL qui va selection dans la basse de donné tout les donné de la table chauffage qui respécte la condtion avec les ID*/

?>
<html>
    <head>
        <link rel="stylesheet" href="bootstrap.min.css" /><!-- Appel CSS boostrap-->
        <link rel="stylesheet" href="style.css" /><!-- Appel le style.CSS -->
    </head>
    <body>
    <a href="appartement.php">retour</a><br> <!-- bouton de retour a la page précédente -->
        <?php      
            while ($donnees2 = $reponse->fetch())/* boucle pour afficher les information de la requet MYSQL*/
            {   
                ?><p><?php    
                echo "Température du chauffage N°".$donnees2['ID']." : ".$donnees2['temperature']." °C"."<br>"; 
                echo "Etat du chauffage : ".$donnees2['etat']."<br>";  
                ?> </p> 
                <form action="consigne.php" method="post"><!-- bouton qui envoi a la page des consigne et qui envoi a cette page l'ID du chauffage séléctionner-->
                <input type="hidden" name="ID" value="<?php echo $donnees2['ID'];?>"> 
                <input type="submit" value="sélectionner"><br> </form> <?php   
            } 
          
        ?>
        
    </body>
</html>