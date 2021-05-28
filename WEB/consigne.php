<?php
session_start();
if (isset($_POST["ID"])) {
    $_SESSION['idChauffage'] = $_POST["ID"];
}
include "header.php";
$reponse = $bdd->query('SELECT * FROM consigne_prog where ID_chauffages =' . $_SESSION['idChauffage'] . '');
?>
<html>
<head> </head>
<body>
    <form action="creeconsigne.php" method="post">
        <input type="hidden" name="ID" value="<?php echo $data['ID_chauffages']; ?>">
        <input type="submit" value="crée consigne"><br>
    </form>
    <form action="modconsigne.php" method="post">
        <input type="hidden" name="ID" value="<?php echo $data['ID_chauffages']; ?>">
        <input type="submit" value="modifier consigne"><br>
    </form>   
    <form action="suppconsigne.php" method="post">
        <input type="hidden" name="ID" value="<?php echo $data['ID_chauffages']; ?>">
        <input type="submit" value="supprimer consigne"><br>
    </form>
    <a href="index.php">retour aux menu</a>
    <?php
    while ($data = $reponse->fetch()) {
    echo "<B>" ."Consigne". "</B>". "<br>";
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
}
?>
</body>

</html>