<?php 

$errors = array();  

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $fullname = trim($_POST["fullname"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $area = trim($_POST["area"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

     if (empty($fullname)) {
     $errors[] = "Full name is required.";
 } elseif (strlen($fullname) < 3) {
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

 if (empty($errors)) {

 echo "<h2>Registration Successful!</h2>";
echo "<p>Welcome, " . htmlspecialchars($fullname) . "!</p>";
echo "<p>Your account has been created with email: " . htmlspecialchars($email) . "</p>";
echo '<p><a href="../pages/login.html">Click here to Sign In</a></p>';

} else {
    
    echo "<h2>Registration Failed</h2>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>" . htmlspecialchars($error) . "</li>";
    }
    echo "</ul>";
    echo '<p><a href="../pages/register.html">Go back and try again</a></p>';
}

}

else {
    echo "Please fill out the registration form first.";
    echo '<p><a href="../pages/register.html">Go to Registration Page</a></p>';
}

    ?>