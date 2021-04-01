<?php 
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=crous;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$reponse=$bdd->query('SELECT * FROM batiment ORDER BY id DESC ');
?>

<html>

    <head> </head>

    <body>
        <?php 
        
            while ($donnees = $reponse->fetch())
            {
                echo "<B>".htmlspecialchars ($donnees['nom_batiment'])."</B>"."<br>"; 
                echo htmlspecialchars ($donnees['adresse'])."<br>"; 
                ?><form action="appartement.php" method="post">
                <input type="hidden" name="id" value="<?php echo $donnees['id'];?>"> 
                <input type="submit" value="selectioner"><br> </form> <?php
            }   
    
        ?>
    </body>

</html>