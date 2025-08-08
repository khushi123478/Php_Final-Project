<?php
require '../includes/db.php';
session_start();

if (!isset($_SESSION['user']) || !isset($_POST['add'])) {
    header("Location: ../pages/about.php");
    exit();
}

$title = trim($_POST['title']);
$body = trim($_POST['body']);

if (empty($title) || empty($body)) {
    die("Title and body are required.");
}

$stmt = $pdo->prepare("INSERT INTO content (title, body) VALUES (?, ?)");
$stmt->execute([$title, $body]);

header("Location: ../pages/about.php");
exit();
