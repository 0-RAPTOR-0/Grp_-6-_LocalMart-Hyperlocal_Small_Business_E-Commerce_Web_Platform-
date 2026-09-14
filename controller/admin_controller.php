<?php

session_start();
require_once __DIR__ . '/../php/db_functions.php';

$errors = array();

if($_SERVER['REQUEST_METHOD'] == "POST") {

  $fullname = trim($_POST["fullname"]);
  $email = trim($_POST["email"]);
  $phone = trim($_POST["phone"]);
  $password = $_POST["password"];
  $confirm_password = $_POST["confirm_password"];

if (empty($fullname) || strlen($fullname) < 3) {
    $errors[] = "Full name must be at least 3 characters.";
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

    $saved = registerUser($conn, $fullname, $email, $password, 'admin', $phone, '');

    if ($saved) {

        $newUser = findUserByEmail($conn, $email);

        $_SESSION["user_id"] = $newUser['user_id'];
        $_SESSION["user_name"] = $newUser['name'];
        $_SESSION["user_email"] = $newUser['email'];
        $_SESSION["user_phone"] = $newUser['phone'];
        $_SESSION["user_role"] = $newUser['role'];
        $_SESSION["logged_in"] = true;

        header("Location: ../Pages/admin-dashboard.php");

        exit;

    } else {

        echo "<h2>Something went wrong.</h2>";
        echo "<p>We could not save your account. Please try again.</p>";
        echo '<p><a href="../Pages/admin-register.html">Go back</a></p>';
    }

  } else {

    echo "<h2>Registration Failed</h2>";
    echo "<ul>";

    foreach ($errors as $error) {

        echo "<li>" . htmlspecialchars($error) . "</li>";
    }

    echo "</ul>";
    echo '<p><a href="../Pages/admin-register.html">Go back and try again</a></p>';
  }

} else {

    echo "Please fill out the registration form first.";
    echo '<p><a href="../Pages/admin-register.html">Go to Admin Registration</a></p>';
}

?>