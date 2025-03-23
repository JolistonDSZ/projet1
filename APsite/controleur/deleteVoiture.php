<?php

// Vérifiez si l'ID est présent dans l'URL
if (isset($_GET['id'])) {
    $idVoiture = $_GET['id'];
} else {
    // Redirection ou gestion d'erreur si l'ID n'est pas fourni
    header("location: ../vue/classement.php?message=NoID");
    exit;
}

// Inclure la connexion à la base de données (connexionPDO est définie dans votre modèle)
require_once "../modele/connect_ddb.php";

// Établir la connexion à la base de données avec PDO
$conn = connexionPDO();

// Préparer la requête de suppression
$sql = "DELETE FROM voiture WHERE idVoiture = :idVoiture"; // Utilisation d'un paramètre pour éviter les injections SQL

// Préparer la requête PDO
$stmt = $conn->prepare($sql);
$stmt->bindParam(':idVoiture', $idVoiture, PDO::PARAM_INT); // Lier le paramètre de manière sécurisée

// Exécuter la requête
if ($stmt->execute()) {
    header("location: ../vue/classement.php?message=DeleteSuccess");
} else {
    header("location: ../vue/classement.php?message=DeleteFail");
}
?>
