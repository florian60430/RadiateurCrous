<?php 
session_start(); 
include "header.php";

if (isset($_POST["idBatiment"])) {

    $_SESSION['ID_batiment'] = $_POST["idBatiment"];
}
$reponse=$bdd->query("SELECT * FROM appartement where ID_Batiment =".$_SESSION['ID_batiment']);

?>
<html>
    <head> </head>
    <body>
        <?php 
            while ($donnees1 = $reponse->fetch())
            {
                echo "numéro de l'appartement : ";
                echo htmlspecialchars ($donnees1['num_appartement'])."<br>";
                echo "nom du locataire : "; 
                echo htmlspecialchars ($donnees1['locataire'])."<br>";   
                ?><form action="chauffage.php" method="post">
                <input type="hidden" name="idAppartement" value="<?php echo $donnees1['ID'];?>"> 
                <input type="submit" value="selectioner" name="appartement"><br> </form> <?php   
            }   
        ?>
        <a href="index.php">retour</a><br>
    </body>
</html>