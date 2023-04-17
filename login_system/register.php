<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<body>
	<h1>Register</h1>
	<form method="POST" action="register_process.php">
		<label>Username:</label>
		<input type="text" name="username"><br><br>
		<label>Email:</label>
		<input type="email" name="email"><br><br>
		<label>Password:</label>
		<input type="password" name="password"><br><br>
		<input type="submit" value="Register">
	</form>
	<p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>
