<?php
session_start();
include __DIR__ . '/connect.php';

$username = $_POST['username'];
$password = $_POST['password'];

if ($username == "" || $password == "") {
    echo "<script>alert('Username atau password kosong');location.href='form_login.php';</script>";
} else {

    $query = "SELECT * FROM \"user\" WHERE username = '$username'";
    $result = pg_query($connect, $query);

    if (pg_num_rows($result) > 0) {
        $data = pg_fetch_assoc($result);

        if (password_verify($password, $data['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $data['iduser'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Password salah!');location.href='form_login.php';</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!');location.href='form_login.php';</script>";
    }
}
?>
