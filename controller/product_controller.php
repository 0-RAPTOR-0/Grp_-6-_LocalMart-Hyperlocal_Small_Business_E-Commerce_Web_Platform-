<?php

 session_start();
 require_once __DIR__ . '/../php/db_functions.php';

 $error = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pname = trim($_POST["pname"]);
    $pcategory = trim($_POST["pcategory"]);
    $pprice = trim($_POST["pprice"]);
    $pstock = trim($_POST["pstock"]);
    $pdesc = trim($_POST["pdesc"]);


 if (empty($pname)) {

     $errors[] = "Product name is required.";

    }

 if (empty($pcategory)) {

    $errors[] = "Please select a category.";

    }

if ($pprice === "") {

    $errors[] = "Price is required.";

    } elseif (!is_numeric($pprice) || $pprice <= 0) {

    $errors[] = "Price must be a number greater than 0.";

    }

 if ($pstock === "") {

     $errors[] = "Stock quantity is required.";

    } elseif (!is_numeric($pstock) || $pstock < 0) {

     $errors[] = "Stock must be a number (0 or more).";

    }


     if (empty($errors)) {

        $shopId = 1;

        if (isset($_SESSION["user_id"]) && isset($_SESSION["user_role"]) && $_SESSION["user_role"] === "shop_owner") {

            $sql = "SELECT shop_id FROM shops WHERE owner_id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $_SESSION["user_id"]);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $shopRow = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);

        if ($shopRow) {

             $shopId = $shopRow['shop_id'];
            }
        }
     }


        $saved = addProduct($conn, $shopId, $pname, $pcategory, $pprice, $pstock, $pdesc);

        if ($saved) {
        echo "<h2>Product Saved Successfully!</h2>";
        echo "<p>Product Name: " . htmlspecialchars($pname) . "</p>";
        echo "<p>Category: " . htmlspecialchars($pcategory) . "</p>";
        echo "<p>Price: ৳" . htmlspecialchars($pprice) . "</p>";
        echo "<p>Stock: " . htmlspecialchars($pstock) . " units</p>";
        echo '<p><a href="../Pages/seller-dashboard.html">Back to Dashboard</a></p>';

        } else {

        echo "<h2>Could Not Save Product</h2>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";

        }

        echo "</ul>";
        echo '<p><a href="../Pages/product-form.html">Go back and try again</a></p>';
    }

} else {
    echo "Please fill out the product form first.";
    echo '<p><a href="../Pages/product-form.html">Go to Add Product Page</a></p>';
}


?>