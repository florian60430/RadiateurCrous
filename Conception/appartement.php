<?php 
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=crous;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$reponse=$bdd->prepare('SELECT * FROM appartement where ID_Batiment = :id ORDER BY id DESC');
$reponse->execute(array(
    'id'=> $_POST["id"]
));
?>

<html>


    <head> </head>

    <body>
        <?php 
            
            while ($donnees1 = $reponse->fetch())
            {
                echo "<B>".htmlspecialchars ($donnees1['Num_appartement'])."</B>"."<br>"; 
                echo htmlspecialchars ($donnees1['locataire'])."<br>";   
                ?><form action="chauffage.php" method="post">
                <input type="hidden" name="id" value="<?php echo $donnees2['id'];?>"> 
                <input type="submit" value="selectioner"><br> </form> <?php   
            }   
        ?>

    </body>

</html>