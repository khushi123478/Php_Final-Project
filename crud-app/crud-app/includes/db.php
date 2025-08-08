<?php
$host = 'localhost';
$db = 'crud_app';
$user = 'root';
$pass = ''; // Default for XAMPP is empty

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully"; // For debugging
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
