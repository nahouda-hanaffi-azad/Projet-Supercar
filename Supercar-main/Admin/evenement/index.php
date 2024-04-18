<?php 
    // Inclure la page de connexion
    include_once "../connect_ddb.php";
    
    // Vérifier que les données sont envoyées
    if(isset($_POST['send'])){
        
        // Vérifier que les champs nécessaires sont présents et non vides
        if(isset($_POST['nom'], $_POST['dates'], $_POST['description'], $_FILES['image']) &&
           $_POST['nom'] != "" && $_POST['dates'] != "" && $_POST['description'] != "" && !empty($_FILES['image'])) {
            
            // On récupère d'abord le nom de l'image
            $img_nom = $_FILES['image']['name'];

            // Nous définissons un nom temporaire
            $tmp_nom = $_FILES['image']['tmp_name'];

            // On récupère l'heure actuelle
            $time = time();

            // On renomme l'image en utilisant cette formule : heure + nom de l'image (Pour avoir des images uniques)
            $nouveau_nom_img = $time.$img_nom ;

            // On déplace l'image dans un dossier appelé "image_bdd"
            $deplacer_img = move_uploaded_file($tmp_nom,"image_bdd/".$nouveau_nom_img);

            if($deplacer_img){
                // Si l'image a été mise dans le dossier 
                // Insérons le nom de l'image, ainsi que les autres champs dans la base de données
                $nom = $_POST['nom'];
                $dates = $_POST['dates'];
                $description = $_POST['description'];
                
                $sql = "INSERT INTO evenements (nom, dates, description, photo) VALUES ('$nom', '$dates', '$description', '$nouveau_nom_img')";
                
                $req = mysqli_query($conn , $sql);
                
                // Vérifier que la requête fonctionne
                if($req){
                    // Si oui, faire une redirection vers la page liste.php
                    header("location:liste.php") ;
                } else {
                    // Si non
                    $message = "Echec de l'ajout de l'image !";
                }
            } else {
                // Si non
                $message = "Veuillez choisir une image avec une taille inférieure à 1Mo !";
            }

        } else {
            // Si les champs sont vides ou non présents, afficher un message
            $message = "Veuillez remplir tous les champs !";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini CRUD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="liste.php" class="link">Liste des photos</a>
    <p class="error">
        <?php 
           // Afficher une erreur si la variable message existe
           if(isset($message)) echo $message ;
        ?>
    </p>
    <form action="" method="POST" enctype="multipart/form-data"> 
        <label>Nom</label>
        <input type="text" name="nom" required>
        <label>Date</label>
        <input type="date" name="dates" required>
        <label>Description</label>
        <textarea name="description" cols="30" rows="10" required></textarea>
        <label>Ajouter une photo</label>
        <input type="file" name="image">
        <input type="submit" value="Ajouter" name="send">
    </form>
</body>
</html>
