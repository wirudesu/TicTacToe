<?php

session_start();


// Get the player names from the form
$player1 = $_POST['player1'];
$player2 = $_POST['player2'];

// Set the session variables for player names
$_SESSION['player1'] = $player1;
$_SESSION['player2'] = $player2;

header('Location: tictactoe.php');
exit;

?>
