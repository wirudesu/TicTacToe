<?php
$conn = mysqli_connect('localhost', 'username', 'password', 'database_name');

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
