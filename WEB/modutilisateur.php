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
if(isset($_POST['droitForm'])) 
{
    $result =  $bdd->query("UPDATE admin SET user='".$_POST['user']."',mdp='".$_POST['mdp']."',droit='".$_POST['droit']."',adresse_mail='".$_POST['mail']."' where ID ='".$_POST['ID']."' ");
    echo htmlspecialchars ($_POST['droitForm'])."<br>";
              
}
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
                    <label><b>Attention si vous ne vouler pas changer de donné vous devez entre la même donné et ne changer pas le numéro d'utilisateur.</b></label><br>
                    <select name="ID">
                    <?php
                    $consignes = ""; 
                    while ($donnees = $reponse->fetch())
                    {  
                    ?>
                        <option value="<?php echo $donnees['ID']?>"selected="selected"><?Php echo $donnees['ID'] ?></option>
                    <?php 
                        $consignes .= "ID : ";
                        $consignes .= ($donnees['ID'])."<br>"; 
                        $consignes .= "user : ";
                        $consignes .= ($donnees['user'])."<br>";
                        $consignes .= "mot de passe : ";   
                        $consignes .= ($donnees['mdp'])."<br>";
                        $consignes .= "droit : "; 
                        $consignes .= ($donnees['droit'])."<br>";
                        $consignes .= "adressse mail : "; 
                        $consignes .= ($donnees['adresse_mail'])."<br>";    
                    
                    } 
                    ?>      
                
                    <input type="text" name="user" placeholder="identifiant">
                    <input type="text" name="mdp" placeholder="mot de passe">
                    <input type="email" name='mail' placeholder="email">   
                    <input type="radio" id="admin" name="droit" value="utilisateur">
                    <label for="1">user</label>
                    <input type="radio" id="utilisateur" name="droit" value="admin">
                    <label for="2">admin</label>
                    <input type="submit" name="droitForm" value="valider">
                    <br> 
                    <a href="param.php">retour</a><br>
                    
                </form>   
            <?php
                echo $consignes;
            ?>                  
    </body>
</html>