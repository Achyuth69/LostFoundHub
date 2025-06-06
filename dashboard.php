<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}
include 'db.php';
$user_id = $_SESSION['user_id'];
$user = $conn->query("SELECT full_name FROM users WHERE id = $user_id")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      margin: 0;
      background: #f9fafb;
      font-family: 'Segoe UI', sans-serif;
    }

    header {
      background: #2563eb;
      color: white;
      padding: 18px 32px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header h2 {
      margin: 0;
      font-weight: 600;
    }

    .container {
      padding: 40px;
    }

    .actions {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
    }

    .card {
      flex: 1;
      background: #fff;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
      min-width: 250px;
      text-align: center;
      transition: transform 0.3s;
    }

    .card:hover {
      transform: translateY(-4px);
    }

    .card h3 {
      margin-bottom: 12px;
      color: #1e293b;
    }

    .logout {
      color: white;
      text-decoration: underline;
    }
  </style>
</head>
<body>

<header>
  <h2>Welcome, <?= htmlspecialchars($user['full_name']) ?></h2>
  <a href="logout.php" class="logout">Logout</a>
</header>

<div class="container">
  <div class="actions">
    <div class="card">
      <h3>Report Lost Item</h3>
      <p>Log an item you have lost recently.</p>
      <a href="report_lost.php" class="btn">Report Lost</a>
    </div>
    <div class="card">
      <h3>Report Found Item</h3>
      <p>Submit details of any found item.</p>
      <a href="report_found.php" class="btn">Report Found</a>
    </div>
  </div>
</div>

</body>
</html>
