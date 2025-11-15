<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

/* =====================================================================
   GET FILTER VALUES
   ===================================================================== */
$type = $_GET['type'] ?? '';
$category = $_GET['category'] ?? '';
$min = $_GET['min'] ?? '';
$max = $_GET['max'] ?? '';
$location = $_GET['location'] ?? '';

/* =====================================================================
   SELL POSTS
   ===================================================================== */
$sell_sql = "
SELECT p.*, u.name AS owner_name, u.phone AS owner_phone, u.address AS owner_address
FROM posts p
JOIN users u ON p.user_id = u.user_id
WHERE p.post_type = 'sell'
";
$sell_params = [];
$sell_conditions = [];

if ($category) { $sell_conditions[] = "p.category LIKE ?"; $sell_params[] = "%$category%"; }
if ($min) { $sell_conditions[] = "p.expected_price >= ?"; $sell_params[] = $min; }
if ($max) { $sell_conditions[] = "p.expected_price <= ?"; $sell_params[] = $max; }
if ($location) { $sell_conditions[] = "u.address LIKE ?"; $sell_params[] = "%$location%"; }

if ($sell_conditions) $sell_sql .= " AND " . implode(" AND ", $sell_conditions);

$sell_sql .= " ORDER BY p.created_at DESC";
$sell_stmt = $pdo->prepare($sell_sql);
$sell_stmt->execute($sell_params);
$sell_posts = $sell_stmt->fetchAll();

/* =====================================================================
   BUY POSTS
   ===================================================================== */
$buy_sql = "
SELECT p.*, u.name AS owner_name, u.phone AS owner_phone, u.address AS owner_address
FROM posts p
JOIN users u ON p.user_id = u.user_id
WHERE p.post_type = 'buy'
";
$buy_params = [];
$buy_conditions = [];

if ($category) { $buy_conditions[] = "p.category LIKE ?"; $buy_params[] = "%$category%"; }
if ($min) { $buy_conditions[] = "p.expected_price >= ?"; $buy_params[] = $min; }
if ($max) { $buy_conditions[] = "p.expected_price <= ?"; $buy_params[] = $max; }
if ($location) { $buy_conditions[] = "u.address LIKE ?"; $buy_params[] = "%$location%"; }

if ($buy_conditions) $buy_sql .= " AND " . implode(" AND ", $buy_conditions);

$buy_sql .= " ORDER BY p.created_at DESC";
$buy_stmt = $pdo->prepare($buy_sql);
$buy_stmt->execute($buy_params);
$buy_posts = $buy_stmt->fetchAll();

/* =====================================================================
   DELIVERY POSTS
   ===================================================================== */
$delivery_sql = "
SELECT d.*, u.name, u.phone
FROM delivery_posts d
JOIN users u ON d.user_id = u.user_id
WHERE 1
";
$delivery_params = [];
$delivery_conditions = [];

if ($min) { $delivery_conditions[] = "d.rate_per_km >= ?"; $delivery_params[] = $min; }
if ($max) { $delivery_conditions[] = "d.rate_per_km <= ?"; $delivery_params[] = $max; }
if ($location) { $delivery_conditions[] = "d.location LIKE ?"; $delivery_params[] = "%$location%"; }

if ($delivery_conditions) $delivery_sql .= " AND " . implode(" AND ", $delivery_conditions);

