<?php
session_start(); 
include "header.php";

if (isset($_POST["idAppartement"])) {

    $_SESSION['ID_appartement'] = $_POST["idAppartement"];
}

$reponse=$bdd->query("SELECT * FROM chauffage where ID_appartement=".$_SESSION['ID_appartement']);

?>
<html>
    <head> </head>
    <body>
        <?php          
            while ($donnees2 = $reponse->fetch())
            {
                echo "<div>température du chauffage N°".$donnees2['ID']." : ".$donnees2['temperature']." °C</div>"; 
                echo "état du chauffage : ".$donnees2['etat'];  
                ?><form action="consigne.php" method="post">
                <input type="hidden" name="ID" value="<?php echo $donnees2['ID'];?>"> 
                <input type="submit" value="selectioner"><br> </form> <?php     
            } 
          
        ?>
        <a href="appartement.php">retour</a><br>
    </body>
</html>