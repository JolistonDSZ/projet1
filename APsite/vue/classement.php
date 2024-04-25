<!DOCTYPE html>
<html lang="fr"> 
<head>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<title>Liste des Voitures</title>
<link rel="stylesheet" href="../crud.css">

</head>
<body>
<header>
        <!-- menu  -->
        
        <div class="logo">
            <p>Pegasus</p>
        </div>
        <ul class="menu">
            <li><a href="../vue/index.html">ACCUEIL</a></li>
            <li><a href="../vue/index.html#cars">CATALOGUE</a></li>
            <li><a href="../vue/index.html#services">SERVICES</a></li>
            <li><a href="../vue/index.html#contact">CONTACT</a></li>
        </ul>
       <button class="login_btn" onclick="window.location.href='../vue/inscrire.php'">S'INSCRIRE</button>
       <button class="login_btn" onclick="window.location.href='../vue/connexion.php'">CONNEXION</button>




    </header>
<main>
<div class="link_container">
<a class="link" href="../controleur/addVoiture.php">Ajouter une voiture</a>
</div>
<table>
<thead>

    <?php
    include_once "../modele/connect_ddb.php"; 
    //liste des utilisateurs
    $sql = "SELECT * FROM voiture"; 
    $result = mysqli_query($conn, $sql); 
    if (mysqli_num_rows($result) > 0){ 
        // afficher les utilisateurs
    ?>

    <tr>
<th>marque</th> 
<th>modele</th>
<th>dateConstruction</th>
<th>couleur</th>
<th>prix</th>
<th>nbCheveaux</th>
<th>modifier</th>
<th>supprimer</th>
</tr>
</thead>
<tbody>

<?php
    while($row = mysqli_fetch_assoc($result)){
?>

    <tr>
        <td><?=$row['marque']?></td>
        <td><?=$row['modele']?></td>
        <td><?=$row['dateConstruction']?></td>
        <td><?=$row['couleur']?></td>
        <td><?=$row['prix']?></td>
        <td><?=$row['nbCheveaux']?></td>
        <td class="image"><a href="../controleur/modifyVoiture.php?id=<?=$row['idVoiture']?>"><img src="../images/write.png" alt=""></a></td>
        <td class="image"><a href="../controleur/deleteVoiture.php?id=<?=$row['idVoiture']?>"><img src="../images/remove.png" alt=""></a></td>

    <?php
        }
    } else {
        echo " <p class'message'> 0 voiture présente!</p>";
    }
    ?>


    </tr>
</tbody>
</table>
</main>
</body>
</html>