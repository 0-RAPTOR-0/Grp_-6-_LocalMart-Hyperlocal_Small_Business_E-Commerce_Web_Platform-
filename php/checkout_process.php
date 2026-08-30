<?php
     $error = array();

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