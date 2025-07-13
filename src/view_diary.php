<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
  echo "<script>alert('Please login first!'); window.location.href='form_login.php';</script>";
  exit();
}

if (!isset($_GET['id'])) {
  echo "<script>alert('No diary ID specified!'); window.location.href='history_diary.php';</script>";
  exit();
}

$iddi = $_GET['id'];
$iduser = $_SESSION['user_id'];

$query = "SELECT * FROM \"diary\" WHERE \"iddiary\" = '$iddi' AND \"iduser\" = '$iduser'";
$result = pg_query($connect, $query);

if (pg_num_rows($result) == 0) {
  echo "<script>alert('Diary not found!'); window.location.href='history_diary.php';</script>";
  exit();
}

$row = pg_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="history_style.css">
  <title><?= htmlspecialchars($row['title']) ?></title>
</head>
<body>
  <header>
    <h1>Diary Detail</h1>
    <a href="history_diary.php" class="back-btn">Back to History</a>
  </header>

  <main class="history-content">
  <div class="diary-entry">
  <h2><?= htmlspecialchars($row['title']) ?></h2>  
  <p class="date"><?= htmlspecialchars($row['date']) ?></p>
    <div class="full-content">
      <?= nl2br(htmlspecialchars($row['write'])) ?>
    </div>
    </div>
  </main>
</body>
</html>
