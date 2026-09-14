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
<title>Add New Product — LocalMart</title>
<link rel="stylesheet" href="../Css/style.css">
</head>
<body>

<header class = "navbar">
  <div class = "brand"><a href="../index.html" style = "color:#fff;">LocalMart — Seller</a></div>
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

<div class="layout-with-sidebar">
  <aside class="sidebar">
    <a href="seller-dashboard.html">Home</a>
  <a href="product-form.html" class="active">Products</a>
   <a href="order-management.html">Orders</a>
    <a href="sales-analytics.html">Analytics</a>
 </aside>

  <main class="main-content">
    <div class="page-header" style="margin:-26px -30px 20px;">Add New Product</div>

    <div id="formMessage"></div>

      <form id="productForm" action="../controller/product_controller.php" method="post" enctype="multipart/form-data" novalidate>
      <div class="form-group">
        <label for="pname">Product Name</label>
        <input type="text" id="pname" name="pname" title="Product Name" placeholder="Enter product name" required>
      </div>

      <div class="form-group">
        <label for="pcategory">Category</label>
        <select id="pcategory" name="pcategory" title="Category" required>
          <option>Grocery</option>
          <option>Clothing</option>
          <option>Handicrafts</option>
          <option>Electronics</option>
          <option>Food</option>
        </select>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="pprice">Price (৳)</label>
          <input type="number" id="pprice" name="pprice" title="Price" placeholder="0.00" min="0" step="0.01" required>
          <small class="error-text" id="ppriceError"></small>
        </div>
        <div class="form-group">
          <label for="pstock">Stock Qty</label>
          <input type="number" id="pstock" name="pstock" title="Stock Quantity" placeholder="0" min="0" required>
          <small class="error-text" id="pstockError"></small>
        </div>
      </div>

      <div class="form-group">
        <label for="pdesc">Description</label>
        <textarea id="pdesc" name="pdesc" title="Description" placeholder="Describe your product..."></textarea>
      </div>

      <div class="form-group">
        <label for="pimage">Product Image</label>
        <input type="file" id="pimage" name="pimage" title="Product Image" accept="image/png, image/jpeg">
      </div>

      <div class="btn-row">
        <button type="submit" class="btn btn-primary" style="width:auto; flex:1;">Save Product</button>
        <button type="button" class="btn btn-secondary" style="flex:1;">Save Draft</button>
      </div>
    </form>
  </main>
</div>

<script src="../Java_Script/validate.js"></script>
<script src="../Java_Script/user-menu.js"></script>


</body>
</html>
