<?php
require_once 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'agent') {
    die("Unauthorized.");
}

$agent_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE role='farmer' AND created_by_agent = ?");
$stmt->execute([$agent_id]);
$farmers = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Farmers</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<div class="container">
<h2>Your Farmers</h2>

<a class="btn" href="agent_create_farmer.php">Create New Farmer</a>
<br><br>

<div class="grid">
<?php foreach ($farmers as $f): ?>
<div class="card">
    <h3><?= htmlspecialchars($f['name']) ?></h3>
    <p><strong>NIC:</strong> <?= $f['nic'] ?></p>
    <p><strong>Phone:</strong> <?= $f['phone'] ?></p>
    <p><strong>Location:</strong> <?= $f['address'] ?></p>

    <a class="btn" href="agent_manage_farmer.php?id=<?= $f['user_id'] ?>">Manage Farmer</a>
</div>
<?php endforeach; ?>
</div>

</div>
</body>
</html>a<?php
require_once 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'agent') {
    die("Unauthorized.");
}

$agent_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE role='farmer' AND created_by_agent = ?");
$stmt->execute([$agent_id]);
$farmers = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>My Farmers - ගොවිBiz🌾</title>
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
    padding: 10px 20px;
    background: rgba(255,255,255,0.25);
    backdrop-filter: blur(5px);
    border-radius: 8px;
    color: white;
    text-decoration: none;
    font-weight: 600;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
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
    max-width: 1100px;
    margin: 120px auto 40px;
    background: rgba(255,255,255,0.18);
    padding: 30px;
    border-radius: 18px;
    backdrop-filter: blur(8px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.35);
    z-index: 3;
    position: relative;
    animation: fadeUp .7s ease;
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

h2 {
    color: #fff;
    text-shadow: 1px 1px 6px black;
    margin-bottom: 20px;
    text-align: center;
}

/* Create Farmer Button */
.create-btn {
    display: inline-block;
    background: #2a7d3c;
    color: #fff;
    padding: 12px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    transition: 0.3s;
    margin-bottom: 20px;
}
.create-btn:hover {
    background: #256e34;
    transform: translateY(-2px);
}

/* Grid */
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 20px;
}

/* Cards */
.card {
    background: rgba(255,255,255,0.94);
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.25);
    transition: 0.3s;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.35);
}

.card h3 {
    margin-top: 0;
    color: #2a4d2e;
}

.card p {
    margin: 6px 0;
    color: #333;
}

/* Manage Button */
.manage-btn {
    display: inline-block;
    background: #2b6cb0;
    color: white;
    padding: 10px 18px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    margin-top: 10px;
    transition: .3s;
}
.manage-btn:hover {
    background: #1a4f80;
}
</style>

</head>

<body>

<!-- Logo -->
<div class="top-logo">ගොවිBiz🌾</div>

<!-- Back Button -->
<a href="agent_dashboard.php" class="back-btn">⬅ Back</a>

<div class="container">

    <h2>Your Farmers</h2>

    <a class="create-btn" href="agent_create_farmer.php">➕ Create New Farmer</a>

    <div class="grid">
    <?php foreach ($farmers as $f): ?>
        <div class="card">
            <h3><?= htmlspecialchars($f['name']) ?></h3>
            <p><strong>NIC:</strong> <?= htmlspecialchars($f['nic']) ?></p>
            <p><strong>Phone:</strong> <?= htmlspecialchars($f['phone']) ?></p>
            <p><strong>Location:</strong> <?= htmlspecialchars($f['address']) ?></p>

            <a class="manage-btn" href="agent_manage_farmer.php?id=<?= $f['user_id'] ?>">
                Manage Farmer
            </a>
        </div>
    <?php endforeach; ?>
    </div>

</div>

</body>
</html>

