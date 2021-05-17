<?php
try
{
	$bdd = new PDO('mysql:host=192.168.64.155;dbname=crous;charset=utf8', 'flo', '123');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
$reponse=$bdd->query('SELECT * FROM admin ORDER BY ID ');
?>
<html>
    <head></head>
    <body>
        <?php
            while ($donnees = $reponse->fetch())
            {
                echo htmlspecialchars ($donnees['ID'])."<br>"; 
                echo htmlspecialchars ($donnees['user'])."<br>";   
                echo htmlspecialchars ($donnees['mdp'])."<br>"; 
                echo htmlspecialchars ($donnees['droit'])."<br>"; 
                echo htmlspecialchars ($donnees['adresse_mail'])."<br>";
                ?> <form action="util_delete.php" method="post">
                <input type="hidden" name="ID" value="<?php echo $donnees['ID'];?>"> 
                <input type="submit" value="supprimer"><br> </form> <?php
            }      
        ?>     
    </body>
</html>