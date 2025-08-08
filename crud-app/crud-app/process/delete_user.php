<?php
require '../includes/db.php';
session_start();

// Must be logged in
if (!isset($_SESSION['user'])) {
    header("Location: ../pages/home.php");
    exit();
}

// Validate and delete user
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Optional: protect admin user from deleting themselves
    if ($_SESSION['user']['id'] == $id) {
        die("You can't delete your own account while logged in.");
    }

    // Fetch image filename before deleting
    $stmt = $pdo->prepare("SELECT image FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch();

    if ($user && $user['image']) {
        $image_path = "../img/" . $user['image'];
        if (file_exists($image_path)) {
            unlink($image_path); // delete image file
        }
    }

    // Delete user
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: ../pages/dashboard.php");
    exit();
} else {
    header("Location: ../pages/dashboard.php");
    exit();
}
