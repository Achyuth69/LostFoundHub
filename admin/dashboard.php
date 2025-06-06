<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit();
}
include '../db.php';

if (isset($_GET['verify'])) {
  $item_id = intval($_GET['verify']);
  $conn->query("UPDATE items SET status='matched' WHERE id=$item_id");
  $message = "Item ID $item_id marked as matched.";
}

$items = $conn->query("SELECT items.*, users.full_name FROM items JOIN users ON items.user_id = users.id ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../css/style.css">
  <style>
    body {
      background: #f8fafc;
      font-family: 'Segoe UI', sans-serif;
      padding: 30px;
    }

    h2 {
      text-align: center;
      color: #1e293b;
      margin-bottom: 30px;
    }

    .message {
      text-align: center;
      color: green;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 6px 24px rgba(0, 0, 0, 0.05);
      border-radius: 10px;
      overflow: hidden;
    }

    th, td {
      padding: 16px;
      border-bottom: 1px solid #eee;
      text-align: left;
    }

    th {
      background: #1d4ed8;
      color: white;
    }

    img {
      max-width: 80px;
      border-radius: 6px;
    }

    .btn-verify {
      background: #16a34a;
      color: white;
      padding: 8px 12px;
      border: none;
      border-radius: 6px;
      text-decoration: none;
    }

    .status-matched {
      color: #16a34a;
      font-weight: 600;
    }

    .logout {
      display: block;
      text-align: center;
      margin-top: 30px;
    }

    .logout a {
      color: #ef4444;
      text-decoration: underline;
    }
  </style>
</head>
<body>

<h2>Admin Dashboard - Item Verification</h2>

<?php if (!empty($message)) echo "<div class='message'>$message</div>"; ?>

<table>
  <tr>
    <th>ID</th>
    <th>User</th>
    <th>Type</th>
    <th>Name</th>
    <th>Description</th>
    <th>Color</th>
    <th>Size</th>
    <th>Image</th>
    <th>Contact</th>
    <th>Status</th>
    <th>Action</th>
  </tr>
  <?php while ($row = $items->fetch_assoc()): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= htmlspecialchars($row['full_name']) ?></td>
      <td><?= ucfirst($row['type']) ?></td>
      <td><?= htmlspecialchars($row['item_name']) ?></td>
      <td><?= htmlspecialchars($row['description']) ?></td>
      <td><?= htmlspecialchars($row['color']) ?></td>
      <td><?= htmlspecialchars($row['size']) ?></td>
      <td>
        <?php if (!empty($row['image_path'])): ?>
          <img src="../<?= $row['image_path'] ?>" alt="Item Image">
        <?php else: ?>
          N/A
        <?php endif; ?>
      </td>
      <td><?= htmlspecialchars($row['contact_info']) ?></td>
      <td class="<?= $row['status'] === 'matched' ? 'status-matched' : '' ?>"><?= ucfirst($row['status']) ?></td>
      <td>
        <?php if ($row['status'] !== 'matched'): ?>
          <a href="?verify=<?= $row['id'] ?>" class="btn-verify">Mark as Matched</a>
        <?php else: ?>
          ✔️
        <?php endif; ?>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<div class="logout">
  <a href="logout.php">Logout Admin</a>
</div>

</body>
</html>
