<?php include "db.php"; ?>

<?php
if (!empty($_POST)) {
    $clienum = $_POST["clienum"];
    $appnum = $_POST["appnum"];

    $sql = "INSERT INTO clients_applications (clienum, appnum)
            VALUES ($clienum, $appnum)";
    pg_query($conn, $sql);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Haingo consulting | Add client</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <br><br><br>
    <main class="container">
        <h2>Associer un Client à un Établissement</h2>

        <form method="POST">

            <label>Client :
                <select name="clienum" required>
                    <option value="">Choisir…</option>
                    <?php
                    $res = pg_query($conn, "SELECT * FROM clients WHERE cliesupp = 2");
                    while ($c = pg_fetch_assoc($res)):
                    ?>
                        <option value="<?= $c['clienum'] ?>"><?= $c['clienom'] ?> <?= $c['clieprenom'] ?></option>
                    <?php endwhile; ?>
                </select>
            </label>

            <label>Établissement :
                <select name="appnum" required>
                    <option value="">Choisir…</option>
                    <?php
                    $apps = pg_query($conn, "SELECT * FROM application");
                    while ($a = pg_fetch_assoc($apps)):
                    ?>
                        <option value="<?= $a['appnum'] ?>">
                            <?= $a['appnom'] ?> (<?= $a['appnometablissement'] ?>)
                        </option>
                    <?php endwhile; ?>
                </select>
            </label>

            <button type="submit">Associer</button>
        </form>

    </main>

</body>

</html>