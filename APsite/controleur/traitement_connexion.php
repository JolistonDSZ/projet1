<?php
include_once "../modele/connect_db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['mdp']; // Utilisation du bon nom de champ pour le mot de passe

    if ($email != "" && $password != "") {
        // Utilisation de requêtes préparées pour éviter les attaques par injection SQL
        $req = $dbConnection->prepare("SELECT * FROM client WHERE email = :email");
        $req->execute(array('email' => $email));
        $user = $req->fetch();

        if ($user && password_verify($password, $user['mdp'])) { // Vérification du mot de passe haché
            echo "Vous êtes connecté !";
        } else {
            $error_msg = "Email ou mot de passe incorrect !";
        }
    }
}
?>
