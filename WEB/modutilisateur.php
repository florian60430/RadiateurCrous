<?php
try
{
	$bdd = new PDO('mysql:host=192.168.64.155;dbname=crous;charset=utf8', 'flo', '123');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
$reponse= $bdd->query('SELECT * FROM admin ORDER BY ID ');

?>
<html>
    <head> 
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <form action="" method="post">
                <input type="text" name="ID" placeholder="ID">
                <input type="text" name="user" placeholder="identifiant">
                <input type="text" name="mdp" placeholder="mot de passe">
                <input type="email" name='mail' placeholder="email">   
                <input type="radio" id="admin" name="droit" value="utilisateur">
                <label for="1">user</label>
                <input type="radio" id="utilisateur" name="droit" value="admin">
                <label for="2">admin</label>
                <input type="submit" name="droitForm" value="valider">
                <br> </form> <?php

                if(isset($_POST['droitForm'])) 
                {

                $result =  $bdd->query("UPDATE admin SET user='".$_POST['user']."',mdp='".$_POST['mdp']."',droit='".$_POST['droit']."',adresse_mail='".$_POST['mail']."' where ID ='".$_POST['ID']."' ");
                echo htmlspecialchars ($_POST['droitForm'])."<br>";
              
                }    
        
                while ($donnees = $reponse->fetch())
                {
                    echo htmlspecialchars ($donnees['ID'])."<br>"; 
                    echo htmlspecialchars ($donnees['user'])."<br>";   
                    echo htmlspecialchars ($donnees['mdp'])."<br>"; 
                    echo htmlspecialchars ($donnees['droit'])."<br>"; 
                    echo htmlspecialchars ($donnees['adresse_mail'])."<br>";    
                    ?>
                <?php
                }         
        ?>              
    </body>
</html>