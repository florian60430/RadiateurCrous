<?php
session_start();
if (isset($_POST["ID"])) {
    $_SESSION['idChauffage'] = $_POST["ID"];
}
include "header.php";/*un include qui permais de ce connecter a la BDD */
$reponse = $bdd->query('SELECT * FROM consigne_prog where ID_chauffages =' . $_SESSION['idChauffage'] . '');
/*requet MYSQL qui selection tout les données de la table consigne quand les ID corrésponde */
?>
<html>

<head>
    <link rel="stylesheet" href="bootstrap.min.css" /><!-- Appel CSS boostrap-->
    <link rel="stylesheet" href="style.css" /><!-- Appel le style.CSS -->
</head>

<body>
    <form action="creeconsigne.php" method="post">
        <!--bouton pour accéder a la page de création de consigne -->
        <input type="hidden" name="ID" value="<?php echo $data['ID_chauffages']; ?>">
        <!-- le bouton envoi l'ID du chauffage a la page de création pour savoir a quelle chauffage il faut appliquer la future consigne crée-->
        <input type="submit" value="crée consigne"><br>
    </form>
    <form action="modconsigne.php" method="post">
        <!--bouton pour accéder a la page de modification de consigne -->
        <input type="hidden" name="ID" value="<?php echo $data['ID_chauffages']; ?>">
        <!-- le bouton envoi l'ID du chauffage a la page de création pour savoir quelle et l'ID du chauffage et afficher les consigne lui corrésepondente-->
        <input type="submit" value="modifier consigne"><br>
    </form>
    <form action="suppconsigne.php" method="post">
        <!--bouton pour accéder a la page de suppréstion de consigne de consigne -->
        <input type="hidden" name="ID" value="<?php echo $data['ID_chauffages']; ?>">
        <!-- le bouton envoi l'ID du chauffage a la page de supprétion pour savoir quelle et l'ID du chauffage et afficher les consigne lui corrésepondente -->
        <input type="submit" value="supprimer consigne"><br>
    </form>
    <a href="chauffage.php">retour</a><br>
    <?php
    while ($data = $reponse->fetch()) {/* boucle pour afficher les information de la requet MYSQL*/
    ?><p><?php
            echo "<B>" . "Consigne" . "</B>". "<br>";
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
            ?><?php
            }
                ?>
        </p>
</body>

</html>