<?php
if (isset($_GET['id'])) {
    $idVoiture = $_GET['id'];
} else {
    // Redirection ou gestion d'erreur si l'ID n'est pas fourni
    header("location: classement.php?message=NoID");
    exit;
}

include_once "../modele/connect_ddb.php";

if (isset($_POST['send'])) {
    if (!empty($_POST['marque']) && !empty($_POST['modele']) && !empty($_POST['dateConstruction']) && !empty($_POST['couleur']) && !empty($_POST['prix']) && !empty($_POST['nbCheveaux'])) {
        // Utilisez mysqli_real_escape_string pour éviter les injections SQL
        $marque = mysqli_real_escape_string($conn, $_POST['marque']);
        $modele = mysqli_real_escape_string($conn, $_POST['modele']);
        $dateConstruction = mysqli_real_escape_string($conn, $_POST['dateConstruction']);
        $couleur = mysqli_real_escape_string($conn, $_POST['couleur']);
        $prix = mysqli_real_escape_string($conn, $_POST['prix']);
        $nbCheveaux = mysqli_real_escape_string($conn, $_POST['nbCheveaux']);

        // Préparation de la requête SQL pour mise à jour
        $sql = "UPDATE voiture SET marque = ?, modele = ?, dateConstruction = ?, couleur = ?, prix = ?, nbCheveaux = ? WHERE idVoiture = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssiii", $marque, $modele, $dateConstruction, $couleur, $prix, $nbCheveaux, $idVoiture);
        
        if ($stmt->execute()) {
            header("location: ../vue/classement.php");
            exit;
        } else {
            header("location: ../vue/classement.php?message=ModifyFail");
            exit;
        }
    } else {
        header("location: ../vue/classement.php?message=EmptyFields");
        exit;
    }
}

// Récupération des données existantes pour pré-remplir le formulaire
$sql = "SELECT * FROM voiture WHERE idVoiture = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idVoiture);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

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
<form action="" method="post">
<h1>Modifier une voiture</h1>
<input type="text" name="marque" value="<?= htmlspecialchars($row['marque']) ?>" placeholder="marque">
<input type="text" name="modele" value="<?= htmlspecialchars($row['modele']) ?>" placeholder="Modèle">
<input type="text" name="dateConstruction" value="<?= htmlspecialchars($row['dateConstruction']) ?>" placeholder="Date de Construction">
<input type="text" name="couleur" value="<?= htmlspecialchars($row['couleur']) ?>" placeholder="couleur">
<input type="text" name="prix" value="<?= htmlspecialchars($row['prix']) ?>" placeholder="Prix">
<input type="text" name="nbCheveaux" value="<?= htmlspecialchars($row['nbCheveaux']) ?>" placeholder="Nombre de Chevaux">
<input type="submit" value="Modifier" name="send">
<a class="link back" href="../vue/classement.php">Annuler</a>
</form>
</body> 
</html>
