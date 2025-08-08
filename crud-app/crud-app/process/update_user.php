<?php
require '../includes/db.php';
session_start();

if (!isset($_SESSION['user']) || !isset($_POST['update'])) {
    header("Location: ../pages/home.php");
    exit();
}

$id = $_POST['id'];
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = $_POST['password'];

// Validate fields
if (empty($name) || empty($email)) {
    die("Name and email are required.");
}

// Check for email conflict (same email used by another user)
$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
$stmt->execute([$email, $id]);
if ($stmt->rowCount() > 0) {
    die("Email is already in use by another user.");
}

// Handle image upload (optional)
$image_name = null;
if (!empty($_FILES['image']['name'])) {
    $target_dir = "../img/";
    $image_name = uniqid() . '_' . basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;

    $image_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array($image_type, $allowed_types)) {
        die("Only JPG, JPEG, PNG & GIF files are allowed.");
    }

    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        die("Image upload failed.");
    }

    // Optional: delete old image if replacing
    $stmt = $pdo->prepare("SELECT image FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $old = $stmt->fetch();
    if ($old && $old['image']) {
        $old_path = "../img/" . $old['image'];
        if (file_exists($old_path)) unlink($old_path);
    }
}

// Build SQL
$sql = "UPDATE users SET name = ?, email = ?";
$params = [$name, $email];

// Add password if provided
if (!empty($password)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql .= ", password = ?";
    $params[] = $hashed_password;
}

// Add image if uploaded
if ($image_name) {
    $sql .= ", image = ?";
    $params[] = $image_name;
}

$sql .= " WHERE id = ?";
$params[] = $id;

// Run update
$stmt = $pdo->prepare($sql);
$stmt->execute($params);

header("Location: ../pages/dashboard.php");
exit();
