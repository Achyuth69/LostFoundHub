<?php
require 'db.php';
if (!isset($_GET['id'])) {
    die("Item not found.");
}
$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM items WHERE id = $id");
$item = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Item Details</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container">
    <h2><?= htmlspecialchars($item['item_name']) ?></h2>
    <img src="<?= $item['image_path'] ?>" alt="Item Image" class="item-image">
    <p><strong>Description:</strong> <?= htmlspecialchars($item['description']) ?></p>
    <p><strong>Color:</strong> <?= $item['color'] ?></p>
    <p><strong>Size:</strong> <?= $item['size'] ?></p>
    <p><strong>Contact:</strong> <?= $item['contact_info'] ?></p>
    <p><strong>Status:</strong> <?= $item['status'] ?></p>
  </div>
</body>
</html>
