<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: form_login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="dashboard_style.css">
</head>

<body>
  <header>
    <h1>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>! 🎀</h1>
    <a href="logout.php" class="logout-btn">Logout</a>
  </header>

  <main class="dashboard-content">
    <div class="card">
      <h2>Your Diary</h2>
      <p>This is your safe space. Feel free to write down your thoughts 📝💖</p>
      <a href="form_diary.php" class="btn">Create New Entry</a>
    </div>

    <div class="card">
      <h2>My Mood</h2>
      <p>How are you feeling today? 🌈</p>
      <a href="#" class="btn">Update Mood</a>
    </div>
  </main>

  <br>

  <main class="dashboard-content">
    <div class="calendar-card">
      <h3 id="monthYear"></h3>
      <div class="calendar" id="calendar"></div>
    </div>
    <script>
      const date = new Date();
      const monthYear = document.getElementById("monthYear");
      const options = { month: "long", year: "numeric" };
      const formattedDate = date.toLocaleDateString("en-US", options);
      monthYear.textContent = formattedDate;

      const calendar = document.getElementById("calendar");
      const month = date.getMonth();
      const year = date.getFullYear();

      const daysInMonth = new Date(year, month + 1, 0).getDate();
      const firstDay = new Date(year, month, 1).getDay();

      const dayNames = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
      dayNames.forEach(day => {
        const dayDiv = document.createElement("div");
        dayDiv.classList.add("day-name");
        dayDiv.textContent = day;
        calendar.appendChild(dayDiv);
      });

      for (let i = 0; i < firstDay; i++) {
        const emptyDiv = document.createElement("div");
        calendar.appendChild(emptyDiv);
      }

      for (let i = 1; i <= daysInMonth; i++) {
        const dayDiv = document.createElement("div");
        dayDiv.textContent = i;

        if (i === date.getDate()) {
          dayDiv.classList.add("today");
        }

        calendar.appendChild(dayDiv);
      }
    </script>
  </main>

  <br>

  <main class="dashboard-content">
    <div class="card">
      <h2>History Check</h2>
      <p>Let's check what you already write! 📖</p>
      <a href="history_diary.php" class="btn">Check</a>
    </div>
  </main>

</body>

</html>