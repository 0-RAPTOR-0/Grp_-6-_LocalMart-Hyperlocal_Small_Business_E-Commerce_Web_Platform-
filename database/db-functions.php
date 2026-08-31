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

