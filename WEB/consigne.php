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
    <?php
    while ($data = $reponse->fetch()) {
    echo "<B>" ."Consigne". "</B>". "<br>";
    echo "Jour de la semaine du début de la consigne : ";
    if ($data['jour_semaine_debut']== '1'){
    echo "LUNDI" . "<br>";    
    }
    elseif ($data['jour_semaine_debut']== '2'){
        echo "MARDI" . "<br>";    
        }
        elseif ($data['jour_semaine_debut']== '3'){
            echo "MERCREDI" . "<br>";    
            }
            elseif ($data['jour_semaine_debut']== '4'){
                echo "JEUDI" . "<br>";    
                }
                elseif ($data['jour_semaine_debut']== '5'){
                    echo "VENDREDI" . "<br>";    
                    }
                    elseif ($data['jour_semaine_debut']== '6'){
                        echo "SAMEDI" . "<br>";    
                        }
                        elseif ($data['jour_semaine_debut']== '7'){
                            echo "DIMANCHE" . "<br>";    
                            }
    echo "Heure du début de la consigne : ";
    echo htmlspecialchars($data['heure_debut']) . "<br>";
    echo "Jour de la semaine de la fin de la consigne : ";
    if ($data['jour_semaine_fin']== '1'){
        echo "LUNDI" . "<br>";    
        }   
        else if ($data['jour_semaine_fin']== '2'){
            echo "MARDI" . "<br>";    
            }   
            else if ($data['jour_semaine_fin']== '3'){
                echo "MERCREDI" . "<br>";    
                }   
                else if ($data['jour_semaine_fin']== '4'){
                    echo "JEUDI" . "<br>";    
                    }   
                    else if ($data['jour_semaine_fin']== '5'){
                        echo "VENDREDI" . "<br>";    
                        }   
                        else if ($data['jour_semaine_fin']== '6'){
                            echo "SAMEDI" . "<br>";    
                            }   
                            else if ($data['jour_semaine_fin']== '7'){
                                echo "DIMANCHE" . "<br>";    
                                }
    echo "Heure de fin de la consigne : ";
    echo htmlspecialchars($data['heure_fin']) . "<br>";
    echo "Température voulu en °C : ";
    echo htmlspecialchars($data['température']) . "<br>";
}
?>
<a href="chauffage.php">retour</a>
</body>

</html>