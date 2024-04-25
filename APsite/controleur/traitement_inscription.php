<?php
// Inclure le fichier de connexion à la base de données
include_once "../modele/connect_db.php";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs des champs du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    // Hacher le mot de passe avec password_hash
    $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);

    // Utiliser la fonction connexionPDO() pour obtenir une connexion PDO
    $dbConnection = connexionPDO();

    // Vérifier si la connexion à la base de données est établie
    if ($dbConnection) {
        try {
            // Préparer et exécuter la requête d'insertion
            $sql = "INSERT INTO client (prenom, nom, email, mdp) VALUES (:prenom, :nom, :email, :mdp)";
            $stmt = $dbConnection->prepare($sql);
            $stmt->execute([
                'prenom' => $prenom,
                'nom' => $nom,
                'email' => $email,
                'mdp' => $hashedPassword
            ]);

            // Redirection vers index.php après l'inscription réussie
            header("Location: ../vue/index.php");
            exit; // Assurez-vous de terminer le script après la redirection

        } catch (PDOException $e) {
            // En cas d'erreur, afficher un message d'erreur
            echo "Erreur d'inscription : " . $e->getMessage();
        }
    } else {
        // Afficher un message si la connexion à la base de données a échoué
        echo "La connexion à la base de données a échoué.";
    }
}
?>
