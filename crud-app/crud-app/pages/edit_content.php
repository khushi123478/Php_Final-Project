<?php
require '../includes/db.php';
require '../includes/header.php';

if (!isset($_SESSION['user'])) {
    header("Location: home.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("Content ID missing.");
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM content WHERE id = ?");
$stmt->execute([$id]);
$content = $stmt->fetch();

if (!$content) {
    die("Content not found.");
}
?>

<h2>Edit Content</h2>

<form action="../process/update_content.php" method="POST">
  <input type="hidden" name="id" value="<?= $content['id'] ?>">

  <label>Title:</label><br>
  <input type="text" name="title" value="<?= htmlspecialchars($content['title']) ?>" required><br><br>

  <label>Body:</label><br>
  <textarea name="body" rows="5" required><?= htmlspecialchars($content['body']) ?></textarea><br><br>

  <button type="submit" name="update">Update</button>
</form>

<?php include '../includes/footer.php'; ?>
