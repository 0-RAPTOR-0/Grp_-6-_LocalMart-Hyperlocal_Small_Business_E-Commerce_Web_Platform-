<?php

session_start();
require_once __DIR__ . '/../php/db_functions.php';


$error = array();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    echo "<h2>Please Sign In First</h2>";
    echo "<p>You need an account to place an order.</p>";
    echo '<p><a href="../pages/login.html">Go to Login Page</a></p>';
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

         $address = trim($_POST["address"]);
         $city = trim($_POST["city"]);
         $payment = isset($_POST["payment"]) ? $_POST["payment"] : "";

         if (empty($address)) {
         $errors[] = "Delivery address is required.";
}

           if (empty($city)) {
      $errors[] = "Please select a city.";
  }

   $allowedPayments = array("bkash", "nagad", "cod");
 if (empty($payment) || !in_array($payment, $allowedPayments)) {
     $errors[] = "Please choose a valid payment method.";
 }

     if (empty($errors)) {

        $customerId = $_SESSION["user_id"];
        $cartId = getOrCreateCart($conn, $customerId);
        $cartItems = getCartItemsWithProducts($conn, $cartId);

    if (empty($cartItems)) {

    echo "<h2>Your cart is empty.</h2>";
    echo '<p><a href="../pages/browse.php">Go shopping</a></p>';

    exit;

    }

    $total = 0;
    foreach ($cartItems as $item) {

    $total += $item['price'] * $item['quantity'];

    }

    $orderItems = array();
    foreach ($cartItems as $item) {

    $orderItems[] = array(
        
        'product_id' => $item['product_id'],
        'quantity' => $item['quantity'],
        'price' => $item['price']
    );
}

    $orderId = placeOrder($conn, $customerId, $address, $city, $total, $payment, $orderItems);

    $sql = "DELETE FROM cart_items WHERE cart_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $cartId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    echo "<h2>Order Placed Successfully!</h2>";
    echo "<p>Delivery Address: " . htmlspecialchars($address) . ", " . htmlspecialchars($city) . "</p>";
    echo "<p>Payment Method: " . htmlspecialchars($payment) . "</p>";
    echo '<p><a href="../pages/order-tracking.html">Track your order</a></p>';

    } else {
        echo "<h2>Order Failed</h2>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
        echo '<p><a href="../pages/checkout.html">Go back and try again</a></p>';
    }

} else {
    echo "Please fill out the checkout form first.";
    echo '<p><a href="../pages/checkout.html">Go to Checkout Page</a></p>';
}
?>