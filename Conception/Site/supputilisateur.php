<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=crous;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}



$reponse=$bdd->query('SELECT * FROM util ORDER BY id ');



?>
<html>
    <head></head>

    <body>
        <?php
            while ($donnees = $reponse->fetch()){
                echo htmlspecialchars ($donnees['ID'])."<br>"; 
                echo htmlspecialchars ($donnees['user'])."<br>";   
                echo htmlspecialchars ($donnees['MDP'])."<br>"; 
                echo htmlspecialchars ($donnees['droit'])."<br>"; 
                echo htmlspecialchars ($donnees['mail'])."<br>";
                ?> <form action="util_delete.php" method="post">
                <input type="hidden" name="ID" value="<?php echo $donnees['ID'];?>"> 
                <input type="submit" value="supprimer"><br> </form> <?php
            }   
            
        ?>
            
    </body>

</html>