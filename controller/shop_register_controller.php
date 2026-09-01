<?php

require_once __DIR__ . '/../php/db_functions.php';

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ownername = trim($_POST["ownername"]);
    $shopname = trim($_POST["shopname"]);
    $category = trim($_POST["category"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $area = trim($_POST["area"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if (empty($ownername)) {
        $errors[] = "Owner name is required.";
    } elseif (strlen($ownername) < 3) {
        $errors[] = "Owner name must be at least 3 characters.";
    }

    if (empty($shopname)) {
        $errors[] = "Shop name is required.";
    }

    if (empty($category)) {
        $errors[] = "Please select a shop category.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if (empty($phone)) {
        $errors[] = "Phone number is required.";
    } elseif (!preg_match("/^01[0-9]{9}$/", $phone)) {
        $errors[] = "Phone number must be 11 digits, e.g. 01712345678";
    }

    if (empty($area)) {
        $errors[] = "Area / Neighbourhood is required.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters.";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors) && emailExists($conn, $email)) {
        $errors[] = "This email is already registered.";
    }

        if (empty($errors)) {


        $saved = registerUser($conn, $ownername, $email, $password, 'shop_owner', $phone, $area);

        if ($saved) {

            $newUser = findUserByEmail($conn, $email);
            $ownerId = $newUser['user_id'];

            registerShop($conn, $ownerId, $shopname, $category, $area);

            echo "<h2>Shop Account Created!</h2>";
            echo "<p>Shop Name: " . htmlspecialchars($shopname) . "</p>";
            echo "<p>Status: Pending Admin Approval</p>";
            echo '<p><a href="../Pages/login.html">Click here to Sign In</a></p>';
        
        } else {

            echo "<h2>Something went wrong.</h2>";
            echo "<p>We could not save your shop account. Please try again.</p>";
            echo '<p><a href="../Pages/shop-register.html">Go back</a></p>';
        }

    } else {
        echo "<h2>Registration Failed</h2>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
        echo '<p><a href="../Pages/shop-register.html">Go back and try again</a></p>';
    }

} else {
    echo "Please fill out the shop registration form first.";
    echo '<p><a href="../Pages/shop-register.html">Go to Shop Register Page</a></p>';
}

?>
    