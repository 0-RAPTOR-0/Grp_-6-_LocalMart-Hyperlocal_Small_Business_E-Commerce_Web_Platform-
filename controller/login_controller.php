<?php

session_start();
require_once __DIR__ . '/../models/db_functions.php';

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
    $_SESSION["user_role"] = $user['role'];
    $_SESSION["logged_in"] = true;

    if ($remember) {

        setcookie("remembered_email", $email, time() + (30 * 24 * 60 * 60));
        
    }

    echo "<h2>Login Successful!</h2>";
    echo "<p>Welcome back, " . htmlspecialchars($user['name']) . "!</p>";
    echo '<p><a href="../pages/customer-home.html">Go to your Dashboard</a></p>';
    echo '<p><a href="logout.php">Logout</a></p>';

} else {
   $errors[] = "Incorrect email or password.";

       }
    }

    if (!empty($errors)) {
        echo "<h2>Login Failed</h2>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
        echo '<p><a href="../pages/login.html">Go back and try again</a></p>';
    }

} else {

    echo "Please fill out the login form first.";
    echo '<p><a href="../pages/login.html">Go to Login Page</a></p>';

}

?>