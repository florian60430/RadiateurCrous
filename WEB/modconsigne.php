<?php
include "phpMQTT.php";
include "config.php";
include "header.php";/*un include qui permais de ce connecter a la BDD */

session_start();
if (isset($_POST["ID"])) /*condition qui vérifie l'ID envoyer par la page précédente pour n'affiche que les données avec les même ID */
{ 
    $_SESSION['id1'] = $_POST["ID"];
}
if (isset($_POST['droitForm']))/* requet MYSQL pour modifier la consigne avec les nouvelle donnée quand les ID corrésponde*/ 
{
    $reponse = $bdd->query('SELECT * FROM consigne_prog where ID =' . $_SESSION['id1'] . '');
    echo 'SELECT * FROM consigne_prog where ID =' . $_SESSION['id1'] . '';
    $horraire = true;
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
        //else if($_POST['jour_semaine_fin'] < $data['fin'][0] && $_POST['jour_semaine_fin'] > $data['debut'][0] )
        //{
        //    echo "Le jour de fin de consigne est situer dans l'horaire d'une autre consigne";
        //    echo $horraire = false;
        //    break;
       // }

        // heure fin ver
        //else if($_POST['jour_semaine_fin'] == $data['debut'][0] &&  $_POST['heure_fin'] < $data['fin'][1][2] && $_POST['heure_fin'] > $data['debut'][1][2])
       // {
        //    echo "L'heure de fin de consigne est situer dans l'horaire d'une autre consigne";
        //    echo $horraire = false;
        //    break;
       // }

        // minute de fin ver
        //else if($_POST['jour_semaine_fin'] == $data['debut'][0] &&  $_POST['heure_fin'] == $data['debut'][1][2] && $_POST['minute_fin'] < $data['fin'][3][4] && $_POST['minute_fin'] >= $data['debut'][3][4])
       // {
        //    echo "La minute de fin de consigne est situer dans l'horaire d'une autre consigne";
        //    echo $horraire = false;
        //    break;
        //}
        
        // Jour debut ver
       // else if($_POST['jour_semaine_debut'] < $data['fin'][0] && $_POST['jour_semaine_debut'] > $data['debut'][0] )
        //{
         //   echo "Le jour de debut de consigne est situer dans l'horaire d'une autre consigne";
         //   echo $horraire = false;
         //   break;
        //}

        // heure debut ver
       // else if($_POST['jour_semaine_debut'] == $data['fin'][0] &&  $_POST['heure_debut'] < $data['fin'][1][2] && $_POST['heure_debut'] > $data['fin'][1][2])
        //{
         //   echo "L'heure de debut de consigne est situer dans l'horaire d'une autre consigne";
         //   echo $horraire = false;
          //  break;
        //}

        // minute de debut ver
        //else if($_POST['jour_semaine_debut'] == $data['fin'][0] &&  $_POST['heure_debut'] == $data['fin'][1][2] && $_POST['minute_debut'] <= $data['fin'][3][4] && $_POST['minute_debut'] > $data['debut'][3][4])
       // {
         //   echo "La minute de debut de consigne est situer dans l'horaire d'une autre consigne";
         //   echo $horraire = false;
         //   break;
        //}
    }
    if ($horraire == true){
        $result =  $bdd->query("UPDATE consigne_prog SET debut='" . $_POST['jour_semaine_debut'] . $_POST['heure_debut'] . $_POST['minute_debut'] . "',fin='" . $_POST['jour_semaine_fin'] . $_POST['heure_fin'] . $_POST['minute_fin'] . "',température='" . $_POST['température'] . "' where ID ='" . $_POST['ID'] . "' ");
    }
}

include "header.php";
$reponse = $bdd->query('SELECT * FROM consigne_prog where ID =' . $_SESSION['id1'] . '');
/*requet MYSQL qui selection tout les données de la table consigne quand les ID corrésponde */
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css" /><!-- Appel CSS boostrap-->
    <link rel="stylesheet" href="style.css" /><!-- Appel le style.CSS -->
    <title>modifier une consigne</title>
</head>

