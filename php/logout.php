<?php

session_start();

$_SESSION = array();
session_destroy();

if(isset($_COOKIE["remembered_email"])) {

setcookie("remembered_email","", time() -3600);

}

echo "<h2>You have logged out. </h2>;
echo '<p><a href="../Pages/login.html">Go back to Login Page</a></p>';

?>