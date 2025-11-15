<?php
require_once 'config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'buyer') {
    die("Unauthorized access");
}

$user_id = $_SESSION['user_id'];

$title = $_POST['title'];
$category = $_POST['category'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$description = $_POST['description'];

$stmt = $pdo->prepare("
INSERT INTO posts (user_id, post_type, title, category, quantity, expected_price, description)
VALUES (?, 'buy', ?, ?, ?, ?, ?)
");

$stmt->execute([$user_id, $title, $category, $quantity, $price, $description]);

header("Location: dashboard.php");
exit;
