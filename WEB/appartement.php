<?php 

include "header.php";

$reponse=$bdd->prepare('SELECT * FROM appartement where ID_Batiment = :ID ORDER BY ID DESC');
$reponse->execute(array(
    'ID'=> $_POST["ID"]
));
?>
<html>
    <head> </head>
    <body>
        <?php 
            while ($donnees1 = $reponse->fetch())
            {
                echo "<B>".htmlspecialchars ($donnees1['num_appartement'])."</B>"."<br>"; 
                echo htmlspecialchars ($donnees1['locataire'])."<br>";   
                ?><form action="chauffage.php" method="post">
                <input type="hidden" name="ID" value="<?php echo $donnees1['ID'];?>"> 
                <input type="submit" value="selectioner"><br> </form> <?php   
            }   
        ?>
    </body>
</html>