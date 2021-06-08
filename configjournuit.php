<?php
include "header.php"; /*un include qui permais de ce connecter a la BDD */
$reponse= $bdd->query('SELECT * FROM config'); /*requet MYSQL qui va séléctionner en base tout les information dans la table config */

?>
<html>
    <head> 
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap.min.css" /> <!-- Appel CSS boostrap-->
        <link rel="stylesheet" href="style.css" /> <!-- Appel le style.CSS -->
        <title>Document</title>
    </head>
    <body>
        <form action="" method="post">
        <label><b>Attention si vous ne voulez pas changer la température il faut quand même entré la température avec la même valeur affficher et la température et en °C.</b></label><br>
                <input type="text" name="degres_jour" placeholder="Température la journeé"><!-- champ rentre la température de la journeé -->
                <input type="text" name="degres_nuit" placeholder="Température la nuit"><!-- champ rentre la température de la nuit -->
                <input type="submit" name="droitForm" value="valider"><!-- bouton valide les entrés -->
                <br> </form>
                <a href="index.php">retour aux menu</a> <!-- bouton de retour au menu -->
                <p> 
                <?php
                if(isset($_POST['droitForm'])) /*Fonction qui prend les information de l'utilisateur qui sont dans droitForm et les utilise pour modifier les information en BDD a l'aide de la requet MYSQL*/ 
                {
                $result =  $bdd->query("UPDATE config SET degres_jour='".$_POST['degres_jour']."',degres_nuit='".$_POST['degres_nuit']."'");/* requet MYSQL pour modifier les degres du jour et de la nuit */
                echo htmlspecialchars ($_POST['droitForm'])."<br>";
                }    
                while ($donnees = $reponse->fetch()) /* boucle qui affiche la consigne jour et nuit actuellement en Base de donné*/ 
                {
                    echo "Température de la consigne du jour en °C : ";
                    echo htmlspecialchars ($donnees['degres_jour'])."<br>"; 
                    echo "Température de la consigne  de nuit en °C: ";
                    echo htmlspecialchars ($donnees['degres_nuit'])."<br>";        
                    ?>
                <?php
                }         
        ?> 
        </p>           
    </body>
</html>