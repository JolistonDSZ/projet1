<?php
require_once "../modele/connect_ddb.php";
session_start();

// Vérifier si les informations ont été envoyées via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Vérification de la présence des champs de formulaire
    if (isset($_POST['email'], $_POST['mdp'])) {
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];

        // Vérifier si l'email et le mot de passe ne sont pas vides
        if (!empty($email) && !empty($mdp)) {

            // Connexion à la base de données
            $db = connexionPDO();

            // Préparer la requête pour récupérer l'utilisateur avec l'email
            $query = $db->prepare("SELECT * FROM client WHERE email = ?");
            $query->execute([$email]);
            $user = $query->fetch(PDO::FETCH_ASSOC);

            // Vérifier si l'utilisateur existe et si le mot de passe est correct
            if ($user && password_verify($mdp, $user['mdp'])) {
                // Si la connexion est réussie, stocker les informations dans la session
                $_SESSION['user_id'] = $user['id']; // Il est plus sécurisé de stocker uniquement l'ID de l'utilisateur

                // Rediriger vers le tableau de bord
                header("Location: ../vue/dashboard.php");
                exit();
            } else {
                // Si l'email ou le mot de passe est incorrect
                echo "Email ou mot de passe incorrect.";
            }

        } else {
            // Si les champs email ou mot de passe sont vides
            echo "Veuillez remplir tous les champs.";
        }

    } else {
        // Si les champs email ou mdp n'existent pas
        echo "Les champs email et mot de passe sont requis.";
    }
}
?>
