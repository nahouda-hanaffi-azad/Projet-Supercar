<?php
    $host="localhost";
    $username="root";
    $password="";
    $dbname="supercar";

    //Créer une connexion
    $conn = mysqli_connect($host, $username, $password, $dbname);

    //Vérifier la connexion
    if(!$conn){
        die("Connexion échouée: ".mysqli_connect_error());
    }
    ?>