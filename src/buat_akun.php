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

    // HASH password biar aman!
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Simpan user baru (Postgres auto increment iduser)
    $insertQuery = "INSERT INTO \"user\" (username, password) VALUES ('$username', '$hash')";
    $insertResult = pg_query($connect, $insertQuery);

    if ($insertResult) {
        echo "<script>alert('Akun berhasil dibuat! Silakan login.'); window.location.href='form_login.php';</script>";
        exit();
    } else {
        echo "Error: " . pg_last_error($connect);
    }
}
?>
