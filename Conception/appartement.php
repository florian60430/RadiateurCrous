<?php 
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=crous;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$reponse=$bdd->query('SELECT * FROM appartement where ID_Batiment = :id ORDER BY id DESC');

?>



<html>


    <head> </head>

    <body>
        <?php 
            
            while ($donnees1 = $reponse->fetch())
            {
                echo "<B>".htmlspecialchars ($donnees1['Num_appartement'])."</B>"."<br>"; 
                echo htmlspecialchars ($donnees1['locataire'])."<br>";      
            }   
        ?>

    </body>

</html>