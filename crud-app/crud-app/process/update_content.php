<?php
require '../includes/db.php';
session_start();

if (!isset($_SESSION['user']) || !isset($_POST['update'])) {
    header("Location: ../pages/about.php");
    exit();
}

$id = $_POST['id'];
$title = trim($_POST['title']);
$body = trim($_POST['body']);

if (empty($title) || empty($body)) {
    die("Title and body cannot be empty.");
}

$stmt = $pdo->prepare("UPDATE content SET title = ?, body = ? WHERE id = ?");
$stmt->execute([$title, $body, $id]);

header("Location: ../pages/about.php");
exit();
