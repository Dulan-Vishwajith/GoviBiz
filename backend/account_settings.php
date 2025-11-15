<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch logged user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Account Settings - ගොවිBiz🌾</title>
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
    color: #fff;
    font-size: 42px;
    font-weight: 700;
    z-index: 3;
    text-shadow: 1px 1px 10px black;
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
    transition: 0.3s;
    z-index: 3;
}

.back-btn:hover {
    background: rgba(255,255,255,0.45);
    transform: translateY(-2px);
}

/* Glass UI container */
.settings-box {
    width: 90%;
    max-width: 800px;
    margin: 120px auto 40px;
    background: rgba(255,255,255,0.18);
    padding: 30px;
    border-radius: 18px;
    backdrop-filter: blur(8px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.35);
    z-index: 3;
    position: relative;
    animation: fadeUp 0.7s ease;
}

/* Animations */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Headings */
h2, h3 {
    color: #fff;
    text-shadow: 1px 1px 6px black;
}

/* Inputs */
input {
    width: 100%;
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
    margin-top: 6px;
    font-size: 15px;
    transition: 0.25s;
}

input:focus {
    border-color: #2a7d3c;
    box-shadow: 0 0 0 2px rgba(42,125,60,0.2);
}

/* Buttons */
button {
    background: #2a7d3c;
    color: white;
    border: none;
    padding: 12px 18px;
    border-radius: 8px;
    margin-top: 15px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #256e34;
}

/* Delete button */
.delete-btn {
    background: red !important;
}

hr {
    border: 0;
    border-top: 1px solid #ffffff55;
    margin: 25px 0;
}

label {
    color: #fff;
    font-weight: 500;
    margin-top: 12px;
    display: block;
}
</style>

</head>
<body>

<!-- Logo -->
<div class="top-logo">ගොවිBiz🌾</div>

<!-- Back Button -->
<a href="dashboard.php" class="back-btn">⬅ Back</a>

<!-- Page Content -->
<div class="settings-box">

<h2>Account Settings</h2>

<!-- EDIT PROFILE -->
<h3>Edit Profile</h3>

<form action="update_profile.php" method="post">

    <label>Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>

    <label>Address:</label>
    <input type="text" name="address" value="<?= htmlspecialchars($user['address']) ?>" required>

    <label>Phone Number:</label>
    <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required>

    <label>NIC:</label>
    <input type="text" name="nic" value="<?= htmlspecialchars($user['nic']) ?>" required>

    <?php if ($user['role'] === 'buyer' || $user['role'] === 'delivery' || $user['role'] === 'agent'): ?>
        <label>Email (Optional):</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>">
    <?php endif; ?>

    <button type="submit">Save Changes</button>
</form>

<hr>

<!-- CHANGE PASSWORD -->
<h3>Change Password</h3>

<form action="change_password.php" method="post">

    <label>Current Password:</label>
    <input type="password" name="old_password" required>

    <label>New Password:</label>
    <input type="password" name="new_password" required>

    <label>Confirm New Password:</label>
    <input type="password" name="new_password2" required>

    <button type="submit">Update Password</button>
</form>

<hr>

<!-- DELETE ACCOUNT -->
<h3>Delete Account</h3>

<form action="delete_account.php" method="post"
      onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">

    <button type="submit" class="delete-btn">Delete My Account</button>
</form>

</div>

</body>
</html>
