<?php
require_once 'config.php';

// Redirect agent directly
if (isset($_SESSION['role']) && $_SESSION['role'] === 'agent') {
    header("Location: agent_dashboard.php");
    exit;
}

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$uid = $_SESSION['user_id'];
$role = $_SESSION['role'];
$name = $_SESSION['name'];

// get user's posts count
$stmt = $pdo->prepare("SELECT COUNT(*) FROM posts WHERE user_id = ?");
$stmt->execute([$uid]);
$count = $stmt->fetchColumn();
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Dashboard - <?= htmlspecialchars($name) ?></title>
<link rel="stylesheet" href="../assets/css/styles.css">

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: "Poppins", sans-serif;
        background: url("../assets/images/farm-bg.jpg") center/cover no-repeat;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        position: relative;
    }

    /* Dark overlay */
    body::before {
        content: "";
        position: absolute;
        top: 0; left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.55);
        z-index: 1;
    }

    /* Logo */
    .top-logo {
        position: absolute;
        top: 30px;
        left: 40px;
        z-index: 3;
        color: #fff;
        font-size: 42px;
        font-weight: 700;
        text-shadow: 1px 1px 10px black;
    }

    /* Back Button */
    .back-btn {
        position: absolute;
        top: 30px;
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
        background: rgba(255,255,255,0.40);
        transform: translateY(-2px);
    }

    /* Dashboard container */
    .dashboard-box {
        width: 80%;
        max-width: 900px;
        margin-top: 120px;
        background: rgba(255,255,255,0.92);
        padding: 30px;
        border-radius: 14px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.25);
        animation: fadeUp .7s ease;
        z-index: 3;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    h2 {
        margin: 0;
        font-size: 26px;
        color: #2a4d2e;
        font-weight: 700;
    }

    nav {
        margin-top: 15px;
    }

    nav .btn {
        padding: 10px 15px;
        background: #2a7d3c;
        color: #fff;
        border-radius: 6px;
        margin-right: 10px;
        text-decoration: none;
        transition: 0.3s;
    }

    nav .btn:hover {
        background: #256e34;
    }

    .card {
        background: #fff;
        padding: 20px;
        margin-top: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        animation: fadeUp .6s ease;
    }

</style>
</head>

<body>

<!-- Logo -->
<div class="top-logo">ගොවිBiz🌾</div>

<!-- Back Button -->
<a href="../index.php" class="back-btn">⬅ Back</a>

<div class="dashboard-box">
    
    <h2>Welcome, <?= htmlspecialchars($name) ?> (<?= htmlspecialchars($role) ?>)</h2>

    <nav>
        <?php if ($role === 'farmer'): ?>
            <a class="btn" href="create_sell_post.php">Create Sell Post</a>
        <?php elseif ($role === 'buyer'): ?>
            <a class="btn" href="create_buy_post.php">Create Buy Post</a>
        <?php elseif ($role === 'delivery'): ?>
            <a class="btn" href="create_delivery_post.php">Create Delivery Post</a>
        <?php endif; ?>

        <a class="btn" href="view_posts.php">View All Posts</a>
        <a class="btn" href="view_delivery.php">View Delivery Providers</a>
        <a class="btn" href="account_settings.php">Account Settings</a>
        <a class="btn" href="logout.php">Logout</a>
    </nav>

    <div class="card">
        <h3>Your Posts</h3>
        <p>Total posts: <?= intval($count) ?></p>
    </div>

    <?php if ($role === 'farmer'): ?>
        <div class="card">
          <h3>Farmer Tips</h3>
          <p>Include harvest date, minimum price, and crop details.</p>
        </div>
    <?php elseif ($role === 'buyer'): ?>
        <div class="card">
          <h3>Buyer Tips</h3>
          <p>Mention expected price and delivery preferences.</p>
        </div>
    <?php else: ?>
        <div class="card">
          <h3>Agent Dashboard</h3>
          <p>Agents can register farmers and manage their posts.</p>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
