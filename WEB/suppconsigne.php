<html>
    <head> 
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap.min.css" /> <!-- Appel CSS boostrap-->
        <link rel="stylesheet" href="style.css" /><!-- Appel le style.CSS -->
        <title>Document</title>
    </head>
    <body>
    <a href="consigne.php">retour</a><br><!-- bouton de retour aux consigne -->

<?php
    session_start();
    include "header.php"; /*un include qui permais de ce connecter a la BDD */
    if (isset($_POST["ID_chauffages"])) { /*condition qui vérifie l'ID envoyer par la page précédente pour n'affiche que les données avec les même ID */

        $_SESSION['idChauffage'] = $_POST["ID_chauffages"];
    }

    $reponse = $bdd->query('SELECT * FROM consigne_prog where ID_chauffages =' . $_SESSION['idChauffage'] . '');
    /*requet MYSQL qui selection tout les données de la table consigne quand les ID corrésponde */
    while ($data = $reponse->fetch()) {/* boucle pour afficher les information de la requet MYSQL*/
        ?><p><?php
                echo "<B>" . "Consigne : " . "</B>";
                echo htmlspecialchars($data['ID']) . "<br>";
                echo "début de la consigne : ";
                if ($data['debut'][0] == '1') {
                    echo "LUNDI ";
                } elseif ($data['debut'][0] == '2') {
                    echo "MARDI ";
                } elseif ($data['debut'][0] == '3') {
                    echo "MERCREDI ";
                } elseif ($data['debut'][0] == '4') {
                    echo "JEUDI ";
                } elseif ($data['debut'][0] == '5') {
                    echo "VENDREDI ";
                } elseif ($data['debut'][0] == '6') {
                    echo "SAMEDI ";
                } elseif ($data['debut'][0] == '7') {
                    echo "DIMANCHE ";
                }
                echo $data['debut'][1] . $data['debut'][2] . " h ";
                echo $data['debut'][3] . $data['debut'][3] . " min ". "<br>";
                echo "Fin de la consigne : ";
                if ($data['fin'][0] == '1') {
                    echo "LUNDI ";
                } else if ($data['fin'][0] == '2') {
                    echo "MARDI ";
                } else if ($data['fin'][0] == '3') {
                    echo "MERCREDI ";
                } else if ($data['fin'][0] == '4') {
                    echo "JEUDI ";
                } else if ($data['fin'][0] == '5') {
                    echo "VENDREDI ";
                } else if ($data['fin'][0] == '6') {
                    echo "SAMEDI ";
                } else if ($data['fin'][0] == '7') {
                    echo "DIMANCHE ";
                }
                echo $data['fin'][1] . $data['fin'][2] . " h";
                echo $data['fin'][3] . $data['fin'][4] . " min ". "<br>";
                echo "Température voulu en °C : ";
                echo htmlspecialchars($data['température']) . "";
                ?></p><form action="consigne_delete.php" method="post"><!-- bouton qui appel la fonction consigne_delete.php et qui envoi a cette page l'ID de la consigne séléctionner-->
    <input type="hidden" name="ID" value="<?php echo $data['ID'];?>"> 
    <input type="submit" value="supprimer"><br> </form> <?php

                }
                    ?>
            
    

</body>
</html>