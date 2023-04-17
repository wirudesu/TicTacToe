<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
  mysqli_query($conn, $query);

  header("Location: login.php");
  exit;
}
?>
