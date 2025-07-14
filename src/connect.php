<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
if (file_exists(__DIR__ . '/../.env')) {
    $dotenv->load();
}

$databaseUrl = getenv("DATABASE_URL");
if ($databaseUrl) {
    $url = parse_url($databaseUrl);
    $host = $url["host"];
    $port = $url["port"];
    $user = $url["user"];
    $pass = $url["pass"];
    $db = ltrim($url["path"], "/");

    $connect = pg_connect("host=$host port=$port dbname=$db user=$user password=$pass");
} else {
    die("DATABASE_URL not set");
}

if (!$connect) {
    die("Koneksi gagal: " . pg_last_error());
}
?>
