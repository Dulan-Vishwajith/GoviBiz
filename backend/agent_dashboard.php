<?php
require_once 'config.php';

// Only agent can access this page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'agent') {
    die("Unauthorized access.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Agent Dashboard - ගොවිBiz🌾</title>
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
    font-weight: 600;
    backdrop-filter: blur(5px);
    border-radius: 8px;
    color: white;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    transition: .3s;
    z-index: 4;
}
.back-btn:hover {
    background: rgba(255,255,255,0.45);
    transform: translateY(-2px);
}

/* Glass Container */
.dash-container {
    width: 90%;
    max-width: 900px;
    margin: 120px auto 40px;
    background: rgba(255,255,255,0.18);
    padding: 35px;
    border-radius: 18px;
    backdrop-filter: blur(8px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.35);
    z-index: 3;
    position: relative;
    animation: fadeUp .7s ease;
}

/* Fade animation */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

h2 {
    color: #fff;
    text-shadow: 1px 1px 6px black;
}

.notice {
    background: rgba(255,80,80,0.3);
    padding: 10px 15px;
    border-left: 4px solid red;
    border-radius: 6px;
    color: #fff;
    font-weight: 600;
    margin-bottom: 20px;
}

/* Action Grid */
.action-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin-top: 25px;
}

/* Action Cards */
.card-btn {
    background: rgba(255,255,255,0.85);
    padding: 20px;
    text-align: center;
    border-radius: 12px;
    font-weight: 700;
    color: #2a4d2e;
    text-decoration: none;
    font-size: 18px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.25);
    transition: 0.25s;
}

.card-btn:hover {
    transform: translateY(-5px);
    background: #ffffff;
    box-shadow: 0 6px 20px rgba(0,0,0,0.35);
}

/* Logout Button Special */
.card-btn.logout {
    background: #c53030;
    color: white;
}
.card-btn.logout:hover {
    background: #9b2626;
}
</style>

</head>

<body>

<!-- Logo -->
<div class="top-logo">ගොවිBiz🌾</div>

<!-- Back Button -->
<a href="../index.php" class="back-btn">⬅ Back</a>

<!-- MAIN CONTENT BOX -->
<div class="dash-container">

    <h2>Welcome, Agent <?= htmlspecialchars($_SESSION['name']) ?> 👋</h2>

    <?php if (isset($_SESSION['acting_as_farmer'])): ?>
        <div class="notice">
            You are currently managing farmer ID <?= $_SESSION['acting_as_farmer'] ?>.
        </div>
        <a href="stop_acting.php" 
           style="background:red;color:white;padding:10px 15px;border-radius:6px;text-decoration:none;">
            Exit Farmer Mode
        </a>
        <br><br>
    <?php endif; ?>

    <!-- Action Buttons Grid -->
    <div class="action-grid">

        <a href="agent_create_farmer.php" class="card-btn">
            ➕ Create Farmer
        </a>

        <a href="agent_farmers.php" class="card-btn">
            👨‍🌾 My Farmers
        </a>

        <a href="view_posts.php" class="card-btn">
            📄 View All Posts
        </a>

        <a href="account_settings.php" class="card-btn">
            ⚙️ Account Settings
        </a>

        <a href="logout.php" class="card-btn logout">
            🚪 Logout
        </a>

    </div>

</div>

</body>
</html>
