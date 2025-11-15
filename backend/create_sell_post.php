<?php
require_once 'config.php';

/*
----------------------------------------------------
 ALLOW:
 - Real Farmer
 - Agent acting as a farmer
----------------------------------------------------
*/

$allowed = false;
$farmer_id = null;

// Real farmer
if (isset($_SESSION['role']) && $_SESSION['role'] === 'farmer') {
    $allowed = true;
    $farmer_id = $_SESSION['user_id'];
}

// Agent managing a farmer
elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'agent' && isset($_SESSION['acting_as_farmer'])) {
    $allowed = true;
    $farmer_id = $_SESSION['acting_as_farmer'];
}

// Not allowed
if (!$allowed) {
    die("Only farmers or agents managing farmers can create sell posts.");
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Create Sell Post</title>
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
        color: #fff;
        font-size: 42px;
        font-weight: 700;
        text-shadow: 1px 1px 10px black;
        z-index: 3;
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

    input, textarea, select {
        width: 100%;
        padding: 10px 12px;
        margin-top: 5px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 15px;
        transition: .25s;
        outline: none;
    }

    input:focus, textarea:focus, select:focus {
        border-color: #2a7d3c;
        box-shadow: 0 0 0 2px rgba(42,125,60,0.2);
    }

    textarea {
        height: 80px;
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

    .footer {
        width: 100%;
        text-align: center;
        padding: 12px 0;
        background: rgba(0,0,0,0.6);
        color: #fff;
        font-size: 14px;
        font-weight: 500;
        position: fixed;
        bottom: 0;
        left: 0;
        backdrop-filter: blur(5px);
        z-index: 10;
        text-shadow: 1px 1px 4px black;
    }
</style>
</head>

<body>

<!-- Logo -->
<div class="top-logo">ගොවිBiz🌾</div>

<!-- Back Button -->
<a href="dashboard.php" class="back-btn">⬅ Back</a>

<div class="form-box">
<h2>Create Sell Post</h2>

<form action="submit_sell_post.php" method="post">

<input type="hidden" name="farmer_id" value="<?= htmlspecialchars($farmer_id) ?>">

<label>Title</label>
<input type="text" name="title" required>

<label>Category</label>
<input type="text" name="category" required>

<label>Quantity</label>
<input type="number" name="quantity" required>

<label>Unit</label>
<input type="text" name="unit" value="kg">

<label>Expected Price (LKR Per Unit)</label>
<input type="number" step="0.01" name="price" required>

<label>Harvest From</label>
<input type="date" name="harvest_from">

<label>Harvest To</label>
<input type="date" name="harvest_to">

<label>Description</label>
<textarea name="description"></textarea>

<button type="submit">Post</button>
</form>
</div>



</body>
</html>
