<?php include "db.php"; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Haingo consulting | Accueil</title>
</head>

<body>
    <br><br><br>
    <main class="container">
        <a href="ajouter-client.php">Ajouter un client</a> |
        <a href="ajouter-application.php">Ajouter un établissement</a> |
        <a href="associer-client.php">Associer un client à un établissement</a>

        <hr>

        <h1>Liste des clients</h1>

        <table>
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Établissements</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $res_clients = pg_query($conn, "
                    SELECT clienum, clienom, clieprenom, clietel1, clieadresmail
                    FROM clients
                    WHERE cliesupp = 2
                    ORDER BY clienom ASC
                ");

                while ($c = pg_fetch_assoc($res_clients)) :
                ?>
                    <tr>
                        <td><?= htmlspecialchars($c['clienom'] . ' ' . $c['clieprenom']) ?></td>
                        <td><?= htmlspecialchars($c['clietel1']) ?></td>
                        <td><?= htmlspecialchars($c['clieadresmail']) ?></td>

                        <td>
                            <?php
                            $sql_apps = "
                                SELECT a.appnometablissement, a.appversion
                                FROM client_application ca
                                JOIN applications a ON a.appnum = ca.appnum
                                WHERE ca.clienum = " . intval($c['clienum']);

                            $res_apps = pg_query($conn, $sql_apps);

                            if (pg_num_rows($res_apps) === 0) {
                                echo "<em>Aucun établissement</em>";
                            } else {
                                while ($app = pg_fetch_assoc($res_apps)) {
                                    echo "• <strong>" . htmlspecialchars($app['appnometablissement']) . "</strong>";
                                    echo " (version : " . htmlspecialchars($app['appversion']) . ")<br>";
                                }
                            }
                            ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    </main>

</body>

</html>