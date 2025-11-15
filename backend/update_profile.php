<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) { die("Unauthorized"); }

$user_id = $_SESSION['user_id'];

$name = trim($_POST['name']);
$address = trim($_POST['address']);
$phone = trim($_POST['phone']);
$nic = trim($_POST['nic']);
$email = trim($_POST['email'] ?? null);

$stmt = $pdo->prepare("
UPDATE users SET name=?, address=?, phone=?, nic=?, email=? WHERE user_id=?
");
$stmt->execute([$name, $address, $phone, $nic, $email, $user_id]);

// Update session for display
$_SESSION['name'] = $name;
$_SESSION['address'] = $address;

header("Location: account_settings.php?updated=1");
exit;
