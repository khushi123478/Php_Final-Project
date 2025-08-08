<?php
require '../includes/db.php';
require '../includes/header.php';

// Ensure user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: home.php");
    exit();
}

// Ensure 'id' is in the URL
if (!isset($_GET['id'])) {
    echo "No user ID provided.";
    include '../includes/footer.php';
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if (!$user) {
    echo "User not found.";
    include '../includes/footer.php';
    exit();
}
?>

<h2>Edit User</h2>

<form action="../process/update_user.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?= $user['id'] ?>">

  <label>Name:</label><br>
  <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required><br><br>

  <label>Email:</label><br>
  <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br><br>

  <label>New Password (leave blank to keep current):</label><br>
  <input type="password" name="password"><br><br>

  <label>Change Image (optional):</label><br>
  <input type="file" name="image"><br><br>

  <button type="submit" name="update">Update</button>
</form>

<?php include '../includes/footer.php'; ?>
