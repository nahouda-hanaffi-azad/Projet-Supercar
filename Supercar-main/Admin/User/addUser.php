<?php
    if(isset($_POST['send'])){
        if(isset($_POST['username']) &&
            isset($_POST['pwd']) &&
            isset($_POST['nom']) &&
            $_POST['username'] != "" &&
            $_POST['pwd'] != "" &&
            $_POST['nom'] != ""
            ){
            include_once "../connect_ddb.php";
            extract($_POST);
            $sql = "INSERT INTO login (username, pwd, nom) VALUES ('$username', '$pwd', '$nom')";
            if (mysqli_query($conn,$sql)){
                header("location:showUser.php");
            }else {
                header("location:addUser.php?message=AddFail");
            }
        }else {
                header("location:addUser.php?message=EmptyFields");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un utilisateur</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <form action="" method="post">
        <h1>Ajouter un utilisateur</h1>
        <input type="text" name="username" placeholder="Identifiant">
        <input type="text" name="pwd" placeholder="Mot de passe">
        <input type="text" name="nom" placeholder="Nom">
        <input type="submit" value="Ajouter" name="send">
        <a class="link back" href="showUser.php">Annuler</a>
    </form>
</body>
</html>