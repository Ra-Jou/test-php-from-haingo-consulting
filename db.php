<?php

$host = "localhost";
$user = "joary";
$port = "5432";
$pass = "root";
$db = "test-from-haingo-consulting";

$con_string = "host=$host port=$port dbname=$db user=$user password=$pass";
$conn = pg_connect($con_string);

if (! $conn) {
    die("Erreur de connexion: " . pg_last_error());
}
