<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_id = $_SESSION['user_id'];
  $item_name = $_POST['item_name'];
  $description = $_POST['description'];
  $color = $_POST['color'];
  $size = $_POST['size'];
  $contact = $_POST['contact_info'];

  $image_path = '';
  if (!empty($_FILES['image']['name'])) {
    $image_name = time() . '_' . $_FILES['image']['name'];
    $target = "uploads/" . $image_name;
    move_uploaded_file($_FILES['image']['tmp_name'], $target);
    $image_path = $target;
  }

  $stmt = $conn->prepare("INSERT INTO items (user_id, type, item_name, description, color, size, image_path, contact_info, status) VALUES (?, 'found', ?, ?, ?, ?, ?, ?, 'pending')");
  $stmt->bind_param("issssss", $user_id, $item_name, $description, $color, $size, $image_path, $contact);

  if ($stmt->execute()) {
    $success = "Found item reported successfully.";
  } else {
    $error = "Failed to report item.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Report Found Item</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      background: #f0f9ff;
      font-family: 'Segoe UI', sans-serif;
      padding: 40px;
    }

    .form-container {
      max-width: 600px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    h2 {
      text-align: center;
      margin-bottom: 24px;
    }

    input, textarea, select {
      width: 100%;
      padding: 12px;
      margin-bottom: 16px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    .btn {
      width: 100%;
    }

    .message {
      text-align: center;
      color: green;
      margin-bottom: 16px;
    }

    .error {
      text-align: center;
      color: red;
      margin-bottom: 16px;
    }
  </style>
</head>
<body>

<div class="form-container">
  <h2>Report Found Item</h2>

  <?php if (!empty($success)) echo "<div class='message'>$success</div>"; ?>
  <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

  <form method="POST" enctype="multipart/form-data">
    <input type="text" name="item_name" placeholder="Item Name" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <input type="text" name="color" placeholder="Color" required>
    <input type="text" name="size" placeholder="Size (e.g. Small, Medium, Large)">
    <input type="file" name="image" accept="image/*" required>
    <input type="text" name="contact_info" placeholder="Your contact info (phone/email)" required>
    <button class="btn" type="submit">Submit Found Report</button>
  </form>
</div>

</body>
</html>
