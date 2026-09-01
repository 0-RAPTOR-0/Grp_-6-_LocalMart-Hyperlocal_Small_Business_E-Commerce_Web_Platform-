<?php

require_once __DIR__ . '/../models/db_functions.php';

$products = getAllProducts($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Browse Products — LocalMart</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header class="navbar">
  <div class="brand"><a href="../index.html" style="color:#fff;">LocalMart</a></div>
  <nav>
    <a href="browse.php">Browse</a>
    <a href="order-history.html">Orders</a>
    <a href="wishlist.html">Wishlist</a>
  </nav>
  <div class="nav-right"><span class="user-name">Shakil</span></div>
</header>

<div class="layout-with-sidebar">
  <aside class="sidebar">
    <a href="#" class="active">All</a>
    <a href="#">Grocery</a>
    <a href="#">Clothing</a>
    <a href="#">Crafts</a>
    <a href="#">Food</a>
  </aside>

  <main class="main-content">
    <div class="flex-between">
      <div><?php echo count($products); ?> products found</div>
      <form action="#" method="get">
        <label for="sort" style="display:inline;">Sort:</label>
        <select id="sort" name="sort" title="Sort products" style="width:auto;display:inline-block;">
          <option>Price: Low to High</option>
          <option>Price: High to Low</option>
          <option>Newest</option>
        </select>
      </form>
    </div>

    <div class="card-grid">
      <?php if (empty($products)): ?>

        <p>No products found. Please check back later.</p>

      <?php else: ?>
        <?php foreach ($products as $product): ?>

          <a href="product-detail.html?id=<?php echo $product['product_id']; ?>" style="text-decoration:none;color:inherit;">
            <div class="card">
              <div class="thumb"><?php echo htmlspecialchars($product['name']); ?></div>
              <div class="card-body">
                <div class="name"><?php echo htmlspecialchars($product['name']); ?></div>
                <div class="price">৳ <?php echo number_format($product['price'], 0); ?></div>
                <div class="meta"><?php echo htmlspecialchars($product['shop_name']); ?></div>
              </div>
            </div>
          </a>

        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </main>
</div>


</body>
</html>
