<?php
// payment_notify.php
require_once 'config.php';

// Read POST data sent by PayHere
// Example fields: merchant_id, order_id, status_code, md5sig, payhere_amount, payhere_currency
$raw = $_POST;

// basic sanity
$order_id = $_POST['order_id'] ?? '';
$status_code = $_POST['status_code'] ?? ''; // 2 = success typically (PayHere uses status_code)
$amount = $_POST['payhere_amount'] ?? '';
$currency = $_POST['payhere_currency'] ?? '';

if (!$order_id) {
    http_response_code(400);
    echo "Missing order_id";
    exit;
}

// look up our payment row
$stmt = $pdo->prepare("SELECT * FROM payments WHERE order_id = ? LIMIT 1");
$stmt->execute([$order_id]);
$payment = $stmt->fetch();

if (!$payment) {
    // unknown order
    http_response_code(404);
    echo "Order not found";
    exit;
}

// basic verification: amount matches
if (abs(floatval($payment['amount']) - floatval($amount)) > 0.01) {
    // amount mismatch - possible tampering
    // mark as failed
    $u = $pdo->prepare("UPDATE payments SET status = ?, updated_at = NOW() WHERE order_id = ?");
    $u->execute(['failed', $order_id]);
    http_response_code(400);
    echo "Amount mismatch";
    exit;
}

// decide success vs failed based on status_code (PayHere returns status_code==2 success)
if ($status_code == '2' || strtolower($_POST['status']) === 'success') {
    // update payments
    $u = $pdo->prepare("UPDATE payments SET status = 'success', updated_at = NOW() WHERE order_id = ?");
    $u->execute([$order_id]);

    // if registration, optionally flag user as active / verified in users table
    if ($payment['payment_type'] === 'registration') {
        $up = $pdo->prepare("UPDATE users SET verified = 1 WHERE user_id = ?");
        // If your users table does not have verified column, ignore this step or add it.
        // ALTER TABLE users ADD verified TINYINT(1) DEFAULT 0;
        $up->execute([$payment['user_id']]);
    }

    // You can add other business logic: e.g. allow one post creation by recording metadata, etc.

    http_response_code(200);
    echo "OK";
    exit;
} else {
    // failed
    $u = $pdo->prepare("UPDATE payments SET status = 'failed', updated_at = NOW() WHERE order_id = ?");
    $u->execute([$order_id]);
    http_response_code(200);
    echo "FAILED";
    exit;
}
