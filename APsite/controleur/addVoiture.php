<?php
if (isset($_POST['send'])) {
    if (!empty($_POST['marque']) && !empty($_POST['modele']) && !empty($_POST['dateConstruction']) && !empty($_POST['couleur']) && !empty($_POST['prix']) && !empty($_POST['nbCheveaux'])) {
        include_once "../modele/connect_ddb.php";

        // Échapper les entrées pour éviter les injections SQL
        $marque = mysqli_real_escape_string($conn, $_POST['marque']);
        $modele = mysqli_real_escape_string($conn, $_POST['modele']);
        $dateConstruction = mysqli_real_escape_string($conn, $_POST['dateConstruction']);
        $couleur = mysqli_real_escape_string($conn, $_POST['couleur']);
        $prix = mysqli_real_escape_string($conn, $_POST['prix']);
        $nbCheveaux = mysqli_real_escape_string($conn, $_POST['nbCheveaux']);

        // Vérifiez si des données existent déjà pour la voiture
        $existingData = mysqli_query($conn, "SELECT * FROM voiture WHERE marque = '$marque' AND modele = '$modele'");
        if (mysqli_num_rows($existingData) > 0) {
            // Si des données existent, effectuez une mise à jour
            $updateQuery = "UPDATE voiture SET dateConstruction = '$dateConstruction', couleur = '$couleur', prix = '$prix', nbCheveaux = '$nbCheveaux' WHERE marque = '$marque' AND modele = '$modele'";
            if (mysqli_query($conn, $updateQuery)) {
                header("location:../vue/classement.php");
            } else {
                header("location:addVoiture.php?message=UpdateFail");
            }
        } else {
            // Si aucune donnée n'existe, insérez une nouvelle entrée
            $insertQuery = "INSERT INTO voiture (marque, modele, dateConstruction, couleur, prix, nbCheveaux) VALUES ('$marque', '$modele', '$dateConstruction', '$couleur', '$prix', '$nbCheveaux')";
            if (mysqli_query($conn, $insertQuery)) {
                header("location:../vue/classement.php");
            } else {
                header("location:addVoiture.php?message=AddFail");
            }
        }

        $conn->close(); // Fermez la connexion
    } else {
        header("location:addVoiture.php?message=EmptyFields");
    }
}
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


