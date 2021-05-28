<?php

include "phpMQTT.php";
include "config.php";
include "header.php";

session_start();

if (isset($_POST["ID_chauffages"])) {

    $_SESSION['idChauffage'] = $_POST["ID_chauffages"];
}

if(isset($_POST['droitForm'])) 
{
    $result =  $bdd->query("UPDATE consigne_prog SET jour_semaine_debut='".$_POST['jour_semaine_debut']."',jour_semaine_fin='".$_POST['jour_semaine_fin']."',heure_fin='".$_POST['heure_fin']."',heure_debut='".$_POST['heure_debut']."',température='".$_POST['température']."' where ID ='".$_POST['ID']."' ");
    /*echo htmlspecialchars ($_POST['droitForm'])."<br>";*/
        $mqtt = new bluerhinos\phpMQTT($host, $port, "ClientID" . rand());

        if ($mqtt->connect(true, NULL)) {
            $mqtt->publish("consigne", "\n\n\n ID CHAUFFAGE=" . $_SESSION['idChauffage'] . "\n JOUR DEBUT=" . $_POST['jour_semaine_debut'] . "\n HEURE DEBUT=" . $_POST['heure_debut'] . "\n\n JOUR FIN=" . $_POST['jour_semaine_fin'] . " \n HEURE FIN=" . $_POST['heure_fin'] . " \n\n TEMPERATURE=" . $_POST['température'], 0); // permet d'envoyer la consign à la passerelle
            $mqtt->close();
        } 

        else {
            echo "Fail or time out";
        }              
}  
include "header.php";
$reponse = $bdd->query('SELECT * FROM consigne_prog where ID_chauffages =' . $_SESSION['idChauffage'] . '');
?>
<html>
    <head> 
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Document</title>

    </head>

    <body>

        <form action="" method="post">
            <label><b>Attention si vous ne vouler pas changer de donné vous devez entre la même donné.</b></label><br>
            <label>Numéro de la consigne : </label>
            <select name="ID">
                <?php
                $consignes = "";

                while ($data = $reponse->fetch()){
                    ?>
                    <option value="<?php echo $data['ID']?>"selected="selected"><?Php echo $data['ID'] ?></option>
                <?php 
                $consignes .= "<B>" ."Consigne". "</B>". "<br>"; 
                $consignes .= "Numério de la consigne : ";
                $consignes .= ($data['ID']) . "<br>";
                $consignes .= "Jour de la semaine du début de la consigne : ";
                $consignes .= ($data['jour_semaine_debut']) . "<br>";
                $consignes .= "Heure du début de la consigne : ";
                $consignes .= ($data['heure_debut']) . "<br>";
                $consignes .= "Jour de la semaine de la fin de la consigne : ";
                $consignes .= ($data['jour_semaine_fin']) . "<br>";
                $consignes .= "Heure de fin de la consigne : ";
                $consignes .= ($data['heure_fin']) . "<br>";
                $consignes .= "Température voulu en °C : ";
                $consignes .= ($data['température']) . "<br>";
                } ?>

            </select><br>

                <label>Jour de la semaine du début.</label>
                <select name="jour_semaine_debut">
                    <option value="LUNDI"selected="selected">LUNDI</option>
                    <option value="MARDI">MARDI</option>
                    <option value="MERCREDI">MERCREDI</option>
                    <option value="JEUDI">JEUDI</option>
                    <option value="VENDREDI">VENDREDI</option>
                    <option value="SAMEDI">SAMEDI</option>
                    <option value="DIMANCHE">DIMANCHE</option>
                    ....
                </select>
                <label>Heure du début.</label>
                <input type="time" name="heure_debut" placeholder="heure debut"><br>


                <label>Jour de la semaine de fin.</label>
                <select name="jour_semaine_fin">
                    <option value="LUNDI"selected="selected">LUNDI</option>
                    <option value="MARDI">MARDI</option>
                    <option value="MERCREDI">MERCREDI</option>
                    <option value="JEUDI">JEUDI</option>
                    <option value="VENDREDI">VENDREDI</option>
                    <option value="SAMEDI">SAMEDI</option>
                    <option value="DIMANCHE">DIMANCHE</option>
                    ....
                </select>
                <label>Heure de fin.</label>
                <input type="time" name="heure_fin" placeholder="heure fin"><br>
                <input type="text" name="température" placeholder="température">
                <input type="submit" name="droitForm" value="valider"> 
                </form> 
                
                <a href="consigne.php">retour</a><br>    
                <?php
                echo $consignes;
        ?>      
            
    </body>
</html>
