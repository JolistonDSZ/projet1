<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
</head>
<body>
    <h2>Inscription</h2>
        <form action="../controleur/inscription.php" method="POST">
        <input type="text" name="prenom" placeholder="Prénom" required>
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="adresse" placeholder="Adresse" required>
        <input type="text" name="numTel" placeholder="Numéro de téléphone" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="mdp" placeholder="Mot de passe" required>
        <button type="submit">S'inscrire</button>
    </form>
    <a href="vueAuthentification.php">Déjà inscrit ? Connectez-vous</a>
</body>
</html>


