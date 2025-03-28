<?php

include_once "connect_ddb.php";

function register($prenom, $nom, $adresse, $numTel, $email, $mdp) {
    $hash = password_hash($mdp, PASSWORD_BCRYPT);
    $query = $this->db->prepare("INSERT INTO client (prenom, nom, adresse, numTel, email, mdp) VALUES (?, ?, ?, ?, ?, ?)");
    return $query->execute([$prenom, $nom, $adresse, $numTel, $email, $hash]);
}

function login($email, $mdp) {
    $query = $this->db->prepare("SELECT * FROM client WHERE email = ?");
    $query->execute([$email]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($mdp, $user['mdp'])) {
        return $user;
    }
    return false;
}

function getUtilisateurs() {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from utilisateur");
        $req->execute();

        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getUtilisateurByMailU($mailU) {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from utilisateur where mailU=:mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->execute();
        
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}
function __construct() {
    $this->db = connexionPDO();
}
function addUtilisateur($mailU, $mdpU, $pseudoU) {
    try {
        $cnx = connexionPDO();

        $mdpUCrypt = crypt($mdpU, "sel");
        $req = $cnx->prepare("insert into utilisateur (mailU, mdpU, pseudoU) values(:mailU,:mdpU,:pseudoU)");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->bindValue(':mdpU', $mdpUCrypt, PDO::PARAM_STR);
        $req->bindValue(':pseudoU', $pseudoU, PDO::PARAM_STR);
        
        $resultat = $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function updtMdpUtilisateur($mailU, $mdpU) {
    $resultat = -1;
    try {
        $cnx = connexionPDO();

        $mdpUCrypt = crypt($mdpU, "sel");
        $req = $cnx->prepare("update utilisateur set mdpU=:mdpU where mailU=:mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->bindValue(':mdpU', $mdpUCrypt, PDO::PARAM_STR);

        $resultat = $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function updtPseudoUtilisateur($mailU, $pseudoU) {
    $resultat = -1;
    try {
        $cnx = connexionPDO();

        $req = $cnx->prepare("update utilisateur set pseudoU=:pseudoU where mailU=:mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->bindValue(':pseudoU', $pseudoU, PDO::PARAM_STR);

        $resultat = $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // prog principal de test
    header('Content-Type:text/plain');

    echo "getUtilisateurs() : \n";
    print_r(getUtilisateurs());

    echo "getUtilisateurByMailU(\"mathieu.capliez@gmail.com\") : \n";
    print_r(getUtilisateurByMailU("mathieu.capliez@gmail.com"));

    echo "addUtilisateur(\"mathieu.capliez3@gmail.com\") : \n";
    addUtilisateur("mathieu.capliez3@gmail.com", "Passe1?", "mat");
}
?>