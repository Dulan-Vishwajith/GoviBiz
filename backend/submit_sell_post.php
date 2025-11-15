<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized.");
}

// Determine correct farmer ID
if ($_SESSION['role'] === 'farmer') {
    $farmer_id = $_SESSION['user_id'];
} 
elseif ($_SESSION['role'] === 'agent' && isset($_SESSION['acting_as_farmer'])) {
    $farmer_id = $_SESSION['acting_as_farmer'];
} 
else {
    die("Unauthorized to submit sell post.");
}

$title = $_POST['title'];
$category = $_POST['category'];
$quantity = $_POST['quantity'];
$unit = $_POST['unit'];
$price = $_POST['price'];
$harvest_from = $_POST['harvest_from'];
$harvest_to = $_POST['harvest_to'];
$description = $_POST['description'];

$stmt = $pdo->prepare("
INSERT INTO posts (user_id, post_type, title, category, quantity, unit, expected_price, harvest_from, harvest_to, description)
VALUES (?, 'sell', ?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->execute([
    $farmer_id,
    $title,
    $category,
    $quantity,
    $unit,
    $price,
    $harvest_from,
    $harvest_to,
    $description
]);

// If agent is acting as farmer → redirect back to farmer dashboard
if (isset($_SESSION['acting_as_farmer'])) {
    header("Location: farmer_dashboard.php");
    exit;
}

// If real farmer
header("Location: dashboard.php");
exit;
