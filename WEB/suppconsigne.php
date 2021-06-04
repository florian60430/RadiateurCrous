<html>
    <head> 
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap.min.css" /> <!-- Appel CSS boostrap-->
        <link rel="stylesheet" href="style.css" /><!-- Appel le style.CSS -->
        <title>Document</title>
    </head>
    <body>
    <a href="consigne.php">retour</a><br><!-- bouton de retour aux consigne -->

<?php
    session_start();
    include "header.php"; /*un include qui permais de ce connecter a la BDD */
    if (isset($_POST["ID_chauffages"])) { /*condition qui vérifie l'ID envoyer par la page précédente pour n'affiche que les données avec les même ID */

        $_SESSION['idChauffage'] = $_POST["ID_chauffages"];
    }

    $reponse = $bdd->query('SELECT * FROM consigne_prog where ID_chauffages =' . $_SESSION['idChauffage'] . '');
    /*requet MYSQL qui selection tout les données de la table consigne quand les ID corrésponde */
    while ($data = $reponse->fetch()) {/* boucle pour afficher les information de la requet MYSQL*/
        ?><p><?php
        echo "<B>" ."Consigne". "</B>". "<br>"; 
        echo "Numério de la consigne : ";
        echo htmlspecialchars($data['ID']) . "<br>";
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
                                echo "DIMANCHE" ;    
                                }
        echo "Heure du début de la consigne : ";
        echo $data['heure_debut']. "<br>";
        echo "Jour de la semaine de la fin de la consigne : ";
        if ($data['jour_semaine_fin']== '1'){
            echo "LUNDI". "<br>";    
        }   
        else if ($data['jour_semaine_fin']== '2'){
            echo "MARDI". "<br>";    
            }   
            else if ($data['jour_semaine_fin']== '3'){
                echo "MERCREDI". "<br>";    
                }   
                else if ($data['jour_semaine_fin']== '4'){
                    echo "JEUDI". "<br>";    
                    }   
                    else if ($data['jour_semaine_fin']== '5'){
                        echo "VENDREDI". "<br>";    
                        }   
                        else if ($data['jour_semaine_fin']== '6'){
                            echo "SAMEDI". "<br>";    
                            }   
                            else if ($data['jour_semaine_fin']== '7'){
                                echo "DIMANCHE". "<br>";    
                                }
        echo "Heure de fin de la consigne : ";
        echo $data['heure_fin']. "<br>";
        echo "Température voulu en °C : ";
        echo htmlspecialchars($data['température']) . "<br>";
    ?></p>
    <form action="consigne_delete.php" method="post"><!-- bouton qui appel la fonction consigne_delete.php et qui envoi a cette page l'ID de la consigne séléctionner-->
    <input type="hidden" name="ID" value="<?php echo $data['ID'];?>"> 
    <input type="submit" value="supprimer"><br> </form> <?php
}
?>
</body>
</html>