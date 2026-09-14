<?php

session_start();

  if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: login.html");
    exit;
  }

  $loggedInName = $_SESSION["user_name"];
  $loggedInEmail = isset($_SESSION["user_email"]) ? $_SESSION["user_email"] : "";
  $loggedInPhone = isset($_SESSION["user_phone"]) ? $_SESSION["user_phone"] : "";
  $loggedInRole  = isset($_SESSION["user_role"]) ? $_SESSION["user_role"] : "";
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - Local Mart</title>
  <link rel="stylesheet" href="../Css/style.css">
</head>
<body>

<header class = "navbar">

<div class = "brand"><a href = "../index.html" style = "color: #fff;"> Local Mart - Admin</a></div>
<div class = "nav-right">
  <div class = "user-menu">
    <span class = "user-name user-menu-trigger" onclick = "toggleUserDropdown()"<?php echo htmlspecialchars($loggedInName); ?> &#9662;</span>
  <div class="user-dropdown" id="userDropdown">

    <p><strong>Name</strong><?php echo htmlspecialchars($loggedInName); ?></p>
    <p><strong>Email</strong><?php echo htmlspecialchars($loggedInEmail); ?></p>
    <p><strong>Phone</strong><?php echo htmlspecialchars($loggedInPhone); ?></p>
    <p><strong>Role</strong><?php echo htmlspecialchars(ucwords(str_replace('_',' ',$loggedInRole))); ?></p>
    <hr>

    <a href="../php/logout.php" class="btn btn-secondary btn-sm">Logout</a>

  </div>

</div>

</div>
</header>

<div class = "layout-with-sidebar">
  <aside class = "sidebar">

    <a href = "admin-dashboard.php" class = "active">Home</a>
    <a href = "shop-approval.php">Shops</a>
    <a href = "user-management.php">Users</a>
    <a href = "order-management.php">Orders</a>
    <a href = "sales-analytics.php">Reports</a>

  </aside>

  <main class = "main-content">
    <div class = "section-title" style = "margin-top: 0px;">Platform Overview</div>
    <div class = "stat-grid">
      <div class = "stat-box">
        <div class = "value">128</div>
        <div class = "label">Total Users</div>
      </div>
      
      <div class = "stat-box">
        <div class = "value">84</div>
        <div class = "label">Active Shops</div>
      </div>

      <div class = "stat-box">
        <div class = "value">3,640</div>
        <div class = "label">Total Orders</div>
      </div>

      <div class = "stat-box">
        <div class = "value">৳ 4.8L</div>
        <div class = "label">Total Revenue</div>
      </div>

    </div>

    <div class = "section-title">Pending Actions</div>
    <div class = "alert-box alert-warning">5 shop approval requests pending</div>
    <div class = "alert-box alert-danger">2 unsolved customer disputes</div>
  </main>
</div>

<script src="../Java_Script/user-menu.js"></script>

</body>
</html>