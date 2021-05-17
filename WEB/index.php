<?php

session_start();

include "header.php";


if (isset($_SESSION['userIsConnect'])) {

    if ($_SESSION['userIsConnect']) {
        $reponse = $bdd->query('SELECT * FROM batiment ORDER BY ID DESC');

        while ($donnees = $reponse->fetch()) {
            echo "<B>" . htmlspecialchars($donnees['nom_batiment']) . "</B>" . "<br>";
            echo htmlspecialchars($donnees['adresse']) . "<br>";
?><form action="appartement.php" method="post">
                <input type="hidden" name="ID" value="<?php echo $donnees['ID']; ?>">
                <input type="submit" value="selectioner"><br>
            </form>
        <?php
        } ?>
        <form method="post" action="deconnexion.php">
            <input type="submit" value="Déconnexion">
        </form>
<?php } else {
        include "login.php";
    }
} else {

    include "login.php";
}

?>

</html>