<?php
session_start();
include "header.php";
include "phpMQTT.php";
include "config.php";

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crée une consigne</title>
</head>

<body>
    <form action="" method="post">

        <label><b>Attention la température et en °C.</b></label><br>
        <label>Jour de la semaine du début.</label>
        <select name="jour_semaine_debut">
            <option value="LUNDI" selected="selected">LUNDI</option>
            <option value="MARDI">MARDI</option>
            <option value="MERCREDI">MERCREDI</option>
            <option value="JEUDI">JEUDI</option>
            <option value="VENDREDI">VENDREDI</option>
            <option value="SAMEDI">SAMEDI</option>
            <option value="DIMANCHE">DIMANCHE</option>
            ....
        </select>
        <label>Heure du début.</label>
        <input type="time" name="heure_debut" placeholder="heure de début"><br>
        <label>Jour de la semaine de fin.</label>
        <select name="jour_semaine_fin">
            <option value="LUNDI" selected="selected">LUNDI</option>
            <option value="MARDI">MARDI</option>
            <option value="MERCREDI">MERCREDI</option>
            <option value="JEUDI">JEUDI</option>
            <option value="VENDREDI">VENDREDI</option>
            <option value="SAMEDI">SAMEDI</option>
            <option value="DIMANCHE">DIMANCHE</option>
            ....
        </select>
        <label>Heure de fin.</label>
        <input type="time" name="heure_fin" placeholder="heure de fin"><br>
        <input type="text" name="température" placeholder="température">
        <input type="submit" name="droitForm" value="valider">
        <br>
        <a href="consigne.php">retour</a><br>
    </form>
    <?php
    if (isset($_POST['droitForm'])) {
        $result =  $bdd->query("INSERT INTO `consigne_prog` (`ID`,`ID_chauffages`, `jour_semaine_debut`, `jour_semaine_fin`, `heure_debut`, `heure_fin`, `température`) VALUES (NULL, '" . $_SESSION['idChauffage'] . "', '" . $_POST['jour_semaine_debut'] . "', '" . $_POST['jour_semaine_fin'] . "', '" . $_POST['heure_debut'] . "', '" . $_POST['heure_fin'] . "', '" . $_POST['température'] . "')");

        $mqtt = new bluerhinos\phpMQTT($host, $port, "ClientID" . rand());
        if ($mqtt->connect(true, NULL)) {
            $mqtt->publish("consigne", "\n\n\n ID CHAUFFAGE=" . $_SESSION['idChauffage'] . "\n JOUR DEBUT=" . $_POST['jour_semaine_debut'] . "\n HEURE DEBUT=" . $_POST['heure_debut'] . "\n\n JOUR FIN=" . $_POST['jour_semaine_fin'] . " \n HEURE FIN=" . $_POST['heure_fin'] . " \n\n TEMPERATURE=" . $_POST['température'], 0); // permet d'envoyer la consign à la passerelle
            $mqtt->close();
        } else {
            echo "Fail or time out";
        }
    }

    ?>

</body>
</html>