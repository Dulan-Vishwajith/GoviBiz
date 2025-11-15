<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit;
}

$phone = trim($_POST['phone']);
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE phone = ? LIMIT 1");
$stmt->execute([$phone]);
$user = $stmt->fetch();

if (!$user || !password_verify($password, $user['password_hash'])) {
    header("Location: login.php?error=1");
    exit;
}

// SUCCESS
$_SESSION['user_id'] = $user['user_id'];
$_SESSION['role'] = $user['role'];
$_SESSION['name'] = $user['name'];

header("Location: dashboard.php");
exit;
