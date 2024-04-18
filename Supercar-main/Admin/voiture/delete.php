<?php
   //supprimer la photo
   //Récupérer l'ID dans le lien avec la methode GET
   $id = $_GET['id'];
   //inclure la page de connexion
   include_once "../connect_ddb.php";
   //supprimer la photo qui a pour id $id
   $req = mysqli_query($conn , "DELETE FROM voitures WHERE id = $id");
   // Supprimer la ligne correspondante de la table "model"
   $sql2 = "DELETE FROM model WHERE id_voiture = $id";
   $conn->query($sql2);
   //redirection vers la page liste.php
   header("location:liste.php");

?>