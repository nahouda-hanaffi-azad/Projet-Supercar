<?php
   //supprimer la photo
   //Récupérer l'ID dans le lien avec la methode GET
   $id = $_GET['id'];
   //inclure la page de connexion
   include_once "../connect_ddb.php";
   //supprimer la photo qui a pour id $id
   $req = mysqli_query($conn , "DELETE FROM evenements WHERE id = $id");
   //redirection vers la page liste.php
   header("location:liste.php");

?>