<?php
require_once 'config.php';
if ($_SESSION['role'] !== 'delivery') {
    die("Only delivery providers can create posts");
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Create Delivery Post - ගොවිBiz🌾</title>
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
    background: rgba(255,255,255,0.4);
    transform: translateY(-2px);
}

/* Form box */
.form-box {
    width: 430px;
    background: rgba(255,255,255,0.92);
    padding: 35px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    animation: fadeUp .6s ease;
    z-index: 3;
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #2a4d2e;
}

label {
    font-size: 14px;
    font-weight: 500;
    color: #333;
    display: block;
    margin-top: 12px;
}

input {
    width: 100%;
    padding: 10px 12px;
    margin-top: 5px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 15px;
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
    border: none;
    border-radius: 6px;
    font-size: 18px;
    background: #2a7d3c;
    color: #fff;
    cursor: pointer;
    transition: 0.3s;
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
<a href="dashboard.php" class="back-btn">⬅ Back</a>

<div class="form-box">
<h2>Create Delivery Post</h2>

<form action="submit_delivery_post.php" method="post">

<label>Vehicle Type</label>
<input type="text" name="vehicle_type" required>

<label>Loading Capacity</label>
<input type="text" name="loading_capacity" required>

<label>Rate (LKR per 1KM)</label>
<input type="number" step="0.01" name="rate" required>

<label>Location / Address</label>
<input type="text" name="location" required>

<button type="submit">Post</button>
</form>

</div>

</body>
</html>
