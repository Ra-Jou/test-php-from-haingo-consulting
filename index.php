<?php include "db.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Haingo consulting | Accueil</title>
</head>

<body>
    <main class="container">
        <h1>Liste des clients</h1>
        <hr>
        <a href="ajouter-client.php"> Ajouter un client</a>
        |
        <a href="associer-client.php"> Associer un client a etablissement</a>
        <br><br>
        <table>
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Telephone</th>
                    <th>Email</th>
                    <th>Application</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res_clients = pg_query($conn, "SELECT * FROM clients WHERE cliesupp = 2");
                while ($c = pg_fetch_assoc($res_clients)):
                ?>
                    <tr>
                        <td><?= $c['clienom'] . " " . $c['clieprenom']  ?> </td>
                        <td><?= $c['clietel1'] ?> </td>
                        <td><?= $c['clieadresmail'] ?> </td>
                        <td>
                            <?php
                            $sql_apps = "
                                    SELECT a.appnom, a.appnometablissement
                                    FROM applications a
                                    JOIN clients_applications ca ON a.appnum = ca.appnum
                                    WHERE ca.clienum = " . $c['clienum'];
                            $res_apps = pg_query($conn, $sql_apps);
                            while ($app = pg_fetch_assoc($res_apps)) {
                                echo "• <italic>" . $app['appnom'] . "</italic> (" . $app['appnometablissement'] . ")<br>";
                            }

                            ?>
                        </td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </main>
</body>

</html>