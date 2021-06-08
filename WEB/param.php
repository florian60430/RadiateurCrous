<html>
    <head>
        <link rel="stylesheet" href="bootstrap.min.css" /><!-- Appel CSS boostrap-->
        <link rel="stylesheet" href="style.css" /> <!-- Appel le style.CSS -->
    </head>
<?php 
session_start();
if ($_SESSION['connect'] == 2){
    ?>

    <body>
            <form action="acount.php" method="post"> <!-- bouton pour allez la page crée utilisateur -->
            <input type="hidden" name="fg"> 
            <input type="submit" value="crée utilisateur"><br> </form> 
            
            <form action="modutilisateur.php" method="post"><!-- bouton pour allez la page modifier un utilisateur-->
            <input type="hidden" name="fg"> 
            <input type="submit" value="modifier utilisateur"><br> </form> 

            <form action="supputilisateur.php" method="post"><!-- bouton pour allez la page supprimé un utilisateur -->
            <input type="hidden" name="fg"> 
            <input type="submit" value="supprimer utilisateur"><br> </form> 
            <a href="index.php">retour aux menu</a><!-- bouton de retour a l'index/menu -->
    </body>
    <?php }
    else{
        echo"<p style='color:red'>Vous n'avez pas le droit d'accéder a cette page</p>";
        ?><a href="index.php">retour</a><br> <!-- bouton de retour a la page précédente --><?php
    }
?>
</html>
