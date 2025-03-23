<!DOCTYPE html>
<html lang="fr"> 
<head>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<title>Classement</title>
<link rel="stylesheet" href="../crud.css">
<link rel="icon" type="image/x-icon" href="../images/pegasus.jpg">

</head>
<body>
    <background-image : >
<header>
<?php
session_start();  // Démarre la session pour vérifier les données de l'utilisateur

// Vérifie si l'utilisateur est connecté (si une session est active)
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, redirige vers la page de connexion
    header("Location: vueAuthentification.php");
    exit();
}

// Affiche un message de bienvenue si l'utilisateur est connecté
echo "Bienvenue sur votre tableau de bord, " . $_SESSION['user_email'] . "!";
?>


        <!-- menu  -->
        
        <div class="logo">
            <p>Pegasus</p>
        </div>
        <ul class="menu">
            <li><a href="../vue/index.php">ACCUEIL</a></li>
            <li><a href="../vue/index.php#cars">CATALOGUE</a></li>
            <li><a href="../vue/index.php#services">SERVICES</a></li>
            <li><a href="../vue/index.php#contact">CONTACT</a></li>
        </ul>
       <button class="login_btn" onclick="window.location.href='../vue/inscrire.php'">S'INSCRIRE</button>
       <button class="login_btn" onclick="window.location.href='../vue/connexion.php'">CONNEXION</button>




    </header>
<main>
<div class="link_container">
<a class="link" href="addVoiture.php">Ajouter une voiture</a>
</div>
<?php
// Inclure le fichier de connexion PDO
require_once '../modele/connect_ddb.php';  // Assure-toi que ce fichier retourne une connexion PDO

// Obtenir la connexion PDO
$conn = connexionPDO();

try {
    // Requête SQL pour récupérer les voitures
    $sql = "SELECT * FROM voiture"; 
    $stmt = $conn->prepare($sql);
    $stmt->execute();  // Exécute la requête

    // Vérifie si des résultats existent
    if ($stmt->rowCount() > 0) {
        // Affichage du tableau des voitures
        echo "<table class='table'>
                <thead>
                    <tr>
                        <th>Marque</th>
                        <th>Modèle</th>
                        <th>Date de Construction</th>
                        <th>Couleur</th>
                        <th>Prix</th>
                        <th>Nb Chevaux</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>";

        // Parcours des résultats
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['marque']) . "</td>
                    <td>" . htmlspecialchars($row['modele']) . "</td>
                    <td>" . htmlspecialchars($row['dateConstruction']) . "</td>
                    <td>" . htmlspecialchars($row['couleur']) . "</td>
                    <td>" . htmlspecialchars($row['prix']) . " €</td>
                    <td>" . htmlspecialchars($row['nbCheveaux']) . "</td>
                    <td class='image'><a href='../vue/modifyVoiture.php?id=" . htmlspecialchars($row['idVoiture']) . "'><img src='../images/write.png' alt='Modifier'></a></td>
                    <td class='image'><a href='../controleur/deleteVoiture.php?id=" . htmlspecialchars($row['idVoiture']) . "'><img src='../images/remove.png' alt='Supprimer'></a></td>
                  </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<p>Aucune voiture disponible.</p>";
    }
} catch (PDOException $e) {
    echo "Erreur lors de la récupération des données : " . $e->getMessage();
}
?>

</main>
</body>
</html>