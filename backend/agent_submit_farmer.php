<?php
require_once 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'agent') {
    die("Unauthorized.");
}

$agent_id = $_SESSION['user_id'];

$name = trim($_POST['name']);
$nic = trim($_POST['nic']);
$phone = trim($_POST['phone']);
$location = trim($_POST['location']);

// Insert farmer with NO PASSWORD + creator = agent
$stmt = $pdo->prepare("
    INSERT INTO users (role, name, address, phone, nic, password_hash, created_by_agent)
    VALUES ('farmer', ?, ?, ?, ?, NULL, ?)
");

$stmt->execute([$name, $location, $phone, $nic, $agent_id]);

header("Location: agent_farmers.php");
exit;
