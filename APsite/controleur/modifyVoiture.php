<?php
// Inclure le fichier de connexion PDO
include_once "../modele/connect_ddb.php"; // Cela inclut la fonction de connexion

// Vérifie si l'idVoiture est passé dans l'URL
if (isset($_GET['id'])) {
    $idVoiture = $_GET['id'];
} else {
    // Redirige si l'ID n'est pas fourni
    header("location: classement.php?message=NoID");
    exit;
}

// Obtenir la connexion PDO
$conn = connexionPDO(); // Utilisation de la fonction définie dans connect_ddb.php

if (isset($_POST['send'])) {
    // Vérifie que tous les champs du formulaire sont remplis
    if (!empty($_POST['marque']) && !empty($_POST['modele']) && !empty($_POST['dateConstruction']) && !empty($_POST['couleur']) && !empty($_POST['prix']) && !empty($_POST['nbCheveaux'])) {
        // Utilisation de PDO pour éviter les injections SQL
        $marque = htmlspecialchars($_POST['marque']);
        $modele = htmlspecialchars($_POST['modele']);
        $dateConstruction = htmlspecialchars($_POST['dateConstruction']);
        $couleur = htmlspecialchars($_POST['couleur']);
        $prix = htmlspecialchars($_POST['prix']);
        $nbCheveaux = htmlspecialchars($_POST['nbCheveaux']);

        // Préparation de la requête SQL pour mise à jour
        $sql = "UPDATE voiture SET marque = :marque, modele = :modele, dateConstruction = :dateConstruction, couleur = :couleur, prix = :prix, nbCheveaux = :nbCheveaux WHERE idVoiture = :idVoiture";
        $stmt = $conn->prepare($sql);
        
        // Lier les paramètres
        $stmt->bindParam(':marque', $marque);
        $stmt->bindParam(':modele', $modele);
        $stmt->bindParam(':dateConstruction', $dateConstruction);
        $stmt->bindParam(':couleur', $couleur);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':nbCheveaux', $nbCheveaux);
        $stmt->bindParam(':idVoiture', $idVoiture);

        // Exécuter la requête et vérifier si la mise à jour a réussi
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

// Récupérer les données existantes pour pré-remplir le formulaire
$sql = "SELECT * FROM voiture WHERE idVoiture = :idVoiture";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':idVoiture', $idVoiture);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
