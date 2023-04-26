<?php
  session_start();
  require_once 'config.php';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the password has at least one capital letter and is between 6 and 9 characters
    if (!preg_match('/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{6,9}$/', $password)) {
      $_SESSION['errors'][] = "Password must have at least one capital letter and be between 6 and 9 characters long.";
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($result) > 0) {
      // Error message
      $_SESSION['errors'][] = "Username or email already exists.";
    }

    if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
      header("Location: register.php");
      exit;
    }

    $insert_query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

    if (mysqli_query($conn, $insert_query)) {
      // Success message
      $_SESSION['success'] = "Registration successful.". "<br>" ."Please login!";
      header("Location: login.php");
      exit;
    } else {
      // Error message
      $_SESSION['errors'][] = "Registration failed. Please try again.";
      header("Location: register.php");
      exit;
    }
}
