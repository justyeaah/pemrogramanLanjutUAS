<?php
include 'connect.php';
session_start();

// Jalankan hanya kalau form dikirim (method POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Validasi input kosong
    if ($username === '' || $password === '') {
        echo "<script>alert('Username dan Password tidak boleh kosong!'); window.location.href='form_buatAkun.php';</script>";
        exit();
    }

    // Cek username sudah ada
    $checkQuery = "SELECT * FROM \"user\" WHERE username = '$username'";
    $checkResult = pg_query($connect, $checkQuery);

    if (pg_num_rows($checkResult) > 0) {
        echo "<script>alert('Username ini telah digunakan!'); window.location.href='form_buatAkun.php';</script>";
        exit();
    }

    // Buat ID baru manual
    $idResult = pg_query($connect, "SELECT iduser FROM \"user\" ORDER BY iduser DESC LIMIT 1");
    $lastId = pg_fetch_assoc($idResult)['iduser'] ?? 'U000';
    $lastNumber = intval(substr($lastId, 3));
    $newNumber = $lastNumber + 1;
    $newId = 'U' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

    // Simpan user baru
    $insertQuery = "INSERT INTO \"user\" (iduser, username, password) VALUES ('$newId', '$username', '$password')";
    $insertResult = pg_query($connect, $insertQuery);

    if ($insertResult) {
        echo "<script>alert('Akun berhasil dibuat! Silakan login.'); window.location.href='form_login.php';</script>";
        exit();
    } else {
        echo "Error: " . pg_last_error($connect);
    }
}
?>