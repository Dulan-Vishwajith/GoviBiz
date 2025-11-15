<?php
// index.php
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>GramaBiz - Village Market Connect</title>

  <!-- Link your main styles.css -->
  <link rel="stylesheet" href="assets/css/styles.css">

  <style>
    /* Full background image */
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: url('assets/images/farm-bg.jpg') center/cover no-repeat fixed;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      backdrop-filter: blur(1px);
    }

    /* Dark transparent overlay */
    .overlay {
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.45);
      z-index: 1;
    }

    /* Main container */
    .container {
      position: relative;
      z-index: 2;
      text-align: center;
      background: rgba(255,255,255,0.15);
      padding: 40px 50px;
      border-radius: 12px;
      backdrop-filter: blur(5px);
      box-shadow: 0px 8px 25px rgba(0,0,0,0.3);
      width: 85%;
      max-width: 500px;
      animation: fadeIn 1s ease-in-out;
    }

    /* Heading */
    .container h1 {
      font-size: 5rem;
      margin-bottom: 6px;
      color: #ffffff;
      text-shadow: 1px 1px 10px black;
    }
    .container h3 {
      font-size: 1.4rem;
      margin-bottom: 6px;
      color: #8c8c8fff;
      text-shadow: 1px 1px 1px gray;
    }

    /* Subtitle */
    .container p {
      color: #f0f0f0;
      font-size: 1.2rem;
      margin-bottom: 30px;
    }

    /* Buttons container */
    .buttons {
      display: flex;
      justify-content: center;
      gap: 20px;
    }

    /* Buttons */
    .btn {
      text-decoration: none;
      padding: 12px 28px;
      border-radius: 6px;
      background: #2d72d9;
      color: white;
      font-size: 1.1rem;
      font-weight: bold;
      transition: 0.25s;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.3);
    }

    .btn:hover {
      background: #1d56a8;
      transform: translateY(-2px);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>

</head>
<body>

  <div class="overlay"></div>

  <div class="container">
    <h1>ගොවිBiz🌾</h1>
    <h3>By QuadX</h3>
    <p>Connect Farmers, Buyers, Agents and Delivery Partners.</p>

    <div class="buttons">
      <a class="btn" href="backend/register.php">Register</a>
      <a class="btn" href="backend/login.php">Login</a>
    </div>
  </div>

</body>
</html>
