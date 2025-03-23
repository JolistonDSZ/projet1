<?php
require_once "../modele/connect_ddb.php";
include_once "../controleur/addVoiture.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<title>Ajouter une voiture</title>
<link rel="stylesheet" href="../crud.css">
</head>
<body>

<form action="" method="post">
<h1>Ajouter une voiture</h1>
<input type="text" name="marque" placeholder="marque">
<input type="text" name="modele" placeholder="modele">
<input type="text" name="dateConstruction" placeholder="Date de Construction">
<input type="text" name="couleur" placeholder="couleur">
<input type="text" name="prix" placeholder="Prix">
<input type="text" name="nbCheveaux" placeholder="Nombre de Chevaux">
<input type="submit" value="Ajouter" name="send"> 
<a class="link back" href="../vue/classement.php">Annuler</a> 
</form>

</body>
</html>