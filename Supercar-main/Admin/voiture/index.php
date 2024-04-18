<?php 
    // Inclure la page de connexion
    include_once "../connect_ddb.php";
    session_start();

    // Vérifier que les données sont envoyées
    if(isset($_POST['send'])){
        
        // Vérifier que les champs nécessaires sont présents et non vides
        if(isset($_POST['libeleModel'], $_POST['libeleMarque'], $_POST['annee'], $_POST['transmission'], $_POST['motorisation'], $_POST['description']) && !empty($_FILES['image'])) {
            
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
                $libeleModel = $_POST['libeleModel'];
                $libeleMarque = $_POST['libeleMarque'];
                $annee = $_POST['annee'];
                $transmission = $_POST['transmission'];
                $motorisation = $_POST['motorisation'];
                $description = $_POST['description'];
                
                // Requête d'insertion dans la table voitures avec l'ID du modèle
                $sql2 = "INSERT INTO voitures (annee, transmission, motorisation, car_photo, description) VALUES (?, ?, ?, ?, ?)";
                $stmt2 = mysqli_prepare($conn, $sql2);
                mysqli_stmt_bind_param($stmt2, "issss", $annee, $transmission, $motorisation, $nouveau_nom_img, $description);
                $req2 = mysqli_stmt_execute($stmt2);

                // Récupérer l'ID de la voiture insérée
                $lastCarId = mysqli_insert_id($conn);

                // Requête d'insertion dans la table model avec l'ID de la voiture
                $sql = "INSERT INTO model (libeleModel, libeleMarque, id_voiture) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "ssi", $libeleModel, $libeleMarque, $lastCarId);
                $req = mysqli_stmt_execute($stmt);

                
                // Vérifier que les requêtes ont fonctionné
                if($req && $req2){
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
        <label>Choisissez une marque :</label>
        <select name="libeleMarque">
        <?php
            // Exécuter la requête pour récupérer toutes les marques
            $resultat = mysqli_query($conn, "SELECT libeleMarque FROM marque");

            // Parcourir les résultats et créer des options pour la liste déroulante
            while ($row = mysqli_fetch_assoc($resultat)) {
                echo "<option>" . $row['libeleMarque'] . "</option>";
            }
        ?>
        </select>
        <label>Modèle :</label>
        <input type="text" name="libeleModel" required>
        <label>Année :</label>
        <input type="number" name="annee" required>
        <label>Transmission :</label>
        <select name="transmission" required>
        <option value="Automatique">Automatique</option>
        <option value="Manuelle">Manuelle</option>
        </select> <br>
        <label>Motorisation :</label>
        <select name="motorisation" required>
        <option value="Essence">Essence</option>
        <option value="Diesel">Diesel</option>
        <option value="Hybride">Hybride</option>
        </select><br>
        <label>Description</label>
        <textarea name="description" cols="30" rows="10" required></textarea>
        <label>Ajouter une photo</label>
        <input type="file" name="image">
        <input type="submit" value="Ajouter" name="send">
    </form>
</body>
</html>
