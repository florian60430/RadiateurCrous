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
        <select name="jour_semaine_debut"><!-- Permé de selectionner un jour de la semaine pour le debut de la consigne -->
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
        <select name="heure_debut"><!-- Permé de selectionner une heure pour le debut de la consigne-->
            <?php
            for ($i = 0; $i < 24; $i++) {
                if ($i < 10) {
                    $i = "0" . $i;
                }
                echo "<option value='$i'> $i H</option>";
            }
            ?>
        </select>
        <label>Minute de début.</label>
            <select name="minute_debut"><!-- Permé de selectionner une minute pour le debut de la consigne-->
                <?php
                for ($i = 0; $i < 60; $i++) {
                    if ($i < 10) {
                        $i = "0" . $i;
                    }
                    echo "<option value='$i'> $i M</option>";
                }
                ?>
            </select>
        <div>
            <label>Jour de la semaine de fin.</label>
            <select name="jour_semaine_fin"><!-- Permé de selectionner un jour de la semaine pour la fin de la consigne -->
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
            <select name="heure_fin"><!-- Permé de selectionner une heure pour la fin de la consigne-->
                <?php
                for ($i = 0; $i < 24; $i++) {
                    if ($i < 10) {
                        $i = "0" . $i;
                    }
                    echo "<option value='$i'> $i H</option>";
                }
                ?>
            </select>
            <label>Minute de fin.</label>
            <select name="minute_fin"><!-- Permé de selectionner une minute pour la fin de la consigne-->
                <?php
                for ($i = 0; $i < 60; $i++) {
                    if ($i < 10) {
                        $i = "0" . $i;
                    }
                    echo "<option value='$i'> $i M</option>";
                }
                ?>
            </select>
            <div>
                <input type="text" name="température" placeholder="température"><!-- champ pour récupéré la température voulu-->
                <input type="submit" name="droitForm" value="valider"><!-- bouton pour appeler la fonction droitForm-->   
            </div>
            <a href="consigne.php">retour</a><br>
    </form>
    </div>
    <?php   
            if (isset($_POST["ID_chauffages"])) /*condition qui vérifie l'ID envoyer par la page précédente pour n'affiche que les données avec les même ID */
            { 
                $_SESSION['idChauffage'] = $_POST["ID_chauffages"];
            }
            if (isset($_POST['droitForm']))/* requet MYSQL pour modifier la consigne avec les nouvelle donnée quand les ID corrésponde*/ 
            {
                $reponse = $bdd->query('SELECT * FROM consigne_prog where ID_chauffages =' . $_SESSION['idChauffage'] . '');
                $horrairecree = true;
                while ($data = $reponse->fetch()) 
                {
                    //if ($_POST['jour_semaine_fin'] > $_POST['jour_semaine_debut']) /* Modifie la consigne si le jour de fin de consigne et stictement suppérieur au jour de début de consigne */ {
                    //  $result =  $bdd->query("UPDATE consigne_prog SET debut='" . $_POST['jour_semaine_debut'] . $_POST['heure_debut'] . $_POST['minute_debut'] . "',fin='" . $_POST['jour_semaine_fin'] . $_POST['heure_fin'] . $_POST['minute_fin'] . "',température='" . $_POST['température'] . "' where ID ='" . $_POST['ID'] . "' ");
                    //}
                    if ($_POST['jour_semaine_fin'] < $_POST['jour_semaine_debut']) /* vérifier que le jour de fin ne soit pas avant le jour de début de consigne */ 
                    {
                        echo $horraire = false;
                        echo "Le jour de fin de consigne ne peut être avant le jour de début de consigne !";
                        break;
                    } 
                    //else if ($_POST['jour_semaine_fin'] == $_POST['jour_semaine_debut'] && $_POST['heure_fin'] > $_POST['heure_debut'])  /* modifie une consigne si le jour de début et égale au jour de fin mais que l'heure de fin et suppérieur a l'heure de début*/ 
                    //{
                    //    $result =  $bdd->query("UPDATE consigne_prog SET debut='" . $_POST['jour_semaine_debut'] . $_POST['heure_debut'] . $_POST['minute_debut'] . "',fin='" . $_POST['jour_semaine_fin'] . $_POST['heure_fin'] . $_POST['minute_fin'] . "',température='" . $_POST['température'] . "' where ID ='" . $_POST['ID'] . "' ");
                    //} 
                    else if ($_POST['jour_semaine_fin'] == $_POST['jour_semaine_debut'] && $_POST['heure_fin'] < $_POST['heure_debut']) /* vérifier que l'heure de fin de consigne ne soit pas avant l'heure de début de consigne si la consigne tombe le même jour*/ 
                    {
                        echo "L'heure de fin de consigne ne peut étre avant l'heure de début de consigne !";
                        echo $horraire = false;
                        break;
                    } 
                    //else if ($_POST['jour_semaine_fin'] == $_POST['jour_semaine_debut'] && $_POST['heure_fin'] == $_POST['heure_debut'] && $_POST['minute_fin'] >= $_POST['minute_debut'])/* modifie une consigne si elle tombe le même joue a la même heure mais que la minute de fin soit supérieur ou égale a la minute de début */ 
                    //{
                    //    $result =  $bdd->query("UPDATE consigne_prog SET debut='" . $_POST['jour_semaine_debut'] . $_POST['heure_debut'] . $_POST['minute_debut'] . "',fin='" . $_POST['jour_semaine_fin'] . $_POST['heure_fin'] . $_POST['minute_fin'] . "',température='" . $_POST['température'] . "' where ID ='" . $_POST['ID'] . "' ");
                    //} 
                    else if($_POST['jour_semaine_fin'] == $_POST['jour_semaine_debut'] && $_POST['heure_fin'] == $_POST['heure_debut'] && $_POST['minute_fin'] < $_POST['minute_debut'])
                    {
                        echo "La minute de fin de consigne ne peut étre avant la minute de début de consigne !";
                        echo $horraire = false;
                        break;
                    }
            
                    // Jour fin ver
                   // else if($_POST['jour_semaine_fin'] < $data['fin'][0] && $_POST['jour_semaine_fin'] > $data['debut'][0] )
                  //  {
                      //  echo "Le jour de fin de consigne est situer dans l'horaire d'une autre consigne";
                      //  echo $horraire = false;
                      //  break;
                    //}
            
                    // heure fin ver
                   // else if($_POST['jour_semaine_fin'] == $data['debut'][0] &&  $_POST['heure_fin'] < $data['fin'][1][2] && $_POST['heure_fin'] > $data['debut'][1][2])
                   // {
                      //  echo "L'heure de fin de consigne est situer dans l'horaire d'une autre consigne";
                     //   echo $horraire = false;
                      //  break;
                   // }
            
                    // minute de fin ver
                   // else if($_POST['jour_semaine_fin'] == $data['debut'][0] &&  $_POST['heure_fin'] == $data['debut'][1][2] && $_POST['minute_fin'] < $data['fin'][3][4] && $_POST['minute_fin'] >= $data['debut'][3][4])
                  //  {
                     //   echo "La minute de fin de consigne est situer dans l'horaire d'une autre consigne";
                     //   echo $horraire = false;
                      //  break;
                   // }
                    
                    // Jour debut ver
                    //else if($_POST['jour_semaine_debut'] < $data['fin'][0] && $_POST['jour_semaine_debut'] > $data['debut'][0] )
                  //  {
                      //  echo "Le jour de debut de consigne est situer dans l'horaire d'une autre consigne";
                      //  echo $horraire = false;
                      //  break;
                    //}
            
                    // heure debut ver
                   // else if($_POST['jour_semaine_debut'] == $data['fin'][0] &&  $_POST['heure_debut'] < $data['fin'][1][2] && $_POST['heure_debut'] > $data['fin'][1][2])
                   // {
                       // echo "L'heure de debut de consigne est situer dans l'horaire d'une autre consigne";
                        //echo $horraire = false;
                       // break;
                    //}
            
                    // minute de debut ver
                    //else if($_POST['jour_semaine_debut'] == $data['fin'][0] &&  $_POST['heure_debut'] == $data['fin'][1][2] && $_POST['minute_debut'] <= $data['fin'][3][4] && $_POST['minute_debut'] > $data['debut'][3][4])
                    //{
                       // echo "La minute de debut de consigne est situer dans l'horaire d'une autre consigne";
                       // echo $horraire = false;
                        //break;
                    //}
                }
                if ($horrairecree == true){
                    $result =  $bdd->query("INSERT INTO `consigne_prog` (`ID`,`ID_chauffages`, `debut`, `fin`, `température`) VALUES (NULL,'" . $_SESSION['idChauffage'] . "','" . $_POST['jour_semaine_debut'] . $_POST['heure_debut']. $_POST['minute_debut']. "','" . $_POST['jour_semaine_fin'] . $_POST['heure_fin'] . $_POST['minute_fin']. "','" . $_POST['température'] . "')");
                }
            }

        ?> 
</body>
</html>