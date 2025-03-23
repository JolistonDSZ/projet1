<?php
session_start();  // Démarre la session

// Détruire toutes les variables de session
session_unset();

// Détruire la session
session_destroy();

// Redirige vers la page d'accueil (index.php)
header('Location: ../vue/index.php');
exit();
?>
