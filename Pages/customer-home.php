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
  <title>Home - Local Mart</title>
  <link rel="stylesheet" href="../Css/style.css">
</head>
<body>

<header class = "navbar">
  <div class = "brand">
    <a href = "../index.html" style = "color: #fff; text-decoration: none;">Local Mart</a>
  </div>

    <nav>
      <a href = "../php/browse.php">Browse</a>
      <a href = "order-history.html">Orders</a>
      <a href = "wishlist.html">Wishlist</a>
    </nav>

<div class = "nav-right">
<div class="user-menu">
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

<div class = "container">
  <form action = "../php/browse.php" method = "get">

    <div class = "search-bar" style = "max-width: 100%;">
      <label for = "q" class = "sr-only">Search Products or Shops</label>
      <input type = "text" id = "q" name = "q" title="Search Products or Shops" placeholder = "Search in Mirpur, Dhaka..." required>

      <button type = "submit">Go</button>
    </div>
  </form>

  <div class = "chip-row mt-20">
    <span class = "pill-filter active">All</span>
    <span class = "pill-filter">Grocery</span>
    <span class = "pill-filter">Clothing</span>
    <span class = "pill-filter">Crafts</span>
    <span class = "pill-filter">Food</span>

  </div>

  <div class = "section-title">Shops Near You</div>
  <div class = "card-grid">
  <div class = "card">
  <div class = "card-body">
    <div class = "name">Karim Store</div>
    <div class = "meta">Grocery 0.3km</div>
    <span class = "badge badge-open">Open</span>

  </div>
  </div>

  <div class = "card">
  <div class = "card-body">
    <div class = "name">Rina Boutique</div>
    <div class = "meta">Clothing 0.8km</div>
    <span class = "badge badge-open">Open</span>

  </div>
  </div>
  </div>

  <div class = "section-title">Featured Products</div>
  <div class = "card-grid">
  <div class = "card">
    <div class = "thumb">Lentils</div>
    <div class = "card-body">
      <div class = "name">Red Lentils 1kg</div>
      <div class = "price">৳ 95</div>

    </div>
  </div>
  
  <div class = "card">
    <div class = "thumb">Saree</div>
    <div class = "card-body">
      <div class = "name">Cotton Saree</div>
      <div class = "price">৳ 650</div>

    </div>
  </div>

  <div class = "card">
    <div class = "thumb">Snacks</div>
    <div class = "card-body">
      <div class = "name">Local Snacks</div>
      <div class = "price">৳ 60</div>

    </div>
  </div>
</div>
</div>

<script src="../Java_Script/user-menu.js"></script>

</body>
</html>