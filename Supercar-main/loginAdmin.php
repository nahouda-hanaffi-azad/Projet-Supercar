<!DOCTYPE html>
<html lang=fr>
<head>
	<title> La page L.O.G.I.N </title>
</head>
<body>

<?php
include("connexion.php");

$nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";

$requete = "SELECT username, pwd FROM login WHERE username='$nom' AND pwd='$password'";
$curseur = mysqli_query($bdd, $requete);

$row = mysqli_num_rows($curseur);

if ($row == 1) {
    header("location: index.php");
    exit();
} else {
    echo "NOM UTILISATEUR ou/et MOT DE PASSE non-trouvé(s)";
    echo "<br /><br />";
    echo "<a href=\"adminConnect.php\">Retour à l'authentification</a>";
}

mysqli_free_result($curseur);
mysqli_close($bdd);
?>



</body>
</html>