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
        <!-- menu  -->

        <div class="logo">
            <p>Pegasus</p>
        </div>

        <ul class="menu">
            <li><a href="index.html">ACCUEIL</a></li>
            <li><a href="index.html#cars">CATALOGUE</a></li>
            <li><a href="index.html#services">SERVICES</a></li>
            <li><a href="index.html#contact">CONTACT</a></li>
        </ul>

        <button class="login_btn" onclick="window.location.href='inscrire.php'">S'INSCRIRE</button>
    </header>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

<section class="container">
    <h2>Connexion</h2>
    <form action="../controleur/traitement_connexion.php" method="post">
        <label for="email">Email :</label><br>
        <input type="email" id="email" name="email" required aria-label="Entrez votre email" aria-required="true"><br>

        <label for="mot_de_passe">Mot de passe :</label><br>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required aria-label="Entrez votre mot de passe" aria-required="true" minlength="12"><br>

        <input type="submit" value="Connexion" aria-label="Cliquez ici pour vous inscrire">
    </form>
</section>

</body>
</html>
