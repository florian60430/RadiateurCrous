<html>
    <head> 
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap.min.css" /><!-- Appel CSS boostrap-->
        <link rel="stylesheet" href="style.css" /><!-- Appel le style.CSS -->
        <title>Document</title>
    </head>
    <body>
        <form method="post" action="deconnexion.php"> <!-- bouton de déconnexion qui renvoi sur la page déconnextion-->
            <input type="submit" value="Déconnexion">
        </form>
<?php 
if ($_SESSION['connect'] == 2) /* condition pour vérifier que vous été bien un admin pour accéder a la page*/
{?>
        <form action="param.php" method="post"> <!-- bouton de la page paramétre qui renvoi sur la page des paramétre-->
            <input type="hidden" name="fg"> 
            <input type="submit" value="Parametre"><br> 
        </form> 
<?php } ?>


        <form action="configjournuit.php" method="post"> <!-- bouton de la page configjournuit qui renvoi sur la page de la configuration jour nuit -->
            <input type="hidden" name="fg"> 
            <input type="submit" value="configuration températures jour/nuit"><br> 
        </form> 
        <?Php $reponse = $bdd->query('SELECT * FROM batiment'); /*requet MYSQL qui va selection en base de donnée toute les donnée de la table batiment */

        while ($donnees = $reponse->fetch()) { /* boucle qui affiche le nom et l'adresse des tout les batiment de la base de donnée */
            ?><p><?php
            echo "Nom du batiment : ";
            echo htmlspecialchars($donnees['nom_batiment']). "<br>";
            echo "Adresse du batiment : ";
            echo htmlspecialchars($donnees['adresse']). "<br>";
            ?></p>
            <form action="appartement.php" method="post"><!-- bouton de qui envoi sur la page de appartement et qui envoi l'ID du batiment séléctionner-->
                <input type="hidden" name="idBatiment" value="<?php echo $donnees['ID']; ?>">
                <input type="submit" value="selectionner"><br>
            </form>
        <?php
        } ?>     
</body>
</html>