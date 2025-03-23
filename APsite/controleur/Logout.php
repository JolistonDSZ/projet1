<?php
session_start();
session_destroy();
header("Location: ../controleur/connexion.php");
exit();
?>
