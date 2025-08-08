<?php
require '../includes/db.php';
require '../includes/header.php';

// Restrict access
if (!isset($_SESSION['user'])) {
    header("Location: home.php");
    exit();
}

// Fetch all users
$stmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
$users = $stmt->fetchAll();
?>

<h2>Welcome, <?= htmlspecialchars($_SESSION['user']['name']) ?>!</h2>
<p>Here is a list of all registered users:</p>

<table border="1" cellpadding="8" cellspacing="0">
  <thead>
    <tr>
      <th>Image</th>
      <th>Name</th>
      <th>Email</th>
      <th>Registered At</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user): ?>
      <tr>
        <td>
          <?php if ($user['image']): ?>
            <img src="../img/<?= htmlspecialchars($user['image']) ?>" alt="profile image" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
          <?php else: ?>
            No image
          <?php endif; ?>
        </td>
        <td><?= htmlspecialchars($user['name']) ?></td>
        <td><?= htmlspecialchars($user['email']) ?></td>
        <td><?= $user['created_at'] ?></td>
        <td>
          <a href="edit_user.php?id=<?= $user['id'] ?>">Edit</a> |
          <a href="../process/delete_user.php?id=<?= $user['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php include '../includes/footer.php'; ?>
