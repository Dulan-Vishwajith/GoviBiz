<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) { die("Unauthorized"); }

$user_id = $_SESSION['user_id'];

// Delete user (all related posts also get removed if FK is set with cascade)
$stmt = $pdo->prepare("DELETE FROM users WHERE user_id=?");
$stmt->execute([$user_id]);

// Destroy session
session_destroy();

header("Location: ../");
exit;
