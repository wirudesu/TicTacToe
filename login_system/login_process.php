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
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['username'] = $row['username'];

      $session_id = session_id();
      $user_id = $_SESSION['user_id'];

      $query = "INSERT INTO sessions (user_id, session_id) VALUES ('$user_id', '$session_id')";
      mysqli_query($conn, $query);

      header("Location: dashboard.php");
      exit;
    } else {
      echo "Invalid password.";
    }
  } else {
    echo "Username not found.";
  }
}
?>
