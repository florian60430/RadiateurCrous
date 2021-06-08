<?php
    session_start();
    if (isset($_POST["ID"])) {
        $_SESSION['idChauffage'] = $_POST["ID"];
    }
    include "header.php";/*un include qui permais de ce connecter a la BDD */
    $reponse = $bdd->query('SELECT * FROM consigne_prog where ID_chauffages =' . $_SESSION['idChauffage'] . '');
    /*requet MYSQL qui selection tout les données de la table consigne quand les ID corrésponde */
?>
<html>
    <head>
        <link rel="stylesheet" href="bootstrap.min.css" /><!-- Appel CSS boostrap-->
        <link rel="stylesheet" href="style.css" /><!-- Appel le style.CSS -->
    </head>
<body>
    <form action="creeconsigne.php" method="post"><!--bouton pour accéder a la page de création de consigne -->
        <input type="hidden" name="ID" value="<?php echo $data['ID_chauffages']; ?>">
        <!-- le bouton envoi l'ID du chauffage a la page de création pour savoir a quelle chauffage il faut appliquer la future consigne crée-->
        <input type="submit" value="crée consigne"><br>
    </form>
    <form action="modconsigne.php" method="post"><!--bouton pour accéder a la page de modification de consigne -->
        <input type="hidden" name="ID" value="<?php echo $data['ID_chauffages']; ?>">
        <!-- le bouton envoi l'ID du chauffage a la page de création pour savoir quelle et l'ID du chauffage et afficher les consigne lui corrésepondente-->
        <input type="submit" value="modifier consigne"><br>
    </form>   
    <form action="suppconsigne.php" method="post"><!--bouton pour accéder a la page de suppréstion de consigne de consigne -->
        <input type="hidden" name="ID" value="<?php echo $data['ID_chauffages']; ?>">
        <!-- le bouton envoi l'ID du chauffage a la page de supprétion pour savoir quelle et l'ID du chauffage et afficher les consigne lui corrésepondente -->
        <input type="submit" value="supprimer consigne"><br>
    </form>
    <a href="chauffage.php">retour</a><br>
    <?php
    while ($data = $reponse->fetch()) {/* boucle pour afficher les information de la requet MYSQL*/
    ?><p><?php
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
    echo $data['heure_debut']. "<br>";
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
    echo $data['heure_fin']. "<br>";
    echo "Température voulu en °C : ";
    echo htmlspecialchars($data['température']) . "<br>";
    ?></p><?php
}
?>
</body>
</html>