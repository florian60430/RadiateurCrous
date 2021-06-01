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
            <input type="text" placeholder="Nom d'utilisateur" name="identifiant" required>
            <label><b>Mot de passe</b></label>
            <input type="password" placeholder="Entrer le mot de passe" name="mdp" required>
            <input type="submit" name="btnSubmit" id='submit' value='Connexion'>
        </form>
    </div>
</body>

</html>