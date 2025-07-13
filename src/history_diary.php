<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login first!'); window.location.href='form_login.php';</script>";
    exit();
}

$iduser = $_SESSION['user_id'];

$query = "SELECT * FROM \"diary\" WHERE \"iduser\" = '$iduser' ORDER BY \"date\" DESC";
$result = pg_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Diary History</title>
    <link rel="stylesheet" href="history_style.css">
</head>

<body>
    <header>
        <h1>My Diary History</h1>
        <a href="dashboard.php" class="back-btn">Back to Dashboard</a>
    </header>

    <main class="history-content">
        <?php if (pg_num_rows($result) > 0): ?>
            <?php while ($row = pg_fetch_assoc($result)): ?>
                <div class="diary-entry">
                    <h2><?= htmlspecialchars($row['title']) ?></h2>
                    <p class="date"><?= htmlspecialchars($row['date']) ?></p>
                    <a href="view_diary.php?id=<?= $row['iddiary'] ?>" class="btn">Read More</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No diary entries yet. Write something today!</p>
        <?php endif; ?>
    </main>
</body>

</html>