<?php
session_start();
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
    <link href="https://fonts.googleapis.com/css2?family=Finger+Paint&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/styleReg.css"> 
	<title>Register</title>
</head>
<body>
	<div class="container">
	<?php
		if (session_status() === PHP_SESSION_NONE) {
			session_start();
		}

		if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
			echo '<ul style="color: red;">';
			foreach ($_SESSION['errors'] as $error) {
				echo '<li>' . $error . '</li>';
			}
			echo '</ul>';
			unset($_SESSION['errors']);
		}
	?>




		<h1>REGISTER</h1>
		<form class="form" action="register_process.php" method="post">
			<label>Username:</label>
			<input type="text" name="username">
            <label>Email:</label>
            <input type="email" name="email">
			<label>Password:</label>
			<input type="password" name="password">
			<input type="submit" value="Register">
		</form>
		<p>Already have an account? <a href="login.php" id="link">Login here</a></p>
	</div>
	<footer>
	© <?php echo date("Y"); ?> YourWebsite.com. All rights reserved.
	</footer>
</body>
</html>
