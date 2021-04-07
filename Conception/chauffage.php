<?php 
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=crous;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$reponse=$bdd->prepare('SELECT * FROM chauffages where ID_Appartement = :id ORDER BY id DESC');
$reponse->execute(array(
    'id'=> $_POST["id"]
));
?>

<html>


    <head> </head>

    <body>
        <?php 
            
            while ($donnees2 = $reponse->fetch())
            {
                echo "<B>".htmlspecialchars ($donnees2['ID_Appartement'])."</B>"."<br>"; 
                echo htmlspecialchars ($donnees2['Etat_Chauffage'])."<br>";   
                
            }   
        ?>

    </body>

</html>