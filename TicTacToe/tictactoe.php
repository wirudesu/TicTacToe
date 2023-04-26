<?php
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['username'])) {
        $_SESSION['error'] = "This is a protected page that only logged in users can access";
        header("Location: login.php");
        exit;
    }

    $gameOver = false;
    $winner = false;
    // Get the player names from the session
    $player1 = $_SESSION['player1'];
    $player2 = $_SESSION['player2'];

    // Initialize player scores if they don't exist in the session
    if (!isset($_SESSION['player1Score'])) {
        $_SESSION['player1Score'] = 0;
    }
    if (!isset($_SESSION['player2Score'])) {
        $_SESSION['player2Score'] = 0;
    }

    // Get the scores from the session
    $player1Score = $_SESSION['player1Score'];
    $player2Score = $_SESSION['player2Score'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['restart'])) {
            // Reset player scores to 0
            $_SESSION['player1Score'] = 0;
            $_SESSION['player2Score'] = 0;
            $player1Score = 0;
            $player2Score = 0;
        }
        if (isset($_POST['resetScore'])) {
            // Reset player scores to 0
            $_SESSION['player1Score'] = 0;
            $_SESSION['player2Score'] = 0;
            $player1Score += 1;
            $player2Score += 1;
        }  
        if (isset($_POST['logout'])) {
            // Unset session variables and destroy session
            session_unset();
            session_destroy();
            // Redirect to login page or display message
            header("Location: login.php");
            exit;
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Finger+Paint&display=swap" rel="stylesheet"> 
</head>
<body>
<audio id="bgmusic" src="audios/bg.m4a" autoplay loop></audio>
<audio id="winmusic" src="audios/win.m4a"></audio>
<audio id="tiemusic" src="audios/Awh.m4a"></audio>
    <div class="container">
    <?php if (isset($_SESSION['error'])): ?>
        <div class="error-message"><?php echo $_SESSION['error']; ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
        <h1 id="playerText">Tic Tac Toe</h1>
        <form method="post">
            <button type="submit" name="logout" id="logout-button" onclick="return confirm('Are you sure you want to log out?')" style="position: absolute; top: 0; right: 0;">Quit</button>
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
<br>

        <div id="scoreboard">
            <h2>Score</h2>
            <div class="playerScore player1Score"> <?php echo $player1 ." : ". $player1Score; ?></div>
            <div class="playerScore player2Score"> <?php echo $player2 ." : ".$player2Score; ?></div>
        </div>
        <form method="POST">
    <div class="button-container">
        <button type="submit" name="restart" id="restartBtn">Restart</button>
        <button type="submit" name="resetScore" id="resetScoreBtn">Reset Score</button>
    </div>
</form>
    </div> 
    <script>
        var bgMusic = document.getElementById("bgmusic");
        var tieMusic = document.getElementById("tiemusic");
        var winMusic = document.getElementById("winmusic");
        let playerText = document.getElementById('playerText');
        let restartBtn = document.getElementById('restartBtn');
        let resetScoreBtn = document.getElementById('resetScoreBtn');
        let boxes = Array.from(document.getElementsByClassName('box'));
        let player1 = '<?php echo $player1; ?>';
        let player2 = '<?php echo $player2; ?>';
        let winnerIndicator = getComputedStyle(document.body).getPropertyValue('--winning-blocks');
        const logoutButton = document.getElementById('logout-button');

        // Add a click event listener to the logout button
        logoutButton.addEventListener('click', function() {
            resetScore();
        });


        const O_TEXT = "O"
        const X_TEXT = "X"
        let currentPlayer = X_TEXT
        let spaces = Array(9).fill(null)
        let gameOver = false // add a game over flag
        let winnerName = null // add a variable to store the winner's name

        let player1Score = localStorage.getItem('player1Score') || 0;
        let player2Score = localStorage.getItem('player2Score') || 0;

        document.querySelector('.player1Score').textContent = `${player1}: ${player1Score}`;
        document.querySelector('.player2Score').textContent = `${player2}: ${player2Score}`;

        

        const startGame = () => {    
        if (!gameOver) { // check if the game is not over
        boxes.forEach(box => box.addEventListener('click', boxClicked))
        }
        }

        function boxClicked(e) {
            bgMusic.play();
        const id = e.target.id

        if(!spaces[id] && !gameOver){ // check if the game is not over
        spaces[id] = currentPlayer
        e.target.innerText = currentPlayer

        if(playerHasWon() !==false){
        winnerName = (currentPlayer == X_TEXT) ? player1 : player2 // set winnerName to the name of the winning player
        winMusic.play();
        bgMusic.pause();
        playerText.innerHTML = `${winnerName} has won!`
        let winning_blocks = playerHasWon()

        winning_blocks.map( box => boxes[box].style.backgroundColor=winnerIndicator)

        if (currentPlayer == X_TEXT) {
            player1Score++
            document.querySelector('.player1Score').textContent = `${player1}: ${player1Score}`
        } else {
            player2Score++
            document.querySelector('.player2Score').textContent = `${player2}: ${player2Score}`
        }
        // Remove event listeners from boxes
        boxes.forEach(box => box.removeEventListener('click', boxClicked))
        gameOver = true // set the game over flag to true

        localStorage.setItem('player1Score', player1Score);
        localStorage.setItem('player2Score', player2Score);

        return
        }
        let tie = true // check if the game is a tie
                for (let i = 0; i < spaces.length; i++) {
                    if (!spaces[i]) {
                        tie = false
                        break
                    }
                }
                if (tie) {
                    playerText.innerHTML = 'The game is a tie!'
                    bgMusic.pause();
                    tieMusic.play();
                    gameOver = true
                    // Remove event listeners from boxes
                    boxes.forEach(box => box.removeEventListener('click', boxClicked))
                    return
                }

        currentPlayer = currentPlayer == X_TEXT ? O_TEXT : X_TEXT
        }
        }



            const winningCombos = [
                [0,1,2],
                [3,4,5],
                [6,7,8],
                [0,3,6],
                [1,4,7],
                [2,5,8],
                [0,4,8],
                [2,4,6]
            ]

            function playerHasWon() {
                for (const condition of winningCombos) {
                    let [a, b, c] = condition

                    if(spaces[a] && (spaces[a] == spaces[b] && spaces[a] == spaces[c])) {
                        return [a,b,c]
                    }
                }
                return false
            }
            resetScoreBtn.addEventListener('click', resetScore)

        function resetScore() {
            localStorage.setItem('player1Score', 0)
            localStorage.setItem('player2Score', 0)
            player1Score = 0
            player2Score = 0
            document.querySelector('.player1Score').textContent = `${player1}: ${player1Score}`
            document.querySelector('.player2Score').textContent = `${player2}: ${player2Score}`
        }

        function saveScore() {
        // Extract player name and scores from DOM
        const player1Score = localStorage.getItem('player1Score');
        const player2Score = localStorage.getItem('player2Score');
        const xhr = new XMLHttpRequest();
        }


                restartBtn.addEventListener('click', () => {
            // save the scores to local storage
            localStorage.setItem('player1Score', player1Score);
            localStorage.setItem('player2Score', player2Score);

            // restart the game
            currentPlayer = X_TEXT
            spaces = Array(9).fill(null)
            gameOver = false
            winnerName = null
            boxes.forEach(box => {
                box.innerText = ''
                box.style.backgroundColor = ''
            })
            playerText.innerHTML = `It's ${currentPlayer}'s turn`
            startGame()
        })


            resetScoreBtn.addEventListener('click',reset)

            function reset() {
                if(gameOver){ // check if the game is over before restarting
                    spaces.fill(null)

                    boxes.forEach( box => {
                        box.innerText = ''
                        box.style.backgroundColor=''
                    })

                    playerText.innerHTML = 'Tic Tac Toe'

                    currentPlayer = X_TEXT
                    player1Score = 0
                    player2Score = 0
                    document.querySelector('.player1Score').textContent = `${player1}: ${player1Score}`
                    document.querySelector('.player2Score').textContent = `${player2}: ${player2Score}`


                    gameOver = false // reset the game over flag
                    startGame() // re-add event listeners
                }
            }

            document.querySelector('.player1Score').textContent = `${player1}: ${player1Score}`
            document.querySelector('.player2Score').textContent = `${player2}: ${player2Score}`

            startGame()
    </script>
</body>
</html>