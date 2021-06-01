<?php
include "header.php"; 
$reponse= $bdd->query('SELECT * FROM config');

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
        <label><b>Attention si vous ne voulez pas changer la température il faut quand même entré la température avec la même valeur affficher et la température et en °C.</b></label><br>
                <input type="text" name="degres_jour" placeholder="Température la journeé">
                <input type="text" name="degres_nuit" placeholder="Température la nuit">
                <input type="submit" name="droitForm" value="valider">
                <br> </form> <?php

                if(isset($_POST['droitForm'])) 
                {

                $result =  $bdd->query("UPDATE config SET degres_jour='".$_POST['degres_jour']."',degres_nuit='".$_POST['degres_nuit']."'");
                echo htmlspecialchars ($_POST['droitForm'])."<br>";
              
                }    
        
                while ($donnees = $reponse->fetch())
                {
                    echo "Température de la consigne du jour en °C : ";
                    echo htmlspecialchars ($donnees['degres_jour'])."<br>"; 
                    echo "Température de la consigne  de nuit en °C: ";
                    echo htmlspecialchars ($donnees['degres_nuit'])."<br>";   
                        
                    ?>
                <?php
                }         
        ?> 
        <a href="index.php">retour aux menu</a>             
    </body>
</html>