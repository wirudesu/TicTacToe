<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = "SELECT * FROM users WHERE username='$username'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    if (password_verify($password, $row['password'])) {
      // Passwords match
      // Start a new session and save user information
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['username'] = $row['username'];

      $_SESSION['success'] = "You have successfully logged in.";
      header("Location: promptpage.php");
      exit();
    } else {
      // Passwords don't match
      $_SESSION['error'] = "Invalid password.";
    }
  } else {
    // Username not found
    $_SESSION['error'] = "Username not found.";
  }
  
  // Redirect back to login.php
  header("Location: login.php");
  exit();
}


?>