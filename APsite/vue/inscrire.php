<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
    <link rel="stylesheet" href="../form.css">
    <link rel="icon" type="image/x-icon" href="../images/pegasus.jpg">
</head>
<body>

<header>
    <!-- Menu -->
    <div class="logo">
        <p>Pegasus</p>
    </div>
    <ul class="menu">
        <li><a href="index.html">ACCUEIL</a></li>
        <li><a href="index.html#cars">CATALOGUE</a></li>
        <li><a href="index.html#services">SERVICES</a></li>
        <li><a href="index.html#contact">CONTACT</a></li>
    </ul>
    <button class="login_btn" onclick="window.location.href='connexion.php'">CONNEXION</button>
</header>

<section class="container">
    <h2>Inscription</h2>
    <form action="../controleur/traitement_inscription.php" method="post">
        <label for="nom">Nom :</label><br>
        <input type="text" id="nom" name="nom" required><br>

        <label for="prenom">Prénom :</label><br>
        <input type="text" id="prenom" name="prenom" required><br>

        <label for="email">Email :</label><br>
        <input type="email" id="email" name="email" required><br>

        <label for="mdp">Mot de passe :</label><br>
        <input type="password" id="mdp" name="mdp" required minlength="8"><br>

        <input type="submit" value="S'inscrire">
    </form>
</section>

</body>
</html>
