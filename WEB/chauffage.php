<?php 
include "header.php";

$reponse=$bdd->prepare('SELECT * FROM chauffage where ID_appartement = :ID ORDER BY ID DESC');
$reponse->execute(array(
    'ID'=> $_POST["ID"]
));

?>
<html>
    <head> </head>
    <body>
        <?php          
            while ($donnees2 = $reponse->fetch())
            {
                echo "température du chauffage en °C : ";
                echo htmlspecialchars ($donnees2['temperature'])."<br>"; 
                echo "état du chauffage : ";
                echo htmlspecialchars ($donnees2['etat'])."<br>";   
                ?><form action="consigne.php" method="post">
                <input type="hidden" name="ID" value="<?php echo $donnees2['ID'];?>"> 
                <input type="submit" value="selectioner"><br> </form> <?php     
            } 
          
        ?>
        <a href="index.php">retour</a><br>
    </body>
</html>