<?php
    $player1Score = 0;
    $player2Score = 0;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['restart'])) {
            $player1Score = 0;
            $player2Score = 0;
        }
        if (isset($_POST['resetScore'])) {
            $player1Score = 0;
            $player2Score = 0;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic Tac Toe</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Finger+Paint&display=swap" rel="stylesheet"> 
</head>
<body>
    <div class="container">
        <h1 id="playerText">Tic Tac Toe</h1>
        <form method="POST">
            <div class="button-container">
                <button type="submit" name="restart" id="restartBtn">Restart</button>
                <button type="submit" name="resetScore" id="resetScoreBtn">Reset Score</button>
            </div>
        </form>

        <div id="gameboard">
            <div class="box" id="0"></div>
            <div class="box" id="1"></div>
            <div class="box" id="2"></div>
            <div class="box" id="3"></div>
            <div class="box" id="4"></div>
            <div class="box" id="5"></div>
            <div class="box" id="6"></div>
            <div class="box" id="7"></div>
            <div class="box" id="8"></div>
        </div>
        
        <div id="scoreboard">
            <h2>Score</h2>
            <div class="playerScore player1Score">Player 1: <?php echo $player1Score; ?></div>
            <div class="playerScore player2Score">Player 2: <?php echo $player2Score; ?></div>
        </div>
    </div>
    
    <script src="/game_logic.js"></script>

    <style>
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        #restartBtn {
            margin-right: 10px;
        }

        #leaderboard {
            position: absolute;
            top: 0;
            left: 0;
            padding: 10px;
            font-weight: bold;
        }

        #scoreboard {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
        }

        .playerScore {
            width: 100%;
            text-align: center;
            margin-bottom: 10px;
        }

        .player1Score {
            order: 1;
        }

        .player2Score {
            order: 2;
        }
    </style>
</body>
</html>
