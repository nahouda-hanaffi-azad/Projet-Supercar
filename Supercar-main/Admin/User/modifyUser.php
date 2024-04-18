<?php
    include_once "../connect_ddb.php";
    $user_id= $_GET['id'];
        if(isset($_POST['send'])){
            if(isset($_POST['username'])&&
            isset($_POST['pwd'])&&
            isset($_POST['nom']) &&
            $_POST['username'] != ""&&
            $_POST['pwd'] != "" &&
            $_POST['nom'] != ""
            ){

                extract($_POST);

                $sql = "UPDATE login SET username = '$username' , pwd= '$pwd' , nom= '$nom' WHERE Id_login= $user_id ";
            
                if (mysqli_query($conn, $sql)){
                    header("location:showUser.php");
                }else{
                    header("location:showUser.php?message=ModifyFail");
                }
            } else{
                header("location:showUser.php?message=EmptyFields");
            }
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un utilisateur</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php
        include_once "../connect_ddb.php";

        //liste des infos de l'tilisateur
        $sql = "SELECT * FROM login WHERE Id_login = $user_id";
        $result = mysqli_query($conn, $sql);
        // affiche donnée de l'utilisateur
        while($row = mysqli_fetch_assoc($result)){
    ?>



<form action="" method="post">
        <h1>Modifier urilisateur</h1>
        <input type="text" name="username" value="<?=$row['username']?>" placeholder="Identifiant">
        <input type="text" name="pwd" value="<?=$row['pwd']?>" placeholder="Mot de passe">
        <input type="text" name="nom" value="<?=$row['nom']?>" placeholder="Nom">
        <input type="submit" value="Modifier" name="send">
        <a class="link back" href="showUser.php">Annuler</a>
    </form>
    <?php
    }
    ?>
</body>
</html>