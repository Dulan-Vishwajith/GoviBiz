<?php
require_once 'config.php';

$stmt = $pdo->prepare("
SELECT 
    d.vehicle_type, 
    d.loading_capacity, 
    d.rate_per_km, 
    d.location,
    u.name,
    u.phone
FROM delivery_posts d
JOIN users u ON d.user_id = u.user_id
ORDER BY d.created_at DESC
");
$stmt->execute();
$data = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Delivery Providers - ගොවිBiz🌾</title>
<link rel="stylesheet" href="../assets/css/styles.css">

<style>
/* Background */
body {
    margin: 0;
    padding: 0;
    font-family: "Poppins", Arial, sans-serif;
    background: url("../assets/images/farm-bg.jpg") center/cover no-repeat fixed;
    min-height: 100vh;
    position: relative;
}

/* Overlay */
.overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.50);
    z-index: 1;
}

/* Logo */
.top-logo {
    position: fixed;
    top: 25px;
    left: 40px;
    color: #fff;
    font-size: 42px;
    font-weight: 700;
    text-shadow: 1px 1px 10px black;
    z-index: 3;
}

/* Back Button */
.back-btn {
    position: fixed;
    top: 35px;
    right: 40px;
    z-index: 3;
    padding: 10px 20px;
    background: rgba(255,255,255,0.25);
    backdrop-filter: blur(5px);
    color: #fff;
    text-decoration: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    transition: 0.3s;
}

.back-btn:hover {
    background: rgba(255,255,255,0.45);
    transform: translateY(-2px);
}

/* Main content box */
.page-box {
    position: relative;
    z-index: 2;
    width: 90%;
    max-width: 1100px;
    margin: 120px auto 40px;
    background: rgba(255,255,255,0.15);
    padding: 30px;
    border-radius: 16px;
    backdrop-filter: blur(6px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.35);
    animation: fadeIn 0.8s ease;
}

/* Title */
.page-box h2 {
    text-align: center;
    font-size: 2rem;
    color: #ffffff;
    text-shadow: 1px 1px 8px black;
    margin-bottom: 20px;
}

/* Cards grid */
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 18px;
}

/* Cards */
.card {
    background: rgba(255,255,255,0.92);
    padding: 15px;
    border-radius: 14px;
    box-shadow: 0 4px 18px rgba(0,0,0,0.25);
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 25px rgba(0,0,0,0.35);
}

.card h3 {
    margin: 0 0 8px;
    color: #2a4d2e;
}

.card p {
    margin: 5px 0;
    color: #333;
    font-size: 0.95rem;
}

.card a {
    color: #2a7d3c;
    text-decoration: none;
}

/* Fade animation */
@keyframes fadeIn {
    from { opacity:0; transform:translateY(20px); }
    to   { opacity:1; transform:translateY(0); }
}
</style>
</head>

<body>

<div class="overlay"></div>

<!-- Logo -->
<div class="top-logo">ගොවිBiz🌾</div>

<!-- Back Button -->
<a href="dashboard.php" class="back-btn">⬅ Back</a>

<!-- Page Content -->
<div class="page-box">
    <h2>Nearby Delivery Providers</h2>

    <div class="grid">
        <?php foreach ($data as $d): ?>
            <div class="card">
                <h3><?= htmlspecialchars($d['name']) ?></h3>

                <p><strong>Vehicle:</strong> <?= htmlspecialchars($d['vehicle_type']) ?></p>
                <p><strong>Capacity:</strong> <?= htmlspecialchars($d['loading_capacity']) ?></p>
                <p><strong>Rate:</strong> Rs <?= htmlspecialchars($d['rate_per_km']) ?>/km</p>
                <p><strong>Location:</strong> <?= htmlspecialchars($d['location']) ?></p>

                <p><strong>Phone:</strong>
                    <a href="tel:<?= htmlspecialchars($d['phone']) ?>">
                        <?= htmlspecialchars($d['phone']) ?>
                    </a>
                </p>
            </div>
        <?php endforeach; ?>
    </div>

</div>

</body>
</html>
