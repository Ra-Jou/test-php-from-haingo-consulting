<?php
include "db.php";

if (!empty($_POST)) {
    $nom = $_POST["nom"];
    $version = $_POST["version"];
    $etablissement = $_POST["etablissement"];
    $tel = $_POST["tel"];
    $mail = $_POST["mail"];

    $sql = "
        INSERT INTO applications (appnom, appversion, appnometablissement, apptel1, appadresmail)
        VALUES ('$nom', '$version', '$etablissement', '$tel', '$mail')
    ";

    pg_query($conn, $sql);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Haingo consulting | Ajouter établissement</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <br><br><br>
    <main class="container">
        <a href="index.php"> Accueil</a>
        |
        <a href="ajouter-client.php"> Ajouter un client</a>
        |
        <a href="associer-client.php"> Associer un client à un etablissement</a>
        <hr>
        <h2>Ajouter établissement</h2>
        <form method="POST">
            <input name="nom" required placeholder="Nom application">
            <input name="version" required placeholder="Version">
            <input name="etablissement" required placeholder="Nom établissement">
            <input name="tel" required placeholder="Téléphone">
            <input name="mail" required placeholder="Email">
            <button type="submit">Enregistrer</button>
        </form>

    </main>
</body>

</html>