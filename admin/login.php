<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if ($username === 'admin' && $password === 'admin123') {
    $_SESSION['admin'] = true;
    header("Location: dashboard.php");
    exit();
  } else {
    $error = "Invalid admin credentials!";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <link rel="stylesheet" href="../css/style.css">
  <style>
    body {
      background: linear-gradient(to right, #dbeafe, #f0f9ff);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', sans-serif;
    }

    .form-container {
      background: #fff;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 420px;
      animation: fadeIn 0.6s ease;
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 24px;
      color: #1e293b;
    }

    .form-container input {
      width: 100%;
      padding: 12px;
      margin-bottom: 16px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    .btn {
      width: 100%;
    }

    .error {
      color: red;
      text-align: center;
      margin-bottom: 12px;
    }
  </style>
</head>
<body>

<div class="form-container">
  <h2>Admin Login</h2>

  <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

  <form method="POST">
    <input type="text" name="username" placeholder="Admin Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button class="btn" type="submit">Login</button>
  </form>
</div>

</body>
</html>
