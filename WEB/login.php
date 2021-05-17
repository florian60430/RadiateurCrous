<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body>
        <div id="container">
            <!-- zone de connexion -->
            <form action="" method="POST">
                <h1>Connexion</h1>
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Nom d'utilisateur" name="user" required>
                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="mdp" required>
                <input type="submit" name="login" id='submit' value='Connexion'>
                <?php
                    if(isset($_POST['login'])){

                        $result = $bdd->query("SELECT * from admin WHERE user ='".$_POST['user']."' && '".$_POST['mdp']."'");
                        if (!$result->rowcount())
                        {
                            echo $result->rowcount();
                            echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                        }
                        else
                        {
                           $_SESSION['userIsConnect'] = 1;
                        }
                    }
                ?>
            </form>
        </div>
    </body>
</html>