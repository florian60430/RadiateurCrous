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
                echo "<B>".htmlspecialchars ($donnees2['ID_appartement'])."</B>"."<br>"; 
                echo htmlspecialchars ($donnees2['etat'])."<br>";   
                
            }   
        ?>
    </body>
</html>