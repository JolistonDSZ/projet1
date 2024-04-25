<?php

function connexionPDO() {
    $login = "root";
    $pass = "";
    $dbname = "pegasus";
    $host = "localhost";

    try {
        $dbConnection = new PDO("mysql:host=$host;dbname=$dbname", $login, $pass); 
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
    } catch (PDOException $e) {
        echo "Erreur de connexion PDO : " . $e->getMessage();
        return null;
    }
}

?>
