<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lost & Found Management System</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="assets/favicon.png" type="image/png">
  <style>
    body {
      background: linear-gradient(135deg, #dbeafe, #eff6ff);
      background-image: url('assets/bg-pattern.svg'); /* Optional SVG background */
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      min-height: 100vh;
    }

    .container {
      max-width: 640px;
      margin: 80px auto;
      background: rgba(255, 255, 255, 0.95);
      padding: 40px 30px;
      border-radius: 20px;
      box-shadow: 0 24px 50px rgba(0, 0, 0, 0.1);
      text-align: center;
      animation: fadeIn 1s ease;
    }

    .logo {
      width: 80px;
      margin-bottom: 10px;
    }

    .title {
      font-size: 26px;
      font-weight: 700;
      color: #111827;
      margin-bottom: 8px;
    }

    .subtitle {
      font-size: 16px;
      color: #555;
      margin-bottom: 20px;
    }

    .btn-group {
      display: flex;
      justify-content: center;
      gap: 14px;
      flex-wrap: wrap;
      margin-top: 20px;
    }

    .lottie {
      width: 280px;
      height: 280px;
      margin: 20px auto;
    }

    @media (max-width: 600px) {
      .container {
        margin: 40px 15px;
        padding: 30px 20px;
      }
      .lottie {
        width: 220px;
        height: 220px;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <img src="assets/logo.png" alt="Logo" class="logo">

    <h1 class="title">Lost & Found Management System</h1>
    <p class="subtitle">Helping users report and recover their lost items easily & quickly.</p>

    <!-- Lottie Animation -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <lottie-player class="lottie" src="https://assets3.lottiefiles.com/packages/lf20_totrpclr.json" background="transparent" speed="1" loop autoplay></lottie-player>

    <div class="btn-group">
      <a href="login.php" class="btn">User Login</a>
      <a href="register.php" class="btn">User Register</a>
      <a href="admin/login.php" class="btn">Admin Login</a>
    </div>
  </div>

</body>
</html>