<body>

    <form action="" method="post">
        <label><b> Faite attention a ne pas se faire chevaucher les plage horaire des consigne !</b></label><br>
        <label>Numéro de la consigne : </label>
        <select name="ID">
            <?php
          $data = $reponse->fetch();/* boucle pour afficher les information de la requet MYSQL*/
            
            ?>
                <option value="<?php echo $data['ID'] ?>" selected="selected"><?Php echo $data['ID'] ?></option>

            <?php
                $consignes .= "<B>" . "Consigne" . "</B>" . "<br>";
                $consignes .= "Numério de la consigne : ";
                $consignes .= ($data['ID']) . "<br>";
                $consignes .= "Début de la consigne : ";
                if ($data['debut'][0] == '1') {
                    $consignes .= "LUNDI ";
                } elseif ($data['debut'][0] == '2') {
                    $consignes .= "MARDI ";
                } elseif ($data['debut'][0] == '3') {
                    $consignes .= "MERCREDI ";
                } elseif ($data['debut'][0] == '4') {
                    $consignes .= "JEUDI ";
                } elseif ($data['debut'][0] == '5') {
                    $consignes .= "VENDREDI ";
                } elseif ($data['debut'][0] == '6') {
                    $consignes .= "SAMEDI ";
                } elseif ($data['debut'][0] == '7') {
                    $consignes .= "DIMANCHE ";
                }
                $consignes .= $data['debut'][1] . $data['debut'][2] . " h ";
                $consignes .= $data['debut'][3] . $data['debut'][4] . " min " . "<br>";
                $consignes .= " Fin de la consigne : ";
                if ($data['fin'][0] == '1') {
                    $consignes .= "LUNDI ";
                } elseif ($data['fin'][0] == '2') {
                    $consignes .= "MARDI ";
                } elseif ($data['fin'][0] == '3') {
                    $consignes .= "MERCREDI ";
                } elseif ($data['fin'][0] == '4') {
                    $consignes .= "JEUDI ";
                } elseif ($data['fin'][0] == '5') {
                    $consignes .= "VENDREDI ";
                } elseif ($data['fin'][0] == '6') {
                    $consignes .= "SAMEDI ";
                } elseif ($data['fin'][0] == '7') {
                    $consignes .= "DIMANCHE ";
                }
                $consignes .= $data['fin'][1] . $data['fin'][2] . " h ";
                $consignes .= $data['fin'][3] . $data['fin'][4] . " min " . "<br>";
                $consignes .= "Température voulu en °C : ";
                $consignes .= ($data['température']) . "<br>";
           ?>
        </select><br>
        <label>Jour de la semaine du début.</label>
        <?php $jour = array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
                  $nbJour = 1;
        ?>
        <select name="jour_semaine_debut">
            <!-- Permé de selectionner un jour de la semaine pour le debut de la consigne -->
            <?php

            for ($i = 0; $i < 7; $i++)
            {
                if($data["debut"][0] == $nbJour)
                {
                     echo "<option value='".$nbJour."'selected='selected'>".$jour[$i]."</option>";
                }
                else
                {
                    echo "<option value='".$nbJour."'>".$jour[$i]."</option>";
                }
                $nbJour++;
            }
            ?>  
        </select>
        <label>Heure du début.</label>
        <?php $Heure = array("00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23");
                  $nbHeure = 0;
        ?>
        <select name="heure_debut">
            <!-- Permé de selectionner une heure pour le debut de la consigne-->
            <?php
            for ($i = 0; $i < 24; $i++) {
                if($data["debut"][1]. $data["debut"][2] == $nbHeure)
                {
                     echo "<option value='".$Heure[$i]."'selected='selected'>".$Heure[$i]."</option>";
                }
                else
                {
                    echo "<option value='".$Heure[$i]."'>".$Heure[$i]."</option>";
                }
                $nbHeure++;
            }
            ?>
        </select>
        <label>Minute début.</label>
        <?php $Minute = array("00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45" ,"46", "47", "48", "49", "50", "51", "52", "53", "54", "55", "56", "57", "58", "59");
                  $nbMinute = 0;
        ?>
        <select name="minute_debut">
            <!-- Permé de selectionner une heure pour le debut de la consigne-->
            <?php
            for ($i = 0; $i < 60; $i++) {
                if($data["debut"][3]. $data["debut"][4] == $nbMinute)
                {
                     echo "<option value='".$Minute[$i]."'selected='selected'>".$Minute[$i]."</option>";
                }
                else
                {
                    echo "<option value='".$Minute[$i]."'>".$Minute[$i]."</option>";
                }
                $nbMinute++;
            }
            ?>
        </select>
        <br>
        <label>Jour de la semaine de fin.</label>
        <?php $jour = array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
                  $nbJour = 1;
            ?>
            <select name="jour_semaine_fin">
            <!-- Permé de selectionner un jour de la semaine pour le debut de la consigne -->
            <?php

            for ($i = 0; $i < 7; $i++)
            {
                if($data["fin"][0] == $nbJour)
                {
                     echo "<option value='".$nbJour."'selected='selected'>".$jour[$i]."</option>";
                }
                else
                {
                    echo "<option value='".$nbJour."'>".$jour[$i]."</option>";
                }
                $nbJour++;
            }
?>
        </select>
        <label>Heure de fin.</label>
        <?php $Heure = array("00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23");
                  $nbHeure = 0;
        ?>
        <select name="heure_fin">
            <!-- Permé de selectionner une heure pour le debut de la consigne-->
            <?php
            for ($i = 0; $i < 24; $i++) {
                if($data["fin"][1]. $data["fin"][2] == $nbHeure)
                {
                     echo "<option value='".$Heure[$i]."'selected='selected'>".$Heure[$i]."</option>";
                }
                else
                {
                    echo "<option value='".$Heure[$i]."'>".$Heure[$i]."</option>";
                }
                $nbHeure++;
            }
            ?>
        </select>
        <label>Minute de fin.</label>
        <?php $Minute = array("00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45" ,"46", "47", "48", "49", "50", "51", "52", "53", "54", "55", "56", "57", "58", "59");
                  $nbMinute = 0;
        ?>
        <select name="minute_fin">
            <!-- Permé de selectionner une heure pour le debut de la consigne-->
            <?php
            for ($i = 0; $i < 60; $i++) {
                if($data["fin"][3]. $data["fin"][4] == $nbMinute)
                {
                     echo "<option value='".$Minute[$i]."'selected='selected'>".$Minute[$i]."</option>";
                }
                else
                {
                    echo "<option value='".$Minute[$i]."'>".$Minute[$i]."</option>";
                }
                $nbMinute++;
            }
            ?>
        </select>
        <br>
        <input type="text" name="température" placeholder="température"><!-- champ pour récupéré la température voulu-->
        <input type="submit" name="droitForm" value="valider"> <!-- bouton pour appeler la fonction droitForm-->
    </form>

    <a href="consigne.php">retour</a><br>
    <p><?php
        echo $consignes;/*affiche les données des consigne */
        ?></p>

</body>

</html>