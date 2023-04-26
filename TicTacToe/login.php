<?php
session_start();
if (isset($_SESSION['error'])) {
  $errorMessage = $_SESSION['error'];
  unset($_SESSION['error']);
}

if (isset($_SESSION['username'])) {
	$_SESSION['error'] = "You are already logged in.";
	header("Location: promptpage.php");
	exit();
  }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="css/styleLog.css">
    <link href="https://fonts.googleapis.com/css2?family=Finger+Paint&display=swap" rel="stylesheet"> 
	<title>Login</title>
</head>
<body>
	<div class="container">
		<?php if (isset($errorMessage)): ?>
			<div class="error-message"><?php echo $errorMessage; ?></div>
		<?php endif; ?>
		<?php if (isset($_SESSION['success'])): ?>
			<div class="success-message"><?php echo $_SESSION['success']; ?></div>
		<?php unset($_SESSION['success']); ?>
		<?php endif; ?>
		<h1>LOGIN</h1>
		<form class="form" action="login_process.php" method="post">
			<label>Username:</label>
			<input type="text" name="username">
			<label>Password:</label>
			<input type="password" name="password">
			<input type="submit" value="Login">
		</form>
		<p>Don't have an account? <a href="register.php" id="link">Register here</a></p>
	</div>
	<footer>
	© <?php echo date("Y"); ?> YourWebsite.com. All rights reserved.
	</footer>
</body>
</html>
