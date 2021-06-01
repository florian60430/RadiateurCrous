
        <form method="post" action="deconnexion.php">
            <input type="submit" value="Déconnexion">
        </form>
        <form action="param.php" method="post">
            <input type="hidden" name="fg"> 
            <input type="submit" value="Parametre"><br> 
        </form> 
        <form action="configjournuit.php" method="post">
            <input type="hidden" name="fg"> 
            <input type="submit" value="configuration températures jour/nuit"><br> 
        </form> 
        <?Php $reponse = $bdd->query('SELECT * FROM batiment');

        while ($donnees = $reponse->fetch()) {
            echo "Nom du batiment : ";
            echo htmlspecialchars($donnees['nom_batiment']). "<br>";
            echo "Adresse du batiment : ";
            echo htmlspecialchars($donnees['adresse']). "<br>";
            ?><form action="appartement.php" method="post">
                <input type="hidden" name="idBatiment" value="<?php echo $donnees['ID']; ?>">
                <input type="submit" value="selectioner"><br>
            </form>
        <?php
        } ?>