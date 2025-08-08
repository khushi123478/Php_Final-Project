<?php
require '../includes/db.php';
require '../includes/header.php';

if (!isset($_SESSION['user'])) {
    header("Location: home.php");
    exit();
}
?>

<h2>Add New Content</h2>

<form action="../process/add_content_process.php" method="POST">
  <label>Title:</label><br>
  <input type="text" name="title" required><br><br>

  <label>Body:</label><br>
  <textarea name="body" rows="5" required></textarea><br><br>

  <button type="submit" name="add">Post</button>
</form>

<?php include '../includes/footer.php'; ?>
