<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste photos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section>
        <a href="index.php" class="link">Ajouter une photo</a>
        <?php
            // Inclure la page de connexion
            include_once "../connect_ddb.php";

            // Afficher la liste des photos qui sont dans la base de données
            $req = mysqli_query($conn, "SELECT voitures.*, model.libeleModel, model.libeleMarque FROM voitures JOIN model ON voitures.id = model.id_voiture");
            
            // Vérifier que la liste n'est pas vide
            if(mysqli_num_rows($req) < 1){
                ?>
                <p class="vide_message">La liste des photos est vide.</p>
                <?php
            }

            // Afficher la liste des photos
            while($row = mysqli_fetch_assoc($req)){
                ?>         
                    <div class="box">
                        <img  class="img_principal" src="image_bdd/<?=$row['car_photo']?>">
                        <!-- Utilisation de la colonne 'libeleModel' récupérée de la table 'model' -->
                        <div>Marque : <?=$row['libeleMarque']?></div>
                        <!-- Utilisation de la colonne 'libeleMarque' récupérée de la table 'model' -->
                        <div>Modèle : <?=$row['libeleModel']?></div>
                        <!-- Ajouter le texte si nécessaire -->
                        <a class="delete_btn" href="delete.php?id=<?=$row['id']?>">
                            <img src="remove.png">
                        </a>
                    </div>
                <?php
            }
        ?>
    </section>
</body>
</html>
