<?php
session_start();
include "header.php";/*un include qui permais de ce connecter a la BDD */
include "phpMQTT.php";
include "config.php";

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css" /><!-- Appel CSS boostrap-->
    <link rel="stylesheet" href="style.css" /><!-- Appel le style.CSS -->
    <title>Crée une consigne</title>
</head>

<body>
    <form action="" method="post"><!-- différent champ qui pour que l'utilisateur puisse rentre les donnée d'une nouvelle consigne -->

        <label><b>Attention la température et en °C Faite attention a ne pas se faire chevaucher les plage horraire des consigne !</b></label><br>
        <label>Jour de la semaine du début.</label>
        <select name="jour_semaine_debut">
            <option value="1" selected="selected">LUNDI</option>
            <option value="2">MARDI</option>
            <option value="3">MERCREDI</option>
            <option value="4">JEUDI</option>
            <option value="5">VENDREDI</option>
            <option value="6">SAMEDI</option>
            <option value="7">DIMANCHE</option>
            ....
        </select>
        <label>Heure du début.</label>
        <select name="heure_debut">
            <?php
            for ($i = 0; $i < 24; $i++) {
                if ($i < 10) {
                    $i = "0" . $i;
                }
                echo "<option value='$i'> $i H</option>";
            }
            ?>
        </select>
        <div>
            <label>Jour de la semaine de fin.</label>
            <select name="jour_semaine_fin">
                <option value="1" selected="selected">LUNDI</option>
                <option value="2">MARDI</option>
                <option value="3">MERCREDI</option>
                <option value="4">JEUDI</option>
                <option value="5">VENDREDI</option>
                <option value="6">SAMEDI</option>
                <option value="7">DIMANCHE</option>
                ....
            </select>
            <label>Heure de fin.</label>
            <select name="heure_fin">
                <?php
                for ($i = 0; $i < 24; $i++) {
                    if ($i < 10) {
                        $i = "0" . $i;
                    }
                    echo "<option value='$i'> $i H</option>";
                }
                ?>
            </select>
            <div>
                <input type="text" name="température" placeholder="température">
                <input type="submit" name="droitForm" value="valider"><!-- bouton pour appeler la fonction droitForm-->
            </div>
            <a href="consigne.php">retour</a><br>
    </form>
    </div>
    <?php
    if (isset($_POST['droitForm'])) {/*fonction MYSQL pour rentre une nouvelle consigne*/ 
        $result =  $bdd->query("INSERT INTO `consigne_prog` (`ID`,`ID_chauffages`, `jour_semaine_debut`, `jour_semaine_fin`, `heure_debut`, `heure_fin`, `température`) 
        VALUES (NULL,'" . $_SESSION['idChauffage'] . "','" . $_POST['jour_semaine_debut'] . "','" . $_POST['jour_semaine_fin'] . "',
        '" . $_POST['heure_debut'] . "','" . $_POST['heure_fin'] . "','" . $_POST['température'] . "')");

        /* $mqtt = new bluerhinos\phpMQTT($host, $port, "ClientID" . rand());
        if ($mqtt->connect(true, NULL)) {
            $mqtt->publish("consigne", "ID CHAUFFAGE=" . $_SESSION['idChauffage'] . "\n JOUR DEBUT=" . $_POST['jour_semaine_debut'] . "\n HEURE DEBUT=" . $_POST['heure_debut'] . "\n\n JOUR FIN=" . $_POST['jour_semaine_fin'] . " \n HEURE FIN=" . $_POST['heure_fin'] . " \n\n TEMPERATURE=" . $_POST['température'] . "\0", 0); // permet d'envoyer la consign à la passerelle
            /*$mqtt->publish("consigne/jourDebut");
            $mqtt->publish("consigne/jourFin");
            $mqtt->publish("");
            $mqtt->publish("");
            $mqtt->publish("");
            $mqtt->close();
        } else {
            echo "Fail or time out";
        }*/
    }
    ?>
</body>
</html>