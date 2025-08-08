<?php
require '../includes/db.php';
require '../includes/header.php';

// Fetch all content
$stmt = $pdo->query("SELECT * FROM content ORDER BY created_at DESC");
$posts = $stmt->fetchAll();
?>

<h2>About / Content Page</h2>

<p>Welcome to our CRUD application! This platform demonstrates a basic content management system built with PHP, MySQL, HTML, and CSS. 
Here, you can create, read, update, and delete simple posts. If you're logged in, you’ll be able to contribute and manage content.</p>

<hr>

<?php if (isset($_SESSION['user'])): ?>
  <p><a href="add_content.php">+ Add New Content</a></p>
<?php endif; ?>

<?php if (count($posts) > 0): ?>
  <?php foreach ($posts as $post): ?>
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
      <h3><?= htmlspecialchars($post['title']) ?></h3>
      <p><?= nl2br(htmlspecialchars($post['body'])) ?></p>
      <small>Posted on: <?= $post['created_at'] ?></small><br>

      <?php if (isset($_SESSION['user'])): ?>
        <a href="edit_content.php?id=<?= $post['id'] ?>">Edit</a> |
        <a href="../process/delete_content.php?id=<?= $post['id'] ?>" onclick="return confirm('Delete this content?')">Delete</a>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
<?php else: ?>
  <p><em>No content has been posted yet. Please check back later.</em></p>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>
