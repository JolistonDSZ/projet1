<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion</h2>
    <form action="../controleur/connexion.php" method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="mdp" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>
    <a href="../vue/vueInscription.php">Pas encore inscrit ? Créez un compte</a>
</body>
</html>
