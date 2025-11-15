<?php
require_once 'config.php';
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Login - GramaBiz</title>
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

/* Form box */
.form-box {
    width: 380px;
    background: rgba(255,255,255,0.92);
    padding: 35px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    animation: fadeUp 0.6s ease;
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
    display: block;
    margin-top: 12px;
    font-weight: 500;
    color: #333;
}

input {
    width: 100%;
    padding: 10px 12px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 6px;
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
    background: #2a7d3c;
    border: none;
    color: white;
    font-size: 18px;
    margin-top: 20px;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #256e34;
}

a {
    color: #2a7d3c;
    font-weight: 600;
    text-decoration: none;
}
</style>
</head>

<body>

<!-- Logo -->
<div class="top-logo">ගොවිBiz🌾</div>

<!-- Back Button -->
<a href="../index.php" class="back-btn">⬅ Back</a>

<div class="form-box">
    <h2>Login</h2>

    <?php if (isset($_GET['error'])): ?>
        <p style="background:#ffdddd; padding:10px; border-left:4px solid red; color:#b30000; border-radius:5px;">
            Invalid phone number or password. Please try again.
        </p>
    <?php endif; ?>

    <form action="submit_login.php" method="post">
      <label>Phone</label>
      <input type="text" name="phone" required>

      <label>Password</label>
      <input type="password" name="password" required>

      <button type="submit">Login</button>
    </form>

    <p style="margin-top: 15px; text-align:center;">
        No account?
        <a href="register.php">Register</a>
    </p>
</div>

</body>
</html>
