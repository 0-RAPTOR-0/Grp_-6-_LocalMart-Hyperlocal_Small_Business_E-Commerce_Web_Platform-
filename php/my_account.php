<?php

session_start();

if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true){

  echo "<h2>You are not logged in.</h2>";
  echo '<p><a href="../Pages/login.html">Please Sign In first</a></p>';

  exit;

}

$email = $_SESSION["user_email"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Account — LocalMart</title>
<link rel="stylesheet" href="../CSS/style.css">
</head>
<body>

<header class="navbar">

  <div class="brand"><a href="../index.html" style="color:#fff;">LocalMart</a></div>

</header>

<div class="container" style="max-width:600px; padding-top:30px;">

  <div class="form-message success">

    Welcome back, <?php echo htmlspecialchars($email); ?>! Your session is active.

  </div>

  <?php if (isset($_COOKIE["remembered_email"])): ?>

    <div class="form-message success">

      A "Remember Me" cookie was found for: <?php echo htmlspecialchars($_COOKIE["remembered_email"]); ?>

    </div>

  <?php endif; ?>

  <p><a href="logout.php" class="btn btn-secondary">Logout</a></p>
  
</div>

</body>
</html>