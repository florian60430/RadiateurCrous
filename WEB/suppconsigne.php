<a href="consigne.php">retour</a><br>
<?php

session_start();

if (isset($_POST["ID_chauffages"])) {

    $_SESSION['idChauffage'] = $_POST["ID_chauffages"];
}

include "header.php";

$reponse = $bdd->query('SELECT * FROM consigne_prog where ID_chauffages =' . $_SESSION['idChauffage'] . '');
while ($data = $reponse->fetch()) {
    echo "<B>" ."Consigne". "</B>". "<br>"; 
    echo "Numério de la consigne : ";
    echo htmlspecialchars($data['ID']) . "<br>";
    echo "Jour de la semaine du début de la consigne : ";
    echo htmlspecialchars($data['jour_semaine_debut']) . "<br>";
    echo "Heure du début de la consigne : ";
    echo htmlspecialchars($data['heure_debut']) . "<br>";
    echo "Jour de la semaine de la fin de la consigne : ";
    echo htmlspecialchars($data['jour_semaine_fin']) . "<br>";
    echo "Heure de fin de la consigne : ";
    echo htmlspecialchars($data['heure_fin']) . "<br>";
    echo "Température voulu en °C : ";
    echo htmlspecialchars($data['température']) . "<br>";
    ?> <form action="consigne_delete.php" method="post">
    <input type="hidden" name="ID" value="<?php echo $data['ID'];?>"> 
    <input type="submit" value="supprimer"><br> </form> <?php
}
?>
