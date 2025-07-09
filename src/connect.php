<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$databaseUrl = getenv("DATABASE_URL");

if ($databaseUrl) {
    $connect = pg_connect($databaseUrl);
} else {
    $host = "localhost";
    $db = "postgres";
    $username = "postgres";
    $pass = "12345";

    $connect = pg_connect("host=$host dbname=$db user=$username password=$pass");
}

// Cek koneksi
if (!$connect) {
    die("Koneksi gagal: " . pg_last_error());
}
?>
