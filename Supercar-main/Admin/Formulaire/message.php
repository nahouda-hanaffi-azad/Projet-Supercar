<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages Client</title>
    <link rel="stylesheet" href="style2.css">


</head>
<body>

    <main>

        <table>
            <thead>
            <?php
            include_once "../connect_ddb.php";
            //liste des utilisateurs
            $sql= "SELECT * FROM contact";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result)>0){
                //afficher les utilisateurs
            
            ?>
                <tr>
                    <th>Identifiant</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Adresse</th>
                    <th>Télephone</th>
					<th>Email</th>
                    <th>Commentaire</th>
                </tr>
            </thead>
            <tbody>
            <?php
                while($row= mysqli_fetch_assoc($result)){

            ?>    
                <tr>
                    <td><?=$row['idcontact']?></td>
                    <td><?=$row['nom']?></td>
                    <td><?=$row['prenom']?></td>
                    <td><?=$row['adresse']?></td>
                    <td><?=$row['telephone']?></td>
                    <td><?=$row['email']?></td>
					<td><?=$row['commentaires']?></td>
                </tr>

                <?php
                }
            }
            else{
                echo " <p class='message'>0 utilisateur présent !</p>";
            }
                ?>
            </tbody>
        </table>
    </main>
    
</body>
</html>