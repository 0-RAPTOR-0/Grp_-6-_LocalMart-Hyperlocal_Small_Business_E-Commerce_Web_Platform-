<?php

session_start();
require_once __DIR__ . '/../../php/db_functions.php';

header('Content-Type: application/json');


if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    echo json_encode([
        "success" => false,
        "message" => "Please sign in first to add items to your cart."
    ]);
    exit;
}

$productId = isset($_POST["product_id"]) ? (int)$_POST["product_id"] : 0;
$quantity = isset($_POST["quantity"]) ? (int)$_POST["quantity"] : 1;

if ($productId <= 0 || $quantity <= 0) {
    echo json_encode([
        "success" => false,
        "message" => "Invalid product or quantity."
    ]);
    exit;
}

$customerId = $_SESSION["user_id"];
$cartId = getOrCreateCart($conn, $customerId);
$added = addToCart($conn, $cartId, $productId, $quantity);

if ($added) {
    $cartCount = getCartItemCount($conn, $cartId);
    echo json_encode([
        "success" => true,
        "message" => "Added to cart!",
        "cart_count" => $cartCount
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Could not add item to cart."
    ]);
}
?>