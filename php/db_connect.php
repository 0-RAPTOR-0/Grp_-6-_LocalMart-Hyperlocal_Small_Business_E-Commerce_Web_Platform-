<?php

require_once __DIR__ . '/config.php';

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn){
  die("Database Connection filed: " . mysqli_connect_errno());

}
?>