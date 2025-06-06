<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    header("Location: dashboard.php");
    exit();
  } else {
    $error = "Invalid email or password!";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Login - Lost & Found</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      background: linear-gradient(to bottom right, #dbeafe, #f0f9ff);
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .form-container {
      background: #fff;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 24px 48px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 420px;
      animation: fadeIn 0.8s ease;
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #111827;
    }

    .form-container input {
      width: 100%;
      padding: 12px;
      margin: 10px 0 16px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    .form-container .btn {
      width: 100%;
    }

    .error {
      color: red;
      text-align: center;
      margin-bottom: 10px;
    }

    .back-link {
      display: block;
      text-align: center;
      margin-top: 14px;
      color: #2563eb;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>User Login</h2>

    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="post">
      <input type="email" name="email" placeholder="Enter your email" required>
      <input type="password" name="password" placeholder="Enter your password" required>
      <button class="btn" type="submit">Login</button>
    </form>

    <a href="index.php" class="back-link">← Back to Home</a>
  </div>
</body>
</html>
