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
    <a href="param.php">retour</a><br>
    <body>
        <?php
            while ($donnees = $reponse->fetch())
            {
                
                echo "ID : ";
                echo htmlspecialchars ($donnees['ID'])."<br>"; 
                echo "user : ";
                echo htmlspecialchars ($donnees['user'])."<br>";
                echo "mot de passe : ";   
                echo htmlspecialchars ($donnees['mdp'])."<br>";
                echo "droit : "; 
                echo htmlspecialchars ($donnees['droit'])."<br>";
                echo "adressse mail : "; 
                echo htmlspecialchars ($donnees['adresse_mail'])."<br>"; 
                ?> <form action="util_delete.php" method="post">
                <input type="hidden" name="ID" value="<?php echo $donnees['ID'];?>"> 
                <input type="submit" value="supprimer"><br> </form> <?php
            }      
        ?>     
    </body>
</html>