<?php
require_once 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'agent') {
    die("Unauthorized.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Create Farmer - ගොවිBiz🌾</title>
<link rel="stylesheet" href="../assets/css/styles.css">

<style>
/* Background */
body {
    margin: 0;
    padding: 0;
    font-family: "Poppins", sans-serif;
    background: url("../assets/images/farm-bg.jpg") center/cover no-repeat fixed;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
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
    position: absolute;
    top: 30px;
    left: 40px;
    color: white;
    font-size: 42px;
    font-weight: 700;
    z-index: 3;
    text-shadow: 1px 1px 10px black;
}

/* Back button */
.back-btn {
    position: absolute;
    top: 30px;
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
    z-index: 3;
}
.back-btn:hover {
    background: rgba(255,255,255,0.45);
    transform: translateY(-2px);
}

/* Form Box */
.form-box {
    width: 450px;
    background: rgba(255,255,255,0.92);
    padding: 35px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    animation: fadeUp .6s ease;
    z-index: 3;
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

h2 {
    margin: 0 0 15px;
    text-align: center;
    color: #2a4d2e;
}

label {
    font-size: 14px;
    font-weight: 500;
    display: block;
    margin-top: 12px;
    color: #333;
}

input {
    width: 100%;
    padding: 10px 12px;
    margin-top: 5px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 15px;
    outline: none;
    transition: .25s;
}
input:focus {
    border-color: #2a7d3c;
    box-shadow: 0 0 0 2px rgba(42,125,60,0.2);
}

button {
    width: 100%;
    padding: 12px;
    margin-top: 20px;
    background: #2a7d3c;
    border: none;
    border-radius: 6px;
    font-size: 18px;
    color: white;
    cursor: pointer;
    transition: .3s;
}
button:hover {
    background: #256e34;
}
</style>

</head>
<body>

<!-- Logo -->
<div class="top-logo">ගොවිBiz🌾</div>

<!-- Back Button -->
<a href="agent_dashboard.php" class="back-btn">⬅ Back</a>

<div class="form-box">
    <h2>Create Farmer</h2>

    <form action="agent_submit_farmer.php" method="post">

        <label>Farmer Name</label>
        <input type="text" name="name" required>

        <label>NIC Number</label>
        <input type="text" name="nic" required>

        <label>Contact Number</label>
        <input type="text" name="phone" required>

        <label>Location</label>
        <input type="text" name="location" required>

        <button type="submit">Create Farmer</button>
    </form>
</div>

</body>
</html>
