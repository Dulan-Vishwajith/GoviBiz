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
<title>Register - GramaBiz</title>
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
        align-items: center;
        position: relative;
    }

    /* Dark overlay */
    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
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
        letter-spacing: 2px;
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
        color: white;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        transition: .3s;
        z-index: 3;
    }
    .back-btn:hover {
        background: rgba(255,255,255,0.45);
        transform: translateY(-2px);
    }

    .form-box {
        width: 400px;
        background: rgba(255,255,255,0.92);
        padding: 35px;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.25);
        z-index: 3;
        animation: fadeUp .6s ease;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    h2 {
        text-align: center;
        margin-bottom: 18px;
        color: #2a4d2e;
        font-size: 24px;
    }

    label {
        font-size: 14px;
        font-weight: 500;
        color: #333;
        display: block;
        margin-top: 12px;
    }

    input, select {
        width: 100%;
        padding: 10px 12px;
        margin-top: 5px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 15px;
        transition: .25s;
        outline: none;
    }

    input:focus, select:focus {
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
<a href="../index.php" class="back-btn">⬅ Back</a>

<div class="form-box">
    <h2>Create Account</h2>

    <form action="submit_register.php" method="post">

        <label>User Role</label>
        <select name="role" id="roleSelect" required>
            <option value="">Select Role</option>
            <option value="farmer">Farmer</option>
            <option value="buyer">Buyer</option>
            <option value="delivery">Delivery Provider</option>
            <option value="agent">Agent</option>
        </select>

        <label>Name</label>
        <input type="text" name="name" required>

        <label>Address</label>
        <input type="text" name="address" required>

        <label>Contact Number</label>
        <input type="text" name="phone" required>

        <label>NIC Number</label>
        <input type="text" name="nic" required>

        <div id="buyerFields" style="display:none;">
            <label>Email (optional)</label>
            <input type="email" name="email_buyer">
        </div>

        <div id="deliveryFields" style="display:none;">
            <label>Email (optional)</label>
            <input type="email" name="email_delivery">
        </div>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Confirm Password</label>
        <input type="password" name="password2" required>

        <button type="submit">Register</button>
    </form>
</div>

<script>
let role = document.getElementById("roleSelect");
let buyerFields = document.getElementById("buyerFields");
let deliveryFields = document.getElementById("deliveryFields");

role.addEventListener("change", function() {
    buyerFields.style.display = "none";
    deliveryFields.style.display = "none";

    if (role.value === "buyer") buyerFields.style.display = "block";
    if (role.value === "delivery") deliveryFields.style.display = "block";
});
</script>

</body>
</html>
