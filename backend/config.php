<?php
// config.php
session_start();

$host = '127.0.0.1';
$db   = 'gramabiz';
$user = 'root';
$pass = ''; // default for XAMPP
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // In production, hide exception message
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
