<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid access");
}

$role = $_POST['role'];
$name = trim($_POST['name']);
$address = trim($_POST['address']);
$phone = trim($_POST['phone']);
$nic = trim($_POST['nic']);

// -------------------------------
// HANDLE EMAIL BY ROLE
// -------------------------------
$email = null;

if ($role === 'buyer') {
    $email = $_POST['email_buyer'] ?? null;
}
elseif ($role === 'delivery') {
    $email = $_POST['email_delivery'] ?? null;
}
elseif ($role === 'agent') {
    // Agent can have optional email
    $email = $_POST['email'] ?? null;
}
else {
    // Farmer has NO email
    $email = null;
}

// -------------------------------
// HANDLE PASSWORD
// -------------------------------
$password = $_POST['password'];
$password2 = $_POST['password2'];

if ($password !== $password2) {
    die("Passwords do not match");
}

$hash = password_hash($password, PASSWORD_DEFAULT);

// -------------------------------
// SAVE USER
// -------------------------------
$stmt = $pdo->prepare("
    INSERT INTO users (role, name, address, phone, nic, email, password_hash)
    VALUES (?,?,?,?,?,?,?)
");
$stmt->execute([$role, $name, $address, $phone, $nic, $email, $hash]);

$user_id = $pdo->lastInsertId();

// -------------------------------
// LOG USER IN
// -------------------------------
$_SESSION['user_id'] = $user_id;
$_SESSION['role'] = $role;
$_SESSION['name'] = $name;
$_SESSION['address'] = $address;

// -------------------------------
// REDIRECT
// -------------------------------
header("Location: dashboard.php");
exit;
