<?php
include "db.php";

if (!empty($_POST)) {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $tel = $_POST["tel"];
    $mail = $_POST["mail"];

    $sql = "INSERT INTO clients (clienom, clieprenom, clietel1, clieadresmail, cliesupp)
            VALUES ('$nom', '$prenom', '$tel', '$mail', 2)";
    pg_query($conn, $sql);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Haingo consulting | Associer client</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main class="container">
        <h2>Ajouter un client</h2>
        <form method="POST">
            <label>Nom :
                <input type="text" name="nom" required>
            </label>

            <label>Prénom :
                <input type="text" name="prenom" required>
            </label>

            <label>Téléphone :
                <input type="text" name="tel" required>
            </label>

            <label>Email :
                <input type="email" name="mail" required>
            </label>

            <button type="submit">Enregistrer</button>
        </form>
    </main>
</body>

</html>