<?php

$host = "postgres";
$db = "postgres";
$username = "postgres";
$pass = "12345";

$connect = pg_connect("host=$host dbname=$db user=$username password=$pass");

if (!$connect) {
    die("Koneksi gagal: " . pg_last_error());
}
?>