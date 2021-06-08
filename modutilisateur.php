<?php
include "header.php"; /*un include qui permais de ce connecter a la BDD */
session_start();
if ($_SESSION['connect'] == 2){
$reponse= $bdd->query('SELECT * FROM admin ORDER BY ID ');/* requet qui va selection tout les données de la table admin et les classe par ID*/
if(isset($_POST['droitForm'])) 
{
    $result =  $bdd->query("UPDATE admin SET user='".$_POST['user']."',mdp='".$_POST['mdp']."',droit='".$_POST['droit']."',adresse_mail='".$_POST['mail']."' where ID ='".$_POST['ID']."' ");
    /*requet MYSQL qui va modifier un utilisateur avec de nouvelle données tant que les ID sont les même */ 
    echo htmlspecialchars ($_POST['droitForm'])."<br>";
              
}
?>
<html>
    <head> 
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap.min.css" /><!-- Appel CSS boostrap-->
        <link rel="stylesheet" href="style.css" /><!-- Appel le style.CSS -->
        <title>Document</title>
    </head>
    <body>
         <form action="" method="post">
                    <label><b>Attention si vous ne vouler pas changer de donné vous devez entre la même donné et ne changer pas le numéro d'utilisateur.</b></label><br>
                    <select name="ID">
                    <?php
                    $consignes = ""; 
                    while ($donnees = $reponse->fetch())/*boucle pour afficher les données */
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
                    <!-- champ pour entre les nouvelle données de l'utilisateur -->
                    <input type="text" name="user" placeholder="identifiant">
                    <input type="text" name="mdp" placeholder="mot de passe">
                    <input type="email" name='mail' placeholder="email">   
                    <input type="radio" id="admin" name="droit" value="utilisateur">
                    <label for="1">user</label>
                    <input type="radio" id="utilisateur" name="droit" value="admin">
                    <label for="2">admin</label>
                    <input type="submit" name="droitForm" value="valider"><!--bouton pour appelé la fonction droitFrom et qui envois les données entre dans les champs -->
                    
                    <br> 
                    <a href="param.php">retour</a><br><!--bouton pour retouré a la page des paramétre -->
                    
                </form>   
            <p><?php
                echo $consignes; /*affiche tout les utilisateur et leur données */
            ?></p>  
            <?php
            }     else{
                echo"<p style='color:red'>Vous n'avez pas le droit d'accéder a cette page</p>";
                ?><a href="index.php">retour</a><br> <!-- bouton de retour a la page précédente --><?php
            }      
            ?>        
    </body>
</html>