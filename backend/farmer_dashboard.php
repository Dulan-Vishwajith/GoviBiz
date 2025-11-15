<?php
require_once 'config.php';

// Only agent acting as farmer may access
if (!isset($_SESSION['acting_as_farmer'])) {
    die("Unauthorized.");
}

$farmer_id = $_SESSION['acting_as_farmer'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->execute([$farmer_id]);
$farmer = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Managing Farmer - ගොවිBiz🌾</title>
<link rel="stylesheet" href="../assets/css/styles.css">

<style>
/* Background */
body {
    margin: 0;
    padding: 0;
    font-family: "Poppins", sans-serif;
    background: url("../assets/images/farm-bg.jpg") center/cover no-repeat fixed;
    min-height: 100vh;
    position: relative;
}

/* Dark overlay */
body::before {
    content: "";
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.55);
    z-index: 1;
}

/* Logo */
.top-logo {
    position: fixed;
    top: 25px;
    left: 40px;
    color: white;
    font-size: 42px;
    font-weight: 700;
    text-shadow: 1px 1px 10px black;
    z-index: 4;
}

/* Back Button */
.back-btn {
    position: fixed;
    top: 25px;
    right: 40px;
    padding: 10px 22px;
    background: rgba(255,255,255,0.25);
    color: white;
    text-decoration: none;
    border-radius: 8px;
    backdrop-filter: blur(5px);
    font-weight: 600;
    box-shadow: 0px 4px 12px rgba(0,0,0,0.3);
    transition: .3s;
    z-index: 4;
}
.back-btn:hover {
    background: rgba(255,255,255,0.45);
    transform: translateY(-2px);
}

/* Main Container */
.container {
    width: 90%;
    max-width: 700px;
    margin: 140px auto;
    background: rgba(255,255,255,0.18);
    padding: 35px;
    border-radius: 18px;
    backdrop-filter: blur(8px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.35);
    position: relative;
    z-index: 3;
    animation: fadeUp .7s ease;
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

h2 {
    color: #fff;
    text-align: center;
    font-size: 26px;
    margin-bottom: 25px;
    text-shadow: 1px 1px 6px black;
}

/* Buttons */
.action-btn {
    display: block;
    width: 100%;
    padding: 14px;
    margin-top: 15px;
    background: #2a7d3c;
    color: white;
    text-align: center;
    font-weight: 600;
    border-radius: 8px;
    text-decoration: none;
    transition: .3s;
    box-shadow: 0 4px 12px rgba(0,0,0,0.25);
}
.action-btn:hover {
    background: #246b34;
    transform: translateY(-2px);
}

/* Back to list button */
.back-list {
    background: #1e4e8c !important;
}
.back-list:hover {
    background: #163d6d !important;
}
</style>

</head>

<body>

<!-- Logo -->
<div class="top-logo">ගොවිBiz🌾</div>

<!-- Top Right Back Button -->
<a href="agent_farmers.php" class="back-btn">⬅ Back</a>

<div class="container">
    <h2>Managing Farmer: <?= htmlspecialchars($farmer['name']) ?></h2>

    <a class="action-btn" 
       href="create_sell_post.php?farmer=<?= $farmer_id ?>">
       ➕ Create Sell Post
    </a>

    <a class="action-btn back-list" 
       href="agent_farmers.php">
       🔙 Back to My Farmers
    </a>
</div>

</body>
</html>
