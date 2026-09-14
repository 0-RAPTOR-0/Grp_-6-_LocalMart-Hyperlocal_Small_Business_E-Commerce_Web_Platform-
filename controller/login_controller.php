<?php

session_start();
require_once __DIR__ . '/../php/db_functions.php';

header('Content-Type: application/json');

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $remember = isset($_POST["remember"]) ? true : false;

    if (empty($email)) {

        $errors[] = "Email is required.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $errors[] = "Please enter a valid email address.";

    }

    if (empty($password)) {

        $errors[] = "Password is required.";

    }

    if (empty($errors)) {

       $user = findUserByEmail($conn, $email);

       if ($user && password_verify($password, $user['password'])) {

  
    $_SESSION["user_id"] = $user['user_id'];
    $_SESSION["user_name"] = $user['name'];
    $_SESSION["user_email"] = $user['email'];
    $_SESSION["user_phone"] = $user['phone'];
    $_SESSION["user_role"] = $user['role'];
    $_SESSION["logged_in"] = true;

    if ($remember) {

        setcookie("remembered_email", $email, time() + (30 * 24 * 60 * 60));
        
    }

    $dashboardByRole = array(
    "customer" => "../Pages/customer-home.php",
    "shop_owner" => "../Pages/seller-dashboard.php",
    "delivery_agent" => "../Pages/delivery-dashboard.php",
    "admin" => "../Pages/admin-dashboard.php"
);

$dashboardUrl = isset($dashboardByRole[$user['role']])
    ? $dashboardByRole[$user['role']]
    : "../Pages/customer-home.php";

    echo json_encode(array(

    "success"  => true,
    "message"  => "Welcome back, " . $user['name'] . "!",
    "redirect" => $dashboardLink

    ));

    exit;

    } else {

        $errors[] = "Incorrect email or password.";
    }
}

    echo json_encode(array(
        "success" => false,
        "message" => implode(" ", $errors)
    ));
    exit;

    } else {

    echo json_encode(array(

        "success" => false,
        "message" => "Please fill out the login form first."
    ));
    
    exit;
}

?>