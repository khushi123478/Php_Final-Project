<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CRUD App</title>
  <link rel="stylesheet" href="/crud-app/css/style.css">
</head>
<body>
  <header>
    <h1>My CRUD App</h1>
    <nav>
  <a href="/crud-app/pages/home.php">Home</a> |
  <a href="/crud-app/pages/about.php">About</a> |
  <a href="/crud-app/pages/register.php">Register</a> |

  <?php if (!isset($_SESSION['user'])): ?>
    <a href="/crud-app/pages/login.php">Login</a>
    <form action="/crud-app/process/login_process.php" method="POST" class="login-form">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
  <?php else: ?>
    <a href="/crud-app/pages/dashboard.php">Dashboard</a> |
    <a href="/crud-app/logout.php">Logout</a>
  <?php endif; ?>
</nav>

    <hr>
  </header>
  <main>
