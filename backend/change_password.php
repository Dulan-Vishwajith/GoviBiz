<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) { die("Unauthorized"); }

$user_id = $_SESSION['user_id'];

$old = $_POST['old_password'];
$new = $_POST['new_password'];
$new2 = $_POST['new_password2'];

if ($new !== $new2) {
    die("New passwords do not match.");
}

// Get current hash
$stmt = $pdo->prepare("SELECT password_hash FROM users WHERE user_id=?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!password_verify($old, $user['password_hash'])) {
    die("Current password is incorrect.");
}

// Update password
$new_hash = password_hash($new, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("UPDATE users SET password_hash=? WHERE user_id=?");
$stmt->execute([$new_hash, $user_id]);

header("Location: account_settings.php?pwd=changed");
exit;