$delivery_sql .= " ORDER BY d.created_at DESC";
$delivery_stmt = $pdo->prepare($delivery_sql);
$delivery_stmt->execute($delivery_params);
$delivery_posts = $delivery_stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>All Posts</title>
<link rel="stylesheet" href="../assets/css/styles.css">

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: "Poppins", sans-serif;
        background: url("../assets/images/farm-bg.jpg") center/cover no-repeat;
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
        color: #fff;
        font-size: 42px;
        font-weight: 700;
        text-shadow: 1px 1px 10px black;
        z-index: 3;
    }

    /* Back Button */
    .back-btn {
        position: fixed;
        top: 25px;
        right: 40px;
        padding: 10px 20px;
        background: rgba(255,255,255,0.25);
        backdrop-filter: blur(5px);
        border-radius: 8px;
        color: #fff;
        text-decoration: none;
        font-size: 16px;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        transition: 0.3s;
        z-index: 3;
    }

    .back-btn:hover {
        background: rgba(255,255,255,0.45);
        transform: translateY(-2px);
    }

    .container {
        width: 90%;
        max-width: 1100px;
        margin: 120px auto 40px;
        background: rgba(255,255,255,0.93);
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.25);
        position: relative;
        z-index: 2;
        animation: fadeUp .6s ease;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    h2, h3 {
        color: #2a4d2e;
        margin-top: 10px;
    }

    .filter-box {
        background: #fff;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }

    .filter-box input, 
    .filter-box select {
        padding: 8px 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        margin-right: 10px;
    }

    .filter-btn {
        padding: 10px 15px;
        background: #2a7d3c;
        color: #fff;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: .3s;
    }

    .filter-btn:hover {
        background: #256e34;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 15px;
        margin-top: 15px;
    }

    .card {
        background: #fff;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        transition: .3s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    }

    .card h4 {
        margin: 0 0 10px;
        color: #2a4d2e;
    }

    a {
        color: #2a7d3c;
        text-decoration: none;
    }
</style>
</head>

<body>

<!-- Logo -->
<div class="top-logo">ගොවිBiz🌾</div>

<!-- Back Button -->
<a href="dashboard.php" class="back-btn">⬅ Back</a>

<div class="container">

    <h2>All Posts</h2>

    <!-- FILTER BAR -->
    <form method="get" class="filter-box">
        <label><b>Post Type:</b></label>
        <select name="type">
            <option value="">All</option>
            <option value="sell" <?= ($type=='sell')?'selected':'' ?>>Sell</option>
            <option value="buy" <?= ($type=='buy')?'selected':'' ?>>Buy</option>
            <option value="delivery" <?= ($type=='delivery')?'selected':'' ?>>Delivery</option>
        </select>

        <label><b>Category:</b></label>
        <input type="text" name="category" value="<?= htmlspecialchars($category) ?>">

        <label><b>Min Price:</b></label>
        <input type="number" name="min" step="0.01" value="<?= htmlspecialchars($min) ?>">

        <label><b>Max Price:</b></label>
        <input type="number" step="0.01" name="max" value="<?= htmlspecialchars($max) ?>">

        <label><b>Location:</b></label>
        <input type="text" name="location" value="<?= htmlspecialchars($location) ?>">

        <button class="filter-btn" type="submit">Filter</button>
    </form>

    <!-- SELL POSTS -->
    <?php if ($type === '' || $type === 'sell'): ?>
    <h3>Sell Posts</h3>
    <div class="grid">
        <?php foreach ($sell_posts as $p): ?>
        <div class="card">
            <h4><?= htmlspecialchars($p['title']) ?></h4>
            <p><strong>Category:</strong> <?= htmlspecialchars($p['category']) ?></p>
            <p><strong>Quantity:</strong> <?= htmlspecialchars($p['quantity']) ?> <?= htmlspecialchars($p['unit']) ?></p>
            <p><strong>Price:</strong> Rs <?= htmlspecialchars($p['expected_price']) ?></p>
            <p><strong>Farmer:</strong> <?= htmlspecialchars($p['owner_name']) ?></p>
            <p><strong>Location:</strong> <?= htmlspecialchars($p['owner_address']) ?></p>
            <p><strong>Phone:</strong> <a href="tel:<?= $p['owner_phone'] ?>"><?= $p['owner_phone'] ?></a></p>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- BUY POSTS -->
    <?php if ($type === '' || $type === 'buy'): ?>
    <h3>Buy Posts</h3>
    <div class="grid">
        <?php foreach ($buy_posts as $p): ?>
        <div class="card">
            <h4><?= htmlspecialchars($p['title']) ?></h4>
            <p><strong>Category:</strong> <?= htmlspecialchars($p['category']) ?></p>
            <p><strong>Quantity:</strong> <?= htmlspecialchars($p['quantity']) ?></p>
            <p><strong>Expected Price:</strong> Rs <?= htmlspecialchars($p['expected_price']) ?></p>
            <p><strong>Buyer:</strong> <?= htmlspecialchars($p['owner_name']) ?></p>
            <p><strong>Location:</strong> <?= htmlspecialchars($p['owner_address']) ?></p>
            <p><strong>Phone:</strong> <a href="tel:<?= $p['owner_phone'] ?>"><?= $p['owner_phone'] ?></a></p>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- DELIVERY POSTS -->
    <?php if ($type === '' || $type === 'delivery'): ?>
    <h3>Delivery Providers</h3>
    <div class="grid">
        <?php foreach ($delivery_posts as $d): ?>
        <div class="card">
            <h4><?= htmlspecialchars($d['name']) ?></h4>
            <p><strong>Vehicle:</strong> <?= htmlspecialchars($d['vehicle_type']) ?></p>
            <p><strong>Capacity:</strong> <?= htmlspecialchars($d['loading_capacity']) ?></p>
            <p><strong>Rate:</strong> Rs <?= htmlspecialchars($d['rate_per_km']) ?>/km</p>
            <p><strong>Location:</strong> <?= htmlspecialchars($d['location']) ?></p>
            <p><strong>Phone:</strong> <a href="tel:<?= $d['phone'] ?>"><?= $d['phone'] ?></a></p>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

</div>

</body>
</html>
