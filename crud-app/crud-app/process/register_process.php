<?php
require '../includes/db.php';

if (isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validate fields
    if (empty($name) || empty($email) || empty($password)) {
        die("All fields are required.");
    }

    // Check for duplicate email
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        die("Email already exists.");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Handle image upload
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
            die("Failed to upload image.");
        }
    }

    // Insert user
    $sql = "INSERT INTO users (name, email, password, image) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $hashed_password, $image_name]);

    echo "Registration successful. <a href='../pages/home.php'>Go to Home</a>";
} else {
    header("Location: ../pages/register.php");
    exit();
}
