<?php

require_once __DIR__ . '/.../php/db-connect.php';

function registerUser($conn, $name, $email, $password, $role, $phone, $address) {

  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password, role, phone, address)

     VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $hashedPassword, $role, $phone, $address);
    
    $success = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $success;

}

function emailExists($conn, $email) {

    $sql = "SELECT user_id FROM users WHERE email = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "s", $email);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $found = mysqli_num_rows($result) > 0;

    mysqli_stmt_close($stmt);

    return $found;

}

function findUserByEmail($conn, $email) {

    $sql = "SELECT * FROM users WHERE email = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "s", $email);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $user = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    return $user; 

}

function registerShop($conn, $ownerId, $shopName, $category, $location) {

    $sql = "INSERT INTO shops (owner_id, name, category, location, status)

     VALUES (?, ?, ?, ?, 'pending')";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "isss", $ownerId, $shopName, $category, $location);

    $success = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $success;

}

function getAllProducts($conn) {

    $sql = "SELECT p.*, s.name AS shop_name

    FROM products p

    JOIN shops s ON p.shop_id = s.shop_id

    ORDER BY p.created_at DESC";

    $result = mysqli_query($conn, $sql);

    $products = array();

    while ($row = mysqli_fetch_assoc($result)) {

        $products[] = $row;

    }

    return $products;

}

function getProductById($conn, $productId) {

    $sql = "SELECT p.*, s.name AS shop_name, s.location

    FROM products p

    JOIN shops s ON p.shop_id = s.shop_id

    WHERE p.product_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $productId);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $product = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    return $product;

}

function addProduct($conn, $shopId, $name, $category, $price, $stock, $description) {

    $sql = "INSERT INTO products (shop_id, name, category, price, stock, description)

    VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "issdis", $shopId, $name, $category, $price, $stock, $description);
    
    $success = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $success;

}

function getOrCreateCart($conn, $customerId) {

    $sql = "SELECT cart_id FROM carts WHERE customer_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $customerId);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $cart = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    if ($cart) {

        return $cart['cart_id'];
    }
    
    $sql2 = "INSERT INTO carts (customer_id) VALUES (?)";

    $stmt2 = mysqli_prepare($conn, $sql2);

    mysqli_stmt_bind_param($stmt2, "i", $customerId);

    mysqli_stmt_execute($stmt2);

    $newCartId = mysqli_insert_id($conn);

    mysqli_stmt_close($stmt2);

    return $newCartId;
}

function addToCart($conn, $cartId, $productId, $quantity) {

    $sql = "SELECT cart_item_id, quantity FROM cart_items WHERE cart_id = ? AND product_id = ?";
    
    $stmt = mysqli_prepare($conn, $sql);
    
    mysqli_stmt_bind_param($stmt, "ii", $cartId, $productId);
    
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    
    $existing = mysqli_fetch_assoc($result);
    
    mysqli_stmt_close($stmt);

    if ($existing) {

    $newQty = $existing['quantity'] + $quantity;

    $sql2 = "UPDATE cart_items SET quantity = ? WHERE cart_item_id = ?";
    
    $stmt2 = mysqli_prepare($conn, $sql2);
    
    mysqli_stmt_bind_param($stmt2, "ii", $newQty, $existing['cart_item_id']);
    
    $success = mysqli_stmt_execute($stmt2);
    m
    ysqli_stmt_close($stmt2);

    } else {
        
        $sql2 = "INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (?, ?, ?)";
        
        $stmt2 = mysqli_prepare($conn, $sql2);
        
        mysqli_stmt_bind_param($stmt2, "iii", $cartId, $productId, $quantity);
        
        $success = mysqli_stmt_execute($stmt2);
        
        mysqli_stmt_close($stmt2);

    }

    return $success;
}

function getCartItemCount($conn, $cartId) {
    
    $sql = "SELECT SUM(quantity) AS total FROM cart_items WHERE cart_id = ?";
    
    $stmt = mysqli_prepare($conn, $sql);
    
    mysqli_stmt_bind_param($stmt, "i", $cartId);
    
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    
    $row = mysqli_fetch_assoc($result);
    
    mysqli_stmt_close($stmt);
    
    return $row['total'] ? (int)$row['total'] : 0;
}

function placeOrder($conn, $customerId, $address, $city, $totalAmount, $paymentMethod, $cartItems) {
    
    $sql = "INSERT INTO orders (customer_id, status, total_amount, address, city)
        VALUES (?, 'placed', ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "idss", $customerId, $totalAmount, $address, $city);

    mysqli_stmt_execute($stmt);

    $orderId = mysqli_insert_id($conn);

    mysqli_stmt_close($stmt);

    foreach ($cartItems as $item) {

    $sql2 = "INSERT INTO order_items (order_id, product_id, quantity, price)
             VALUES (?, ?, ?, ?)";
    
    $stmt2 = mysqli_prepare($conn, $sql2);
    
    mysqli_stmt_bind_param($stmt2, "iiid", $orderId, $item['product_id'], $item['quantity'], $item['price']);
    
    mysqli_stmt_execute($stmt2);
    
    mysqli_stmt_close($stmt2);

    }

    $sql3 = "INSERT INTO payments (order_id, method, amount, status) VALUES (?, ?, ?, 'pending')";
    
    $stmt3 = mysqli_prepare($conn, $sql3);
    
    mysqli_stmt_bind_param($stmt3, "isd", $orderId, $paymentMethod, $totalAmount);
    
    mysqli_stmt_execute($stmt3);
    
    mysqli_stmt_close($stmt3);

    return $orderId;
}

function getCartItemsWithProducts($conn, $cartId) {
    
    $sql = "SELECT ci.product_id, ci.quantity, p.name, p.price
            FROM cart_items ci
            JOIN products p ON ci.product_id = p.product_id
            WHERE ci.cart_id = ?";
    
    $stmt = mysqli_prepare($conn, $sql);
    
    mysqli_stmt_bind_param($stmt, "i", $cartId);
    
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    
    $items = array();
    
    while ($row = mysqli_fetch_assoc($result)) {

        $items[] = $row;

    }

    mysqli_stmt_close($stmt);

    return $items;

}


?>