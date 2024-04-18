<?php
//définir vos paramètres serveur de connexion avec la base de données
$host="localhost";
// nom utilisateur
$login="root";
// mot de passe
$pass="";
// nom de la base de données
$dbname="supercar";



// établir la connexion avec la base de données
$bdd = mysqli_connect($host, $login, $pass, $dbname);
// vérification de la connexion avec la BD
// if (!$bdd){

// 			echo "Connexion non-reussie à MySQL: " . mysqli_connect_error();
// 	} 
// 	else{
// 			//echo "Connexion reussie à MySQL";
// 			echo '<script>alert("Connexion réussie !")</script>';
// 	}


 
// changer le jeu de caractères à utf8
mysqli_set_charset($bdd, "utf8");
?>