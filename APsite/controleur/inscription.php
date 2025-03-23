<?php
require_once "../modele/connect_ddb.php";
require_once "../modele/bd.utilisateur.inc.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];
    $numTel = $_POST['numTel'];
    $email = $_POST['email'];
    $mdp = password_hash($_POST['mdp'], PASSWORD_BCRYPT);

    $db = connexionPDO(); // ✅ Utilisation correcte de la fonction

    $query = $db->prepare("INSERT INTO client (prenom, nom, adresse, numTel, email, mdp) VALUES (?, ?, ?, ?, ?, ?)");
    
    if ($query->execute([$prenom, $nom, $adresse, $numTel, $email, $mdp])) {
        header("Location: ../vue/vueAuthentification.php");
        exit();
    } else {
        echo "Erreur lors de l'inscription.";
    }
}
?>
