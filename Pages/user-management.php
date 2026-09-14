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
<title>User Management — LocalMart</title>
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
    <a href="admin-dashboard.html">Home</a>
    <a href="shop-approval.html">Shops</a>
    <a href="user-management.html" class="active">Users</a>
    <a href="order-management.html">Orders</a>
    <a href="sales-analytics.html">Reports</a>
  </aside>

  <main class="main-content">
    <div class="page-header" style="margin:-26px -30px 20px;">User Management</div>

    <form action="user-management.html" method="get" class="flex-between mb-10">
      <input type="search" name="search" title="Search users" placeholder="Search users..." style="max-width:260px;">
      <select name="role" title="Filter by role" style="width:auto;">
        <option>All Roles</option>
        <option>Customer</option>
        <option>Shop Owner</option>
        <option>Delivery</option>
        <option>Admin</option>
      </select>
    </form>

    <table>
      <tr><th>Name</th><th>Role</th><th>Location</th><th>Status</th><th>Action</th></tr>
      <tr>
        <td>Shakil Ahmed</td><td>Customer</td><td>Mirpur</td>
        <td><span class="badge badge-open">Active</span></td><td><a href="#">Edit</a></td>
      </tr>
      <tr>
        <td>Karim Store</td><td>Shop Owner</td><td>Mirpur</td>
        <td><span class="badge badge-open">Active</span></td><td><a href="#">Edit</a></td>
      </tr>
      <tr>
        <td>Md. Hasan</td><td>Delivery</td><td>Mirpur</td>
        <td><span class="badge badge-open">Active</span></td><td><a href="#">Edit</a></td>
      </tr>
      <tr>
        <td>Noor Jahan</td><td>Shop Owner</td><td>Sylhet</td>
        <td><span class="badge badge-pending">Pending</span></td><td><a href="#">Review</a></td>
      </tr>
      <tr>
        <td>Rina Akter</td><td>Customer</td><td>Chittagong</td>
        <td><span class="badge badge-suspended">Suspended</span></td><td><a href="#">Restore</a></td>
      </tr>
    </table>
  </main>
</div>

<script src="../Java_Script/user-menu.js"></script>

</body>
</html>
