
<?php

$idVoiture = $_GET['id'];
include_once "../modele/connect_ddb.php";
$sql = "DELETE FROM voiture where idVoiture = $idVoiture "; 

if (mysqli_query($conn, $sql)) {
    header("location: ../vue/classement.php?message=DeleteSuccess");
}else {
    header("location: ../vue/classement.php?message=DeleteFail");
}

?>