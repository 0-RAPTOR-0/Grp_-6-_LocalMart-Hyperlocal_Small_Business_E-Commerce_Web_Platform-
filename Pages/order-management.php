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
  <title>Order Management - Local Mart</title>
  <link rel="stylesheet" href="../Css/style.css">
</head>
<body>

<header class ="navbar">
  <div class = "brand"><a href = "../index.html" style = "color:#fff;">Local Mart - Seller</a></div>
  <div class = "nav-right"><div class = "user-menu">
  <span class = "user-name user-menu-trigger" onclick = "toggleUserDropdown()"><?php echo htmlspecialchars($loggedInName); ?> &#9662;</span>
  <div class = "user-dropdown" id = "userDropdown">
    
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
    <a  href = "seller-dashboard.html">Home</a>
    <a href = "product-form.html">Products</a>
    <a href = "order-management.html" class = "active">Orders</a>
    <a href = "sales-analytics.html">Analytics</a>

  </aside>

  <main class = "main-content">
    <div class = "page-header" style = "margin: -26px -30px 20px;">Order Management</div>

    <div class = "chip-row">
      <span class = "pill-filter active">All (12)</span>
      <span class = "pill-filter">Pending (5)</span>
      <span class = "pill-filter">Dispatched (3)</span>
      <span class = "pill-filter">Done (4)</span>

    </div>

    <table class = "mt-20">

      <tr><th>Order ID</th><th>Customer</th><th>Items</th><th>Total</th><th>Status</th><th>Action</th></tr>

      <tr>
        <td>ORD-2841</td><td>Shakil</td><td>Rice 5kg</td><td>৳ 795</td>
        <td><span class = "badge badge-pending">Pending</span></td>
        <td><a href = "#">Accept</a></td>

      </tr>

      <tr>
        <td>ORD-2840</td><td>Rafiq</td><td>Oil 1L x2</td><td>৳ 250</td>
        <td><span class = "badge badge-open">Confirmed</span></td>
        <td><a href = "#">Dispatch</a></td>

      </tr>

      <tr>
        <td>ORD-2839</td><td>Mitu</td><td>Spices</td><td>৳ 400</td>
        <td><span class = "badge badge-done">Delivered</span></td>
        <td>Done</td>

      </tr>

      <tr>
        <td>ORD-2838</td><td>Rina</td><td>Dal 2kg</td><td>৳ 300</td>
        <td><span class = "badge badge-pending">Pending</span></td>
        <td><a href = "#">Accept</a></td>

      </tr>

    </table>
  </main>
</div>

<script src="../Java_Script/user-menu.js"></script>

</body>
</html>