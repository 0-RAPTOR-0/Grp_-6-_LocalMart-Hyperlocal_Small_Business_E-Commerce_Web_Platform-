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
  <title>My Deliveries - Local Mart</title>
  <link rel="stylesheet" href="../Css/style.css">
</head>
<body>

<header class="navbar">

  <div class = "brand"><a href="../index.html" style = "color:#fff;">LocalMart — Delivery</a></div>
  <div class = "nav-right"><div class="user-menu">
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

<div class = "page-header">My Deliveries</div>

<div class = "container">
  <div class = "stat-grid">
    <div class = "stat-box"><div class = "value">3</div><div class = "label">Active</div></div>
    <div class = "stat-box"><div class = "value">18</div><div class = "label">Today Done</div></div>
    <div class = "stat-box"><div class = "value">৳ 540</div><div class = "label">Today Earn</div></div>

  </div>

  <div class = "section-title">New Assignments</div>
  <div class = "list-item" style = "flex-direction:column; align-items:stretch;">
  <div class = "flex-between">
    <strong>ORD-2841</strong>
    <span class = "badge badge-open">New</span>

  </div>
  
  <div class = "meta mt-10">Pickup: Karim Store, Mirpur-10</div>
  <div class = "meta">Deliver to: Road 5, Mirpur-12 (1.2km)</div>
  <div class = "btn-row mt-10">

    <form action = "delivery-status.html" method = "post" style = "flex:1;">
      <button type = "submit" class = "btn btn-primary">Accept</button>

    </form>

    <form action = "delivery-dashboard.html" method="post" style = "flex:1;">
      <button type = "submit" class = "btn btn-secondary">Reject</button>

    </form>
  </div>
</div>

  <div class = "section-title">In Progress</div>
  <div class = "list-item" style = "flex-direction:column; align-items:stretch;">
    <div class = "flex-between">
      <strong>ORD-2835</strong>
      <span class = "badge badge-pending">On the Way</span>
    </div>
    <div class = "meta mt-10">Delivering to: Mirpur-11, House 12</div>
    <a href = "delivery-status.html" class = "btn btn-primary mt-10">Mark Delivered</a>
  </div>
</div>

<script src="../Java_Script/user-menu.js"></script>
  
</body>
</html>