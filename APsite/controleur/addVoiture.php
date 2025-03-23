<?php
if (isset($_POST['send'])) {
    if (!empty($_POST['marque']) && !empty($_POST['modele']) && !empty($_POST['dateConstruction']) && !empty($_POST['couleur']) && !empty($_POST['prix']) && !empty($_POST['nbCheveaux'])) {
        // Inclure la connexion PDO
        include_once "../modele/connect_ddb.php";

        // Connexion à la base de données avec PDO
        $conn = connexionPDO();

        // Préparer les données
        $marque = $_POST['marque'];
        $modele = $_POST['modele'];
        $dateConstruction = $_POST['dateConstruction'];
        $couleur = $_POST['couleur'];
        $prix = $_POST['prix'];
        $nbCheveaux = $_POST['nbCheveaux'];

        // Vérifiez si des données existent déjà pour la voiture
        $stmt = $conn->prepare("SELECT * FROM voiture WHERE marque = :marque AND modele = :modele");
        $stmt->bindParam(':marque', $marque);
        $stmt->bindParam(':modele', $modele);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Si des données existent, effectuez une mise à jour
            $updateQuery = "UPDATE voiture SET dateConstruction = :dateConstruction, couleur = :couleur, prix = :prix, nbCheveaux = :nbCheveaux WHERE marque = :marque AND modele = :modele";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bindParam(':marque', $marque);
            $updateStmt->bindParam(':modele', $modele);
            $updateStmt->bindParam(':dateConstruction', $dateConstruction);
            $updateStmt->bindParam(':couleur', $couleur);
            $updateStmt->bindParam(':prix', $prix);
            $updateStmt->bindParam(':nbCheveaux', $nbCheveaux);

            if ($updateStmt->execute()) {
                header("Location: ../vue/classement.php");
                exit();
            } else {
                header("Location: addVoiture.php?message=UpdateFail");
                exit();
            }
        } else {
            // Si aucune donnée n'existe, insérez une nouvelle voiture
            $insertQuery = "INSERT INTO voiture (marque, modele, dateConstruction, couleur, prix, nbCheveaux) 
                            VALUES (:marque, :modele, :dateConstruction, :couleur, :prix, :nbCheveaux)";
            $insertStmt = $conn->prepare($insertQuery);
            $insertStmt->bindParam(':marque', $marque);
            $insertStmt->bindParam(':modele', $modele);
            $insertStmt->bindParam(':dateConstruction', $dateConstruction);
            $insertStmt->bindParam(':couleur', $couleur);
            $insertStmt->bindParam(':prix', $prix);
            $insertStmt->bindParam(':nbCheveaux', $nbCheveaux);

            if ($insertStmt->execute()) {
                header("Location: ../vue/classement.php");
                exit();
            } else {
                header("Location: addVoiture.php?message=AddFail");
                exit();
            }
        }

        // Fermer la connexion PDO (bien que PDO se ferme automatiquement à la fin du script)
        $conn = null;
    } else {
        header("Location: addVoiture.php?message=EmptyFields");
        exit();
    }
}
?>




