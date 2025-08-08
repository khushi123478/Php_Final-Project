<?php include '../includes/header.php'; ?>
<h2>Register</h2>

<form action="../process/register_process.php" method="POST" enctype="multipart/form-data">
  <label for="name">Full Name:</label><br>
  <input type="text" name="name" required><br><br>

  <label for="email">Email:</label><br>
  <input type="email" name="email" required><br><br>

  <label for="password">Password:</label><br>
  <input type="password" name="password" required><br><br>

  <label for="image">Upload Profile Image (optional):</label><br>
  <input type="file" name="image" accept="image/*"><br><br>

  <button type="submit" name="register">Register</button>
</form>

<p>Already have an account? Login using the form in the header.</p>

<?php include '../includes/footer.php'; ?>
