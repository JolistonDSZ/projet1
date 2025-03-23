<?php
require_once "../modele/connect_ddb.php";
include_once "../controleur/modifyVoiture.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Modifier une voiture</title>
    <link rel="stylesheet" href="../crud.css">
</head>
<body>
<form action="modifyVoiture.php?id=<?= $idVoiture ?>" method="post">
    <h1>Modifier une voiture</h1>
    <input type="text" name="marque" value="<?= htmlspecialchars($row['marque']) ?>" placeholder="Marque">
    <input type="text" name="modele" value="<?= htmlspecialchars($row['modele']) ?>" placeholder="Modèle">
    <input type="text" name="dateConstruction" value="<?= htmlspecialchars($row['dateConstruction']) ?>" placeholder="Date de Construction">
    <input type="text" name="couleur" value="<?= htmlspecialchars($row['couleur']) ?>" placeholder="Couleur">
    <input type="text" name="prix" value="<?= htmlspecialchars($row['prix']) ?>" placeholder="Prix">
    <input type="text" name="nbCheveaux" value="<?= htmlspecialchars($row['nbCheveaux']) ?>" placeholder="Nombre de Chevaux">
    <input type="submit" value="Modifier" name="send">
    <a class="link back" href="../vue/classement.php">Annuler</a>
</form>
</body>
</html>