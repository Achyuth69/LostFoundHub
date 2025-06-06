<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['full_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

  $stmt = $conn->prepare("INSERT INTO users (full_name, email, phone, password) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $name, $email, $phone, $password);

  if ($stmt->execute()) {
    header("Location: login.php");
    exit();
  } else {
    $error = "Email already exists or registration failed!";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Register - Lost & Found</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      background: linear-gradient(to bottom right, #f0f9ff, #dbeafe);
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
      max-width: 480px;
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
    <h2>User Registration</h2>

    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="post">
      <input type="text" name="full_name" placeholder="Full Name" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="tel" name="phone" placeholder="Phone Number" required>
      <input type="password" name="password" placeholder="Password" required>
      <button class="btn" type="submit">Register</button>
    </form>

    <a href="index.php" class="back-link">← Back to Home</a>
  </div>
</body>
</html>
