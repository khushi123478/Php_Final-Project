<?php
require '../includes/db.php';
session_start();

if (!isset($_SESSION['user']) || !isset($_GET['id'])) {
    header("Location: ../pages/about.php");
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM content WHERE id = ?");
$stmt->execute([$id]);

header("Location: ../pages/about.php");
exit();
