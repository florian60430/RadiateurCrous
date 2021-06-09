<?php
include "phpMQTT.php";
include "config.php";
include "header.php";/*un include qui permais de ce connecter a la BDD */

session_start();

if (isset($_POST["ID_chauffages"])) { /*condition qui vérifie l'ID envoyer par la page précédente pour n'affiche que les données avec les même ID */


    $_SESSION['idChauffage'] = $_POST["ID_chauffages"];
}

if(isset($_POST['droitForm']))/* requet MYSQL pour modifier la consigne avec les nouvelle donnée quand les ID corrésponde*/
{
    if ($_POST['jour_semaine_fin'] >= $_POST['jour_semaine_debut']){
    $result =  $bdd->query("UPDATE consigne_prog SET debut='".$_POST['jour_semaine_debut'].$_POST['heure_debut'].$_POST['minute_debut']."',fin='".$_POST['jour_semaine_fin'].$_POST['heure_fin'].$_POST['minute_fin']."',température='".$_POST['température']."' where ID ='".$_POST['ID']."' ");
        $mqtt = new bluerhinos\phpMQTT($host, $port, "ClientID" . rand());

        if ($mqtt->connect(true, NULL)) {
            $mqtt->publish("consigne", "\n\n\n ID CHAUFFAGE=" . $_SESSION['idChauffage'] . "\n JOUR DEBUT=" . $_POST['jour_semaine_debut'] . "\n HEURE DEBUT=" . $_POST['heure_debut'] . "\n\n JOUR FIN=" . $_POST['jour_semaine_fin'] . " \n HEURE FIN=" . $_POST['heure_fin'] . " \n\n TEMPERATURE=" . $_POST['température'], 0); 
            // permet d'envoyer la consign à la passerelle
            $mqtt->close();
        } 

        else {
            echo "Fail or time out";
        }   
    }
    else {
       echo "Le jour de fin de consigne ne peut étre avant le jour de début de consigne !";
       }           
}  

include "header.php";
$reponse = $bdd->query('SELECT * FROM consigne_prog where ID_chauffages =' . $_SESSION['idChauffage'] . '');
/*requet MYSQL qui selection tout les données de la table consigne quand les ID corrésponde */
?>
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

        <form action="" method="post">
            <label><b>Attention si vous ne vouler pas changer de donné vous devez entre la même donné, Faite attention a ne pas se faire chevaucher les plage horraire des consigne !</b></label><br>
            <label>Numéro de la consigne : </label>
            <select name="ID">
                <?php 
                $consignes = "";
                ?><?php

                while ($data = $reponse->fetch()){/* boucle pour afficher les information de la requet MYSQL*/
                    ?>
                    <option value="<?php echo $data['ID']?>"selected="selected"><?Php echo $data['ID'] ?></option>
                    
                <?php 
                $consignes .= "<B>" ."Consigne". "</B>". "<br>"; 
                $consignes .= "Numério de la consigne : ";
                $consignes .= ($data['ID']) . "<br>";
                $consignes .= "début de la consigne : ";
                if ( $data['debut'][0]== '1'){
                    $consignes .= "LUNDI ";    
                    }
                    elseif ( $data['debut'][0]== '2'){
                        $consignes .= "MARDI ";    
                        }
                        elseif ( $data['debut'][0]== '3'){
                            $consignes .= "MERCREDI ";    
                            }
                            elseif ( $data['debut'][0]== '4'){
                                $consignes .= "JEUDI ";    
                                }
                                elseif ( $data['debut'][0]== '5'){
                                    $consignes .= "VENDREDI ";    
                                    }
                                    elseif ( $data['debut'][0]== '6'){
                                        $consignes .= "SAMEDI ";    
                                        }
                                        elseif ( $data['debut'][0]== '7'){
                                            $consignes .= "DIMANCHE ";    
                                            }
                                            $consignes .= $data['debut'][1] . $data['debut'][2]. " h ";
                                            $consignes .= $data['debut'][3] . $data['debut'][4]. " min ". "<br>";
                $consignes .= " fin de la consigne : ";
                if ( $data['fin'][0]== '1'){
                    $consignes .= "LUNDI ";    
                    }
                    elseif ( $data['fin'][0]== '2'){
                        $consignes .= "MARDI ";    
                        }
                        elseif ( $data['fin'][0]== '3'){
                            $consignes .= "MERCREDI ";    
                            }
                            elseif ( $data['fin'][0]== '4'){
                                $consignes .= "JEUDI ";    
                                }
                                elseif ( $data['fin'][0]== '5'){
                                    $consignes .= "VENDREDI ";    
                                    }
                                    elseif ( $data['fin'][0]== '6'){
                                        $consignes .= "SAMEDI ";    
                                        }
                                        elseif ( $data['fin'][0]== '7'){
                                            $consignes .= "DIMANCHE ";    
                                            }
                                            $consignes .= $data['fin'][1] . $data['fin'][2]. " h ";
                                            $consignes .= $data['fin'][3] . $data['fin'][4]. " min ". "<br>";
                $consignes .= "Température voulu en °C : ";
                $consignes .= ($data['température']) . "<br>";
                } ?>
                
            </select><br>
                <label>Jour de la semaine du début.</label>
                <select name="jour_semaine_debut">
                    <option value="1"selected="selected">LUNDI</option>
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
                <label>Minute de début.</label>
                <select name="minute_debut">
                <?php
                for ($i = 0; $i < 60; $i++) {
                    if ($i < 10) {
                        $i = "0" . $i;
                    }
                    echo "<option value='$i'> $i M</option>";
                }
                ?>
            </select>
                <br>
                <label>Jour de la semaine de fin.</label>
                <select name="jour_semaine_fin">
                    <option value="1"selected="selected">LUNDI</option>
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
                <label>Minute de fin.</label>
                <select name="minute_fin">
                <?php
                for ($i = 0; $i < 60; $i++) {
                    if ($i < 10) {
                        $i = "0" . $i;
                    }
                    echo "<option value='$i'> $i M</option>";
                }
                ?>
            
            </select>
            <br>
                <input type="text" name="température" placeholder="température">
                <input type="submit" name="droitForm" value="valider"> 
                </form> 
                
                <a href="consigne.php">retour</a><br>    
                <p><?php
                    echo $consignes;/*affiche les données des consigne */ 
                ?></p>
            
    </body>
</html>
