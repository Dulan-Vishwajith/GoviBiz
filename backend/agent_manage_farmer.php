<?php
require_once 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'agent') {
    die("Unauthorized.");
}

$farmer_id = $_GET['id'];


$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ? AND role='farmer'");
$stmt->execute([$farmer_id]);
$farmer = $stmt->fetch();

if (!$farmer) die("Farmer not found.");

// IMPORTANT: Check agent owns this farmer
if ($farmer['created_by_agent'] != $_SESSION['user_id']) {
    die("You do not have permission to manage this farmer.");
}

// Switch to "acting as farmer"
$_SESSION['acting_as_farmer'] = $farmer_id;

header("Location: farmer_dashboard.php");
exit;
