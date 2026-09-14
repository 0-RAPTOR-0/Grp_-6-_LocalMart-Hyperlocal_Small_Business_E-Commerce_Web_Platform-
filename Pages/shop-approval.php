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
<title>Shop Approval Requests — LocalMart</title>
<link rel="stylesheet" href="../Css/style.css">
</head>
<body>

<header class="navbar">
  <div class="brand"><a href="../index.html" style="color:#fff;">LocalMart — Admin</a></div>
  <div class="nav-right"><div class="user-menu">
  <span class="user-name user-menu-trigger" onclick="toggleUserDropdown()"><?php echo htmlspecialchars($loggedInName); ?> &#9662;</span>
  
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

<div class="layout-with-sidebar">
  <aside class="sidebar">
    <a href="admin-dashboard.php">Home</a>
    <a href="shop-approval.php" class="active">Shops</a>
    <a href="user-management.php">Users</a>
    <a href="order-management.php">Orders</a>
    <a href="sales-analytics.php">Reports</a>
  </aside>

  <main class="main-content">
    <div class="page-header" style="margin:-26px -30px 20px;">Shop Approval Requests</div>

    <div class="list-item">
      <div class="info">
        <div class="name">Noor Handicrafts</div>
        <div class="meta">Category: Handicrafts • Sylhet, Bangladesh</div>
        <div class="meta">Owner: Noor Jahan • Registered: Today</div>
      </div>
      <form action="admin-dashboard.php" method="post"><button type="submit" class="btn btn-success btn-sm" style="width:auto;">Approve</button></form>
      <form action="admin-dashboard.php" method="post"><button type="submit" class="btn btn-danger btn-sm">Reject</button></form>
    </div>

    <div class="list-item">
      <div class="info">
        <div class="name">Fresh Farms BD</div>
        <div class="meta">Category: Grocery • Rajshahi, Bangladesh</div>
        <div class="meta">Owner: Kamal Hossain • Registered: Yesterday</div>
      </div>
      <form action="admin-dashboard.php" method="post"><button type="submit" class="btn btn-success btn-sm" style="width:auto;">Approve</button></form>
      <form action="admin-dashboard.php" method="post"><button type="submit" class="btn btn-danger btn-sm">Reject</button></form>
    </div>

    <div class="list-item">
      <div class="info">
        <div class="name">Dhaka Tailors</div>
        <div class="meta">Category: Clothing • Dhaka, Bangladesh</div>
        <div class="meta">Owner: Rashida Begum • Registered: 2 days ago</div>
      </div>
      <form action="admin-dashboard.php" method="post"><button type="submit" class="btn btn-success btn-sm" style="width:auto;">Approve</button></form>
      <form action="admin-dashboard.php" method="post"><button type="submit" class="btn btn-danger btn-sm">Reject</button></form>
    </div>
  </main>
</div>

<script src="../Java_Script/user-menu.js"></script>

</body>
</html>
