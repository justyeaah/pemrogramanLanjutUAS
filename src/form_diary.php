<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST['title'];
  $write = $_POST['write'];
  $date = date('Y-m-d');
  $user_id = $_SESSION['user_id'];

  $query = "INSERT INTO \"diary\" (\"title\", \"write\", \"date\", \"user_id\") 
            VALUES ('$title', '$write', '$date', '$user_id')";

  $result = pg_query($connect, $query);

  if ($result) {
    echo "<script>alert('Diary saved!'); window.location.href='dashboard.php';</script>";
  } else {
    echo "Error: " . pg_last_error($connect);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Write Diary</title>
  <link rel="stylesheet" href="writeDiary_style.css" />
</head>

<body>

  <header>
    <h1>Write Your Diary</h1>
    <a href="dashboard.php" class="back-btn">Back</a>
  </header>

  <div class="diary-content">
    <form method="POST" action="" class="diary-form">
      <label for="title">Title</label>
      <input type="text" id="title" name="title" required>

      <label for="write">Dear Diary</label>
      <textarea id="write" name="write" rows="10" required></textarea>

      <button type="submit" class="save-btn">Save Diary</button>
    </form>
  </div>

</body>

</html>