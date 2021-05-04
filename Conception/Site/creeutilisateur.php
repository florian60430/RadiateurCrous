<html>
    <head></head>

    <body>
        <form action="util_post.php" method="post">
            <div>
                <label for="user">user :</label>
                <input type="varchar"  name="user">
            </div>
            <div>
                <label for="MDP">Mot de Passe :</label>
                <input type="varchar"  name="MDP">
            </div>
            <div>
                <label for="droit">droit 1 pour l'admin 0 pour l'utilisateur :</label>
                <input type="int"  name="droit">
            </div>
            <div>
                <label for="mail">mail :</label>
                <input type="varchar"  name="mail">
            </div>
            <div>
                <input type="submit" value="envoyer">
            </div>
        </form>
            
    </body>

</html>