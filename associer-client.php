<?php
include "db.php";

$createTable = "
CREATE TABLE IF NOT EXISTS client_application (
    id SERIAL PRIMARY KEY,
    clienum INT NOT NULL,
    appnum INT NOT NULL,
    FOREIGN KEY (clienum) REFERENCES clients(clienum),
    FOREIGN KEY (appnum) REFERENCES applications(appnum)
)";
pg_query($conn, $createTable);

if (!empty($_POST)) {
    $client = intval($_POST["client"]);
    $app = intval($_POST["app"]);

    if ($client > 0 && $app > 0) {
        $sql = "INSERT INTO client_application (clienum, appnum)
                VALUES ($client, $app)";
        $res = pg_query($conn, $sql);

        if ($res) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Erreur lors de l'association.";
        }
    } else {
        $error = "Veuillez sélectionner un client et un établissement.";
    }
}

$clients = pg_query($conn, "SELECT clienum, clienom, clieprenom FROM clients WHERE cliesupp = 2 ORDER BY clienom ASC");
$apps = pg_query($conn, "SELECT appnum, appnometablissement FROM applications ORDER BY appnometablissement ASC");

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Haingo consulting | Association</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <br><br><br>
    <main class="container">
        <a href="index.php"> Accueil</a>
        |
        <a href="ajouter-client.php"> Ajouter un client</a>
        |
        <a href="ajouter-application.php"> Ajouter un etablissement</a>
        <hr>
        <h2>Associer client ↔ établissement</h2>


        <?php if (!empty($error)) : ?>
            <article class="error"><?= $error ?></article>
        <?php endif; ?>

        <form method="POST">

            <label>Client</label>
            <select name="client" required>
                <option value="">-- Sélectionner un client --</option>
                <?php while ($c = pg_fetch_assoc($clients)) : ?>
                    <option value="<?= $c['clienum'] ?>">
                        <?= htmlspecialchars($c['clienom'] . " " . $c['clieprenom']) ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label>Établissement</label>
            <select name="app" required>
                <option value="">-- Sélectionner un établissement --</option>
                <?php while ($a = pg_fetch_assoc($apps)) : ?>
                    <option value="<?= $a['appnum'] ?>">
                        <?= htmlspecialchars($a['appnometablissement']) ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <button type="submit">Associer</button>
        </form>
    </main>
</body>

</html>