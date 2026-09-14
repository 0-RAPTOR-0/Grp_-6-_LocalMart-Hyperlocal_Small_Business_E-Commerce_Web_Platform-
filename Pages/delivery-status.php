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
  <title>Delivery - ORD 2841 - Local Mart</title>
  <link rel="stylesheet" href="../Css/style.css">
</head>
<body>

<header class = "navbar">
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

<div class = "page-header">Delivery — ORD-2841</div>
<div class = "container" style="max-width:600px;">

<div class = "summary-box">
  <strong>Order Details</strong>
  <div class = "meta mt-10">Customer: Shakil Ahmed</div>
  <div class = "meta">Phone: 01712-XXXXXX</div>
  <div class = "meta">Address: House 5, Road 3, Mirpur-12</div>
  <div class = "meta">Items: Rice 5kg, Mustard Oil 1L</div>

</div>

<form action ="delivery-dashboard.php" method = "post" novalidate>
  <div class = "section-title">Update Delivery Status</div>

  <fieldset>
    <legend>Delivery Status</legend>
    <div class = "form-group" style = "margin-bottom:10px;">
      <label><input type="radio" name = "status" value = "picked_up" checked> Picked Up from Shop</label>

    </div>

    <div class = "form-group" style = "margin-bottom:10px;">
      <label><input type="radio" name = "status" value = "on_the_way"> On the Way to Customer</label>

    </div>

    <div class = "form-group" style = "margin-bottom:0;">
      <label><input type = "radio" name = "status" value = "delivered"> Delivered Successfully</label>

    </div>

  </fieldset>

  <button type = "submit" class = "btn btn-primary">Update Status</button>
</form>
</div>

<script src="../Java_Script/user-menu.js"></script>

</body>
</html>