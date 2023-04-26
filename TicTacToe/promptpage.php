<?php
	session_start();
	if (!isset($_SESSION['username'])) {
		$_SESSION['error'] = "This is a protected page that only logged in users can access.";
		header("Location: login.php");
		exit;
	}

	if (isset($_POST['start'])) {
		$player1 = $_POST['player1'];
		$player2 = $_POST['player2'];

		if (empty($player1) || empty($player2)) {
			$_SESSION['error'] = "Please fill in both player names.";
			header("Location: game.php");
			exit;
		}

		// Set the session variables for player names
		$_SESSION['player1'] = $player1;
		$_SESSION['player2'] = $player2;

		// Redirect to tictactoe.php
		header('Location: tictactoe.php');
		exit;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Game</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Finger+Paint&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/stylePrompt.css">
</head>
<body>
	<div>
	<?php if (isset($_SESSION['error'])): ?>
        <div class="errormessage"><?php echo $_SESSION['error']; ?></div>
<?php unset($_SESSION['error']); ?>
<?php endif; ?>
<form method="post">
	<label>Player 1:</label>
	<input type="text" name="player1">
	<label>Player 2:</label>
	<input type="text" name="player2">
	<button type="submit" name="start">Start Game</button>
</form>
</div>
</body>
</html>
