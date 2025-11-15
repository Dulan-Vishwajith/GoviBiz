<?php
require_once 'config.php';
if ($_SESSION['role'] !== 'delivery') {
    die("Unauthorized");
}

$user_id = $_SESSION['user_id'];

$vehicle = $_POST['vehicle_type'];
$capacity = $_POST['loading_capacity'];
$rate = $_POST['rate'];
$location = $_POST['location'];

$stmt = $pdo->prepare("
INSERT INTO delivery_posts (user_id, vehicle_type, loading_capacity, rate_per_km, location)
VALUES (?,?,?,?,?)
");
$stmt->execute([$user_id, $vehicle, $capacity, $rate, $location]);

header("Location: dashboard.php");
exit;
