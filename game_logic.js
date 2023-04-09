let playerText = document.getElementById('playerText')
let restartBtn = document.getElementById('restartBtn')
let resetScoreBtn = document.getElementById('resetScoreBtn')
let boxes = Array.from(document.getElementsByClassName('box'))

let winnerIndicator = getComputedStyle(document.body).getPropertyValue('--winning-blocks')

const O_TEXT = "O"
const X_TEXT = "X"
let currentPlayer = X_TEXT
let spaces = Array(9).fill(null)
let gameOver = false // add a game over flag

const startGame = () => {
    if (!gameOver) { // check if the game is not over
        boxes.forEach(box => box.addEventListener('click', boxClicked))
    }
}

function boxClicked(e) {
    const id = e.target.id

    if(!spaces[id] && !gameOver){ // check if the game is not over
        spaces[id] = currentPlayer
        e.target.innerText = currentPlayer

        if(playerHasWon() !==false){
            playerText.innerHTML = `${currentPlayer} has won!`
            let winning_blocks = playerHasWon()

            winning_blocks.map( box => boxes[box].style.backgroundColor=winnerIndicator)

            if (currentPlayer == X_TEXT) {
                player1Score++
                document.querySelector('.player1Score').textContent = `Player 1: ${player1Score}`
            } else {
                player2Score++
                document.querySelector('.player2Score').textContent = `Player 2: ${player2Score}`
            }

            // Remove event listeners from boxes
            boxes.forEach(box => box.removeEventListener('click', boxClicked))
            gameOver = true // set the game over flag to true

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

restartBtn.addEventListener('click', restart)
resetScoreBtn.addEventListener('click', resetScore)

function restart() {
    if(gameOver){ // check if the game is over before restarting
        spaces.fill(null)

        boxes.forEach( box => {
            box.innerText = ''
            box.style.backgroundColor=''
        })

        playerText.innerHTML = 'Tic Tac Toe'

        currentPlayer = X_TEXT

        gameOver = false // reset the game over flag
        startGame() // re-add event listeners
    }
}

function resetScore() {
    player1Score = 0
    player2Score = 0
    document.querySelector('.player1Score').textContent = `Player 1: ${player1Score}`
    document.querySelector('.player2Score').textContent = `Player 2: ${player2Score}`
}

let player1Score = 0
let player2Score = 0
document.querySelector('.player1Score').textContent = `Player 1: ${player1Score}`
document.querySelector('.player2Score').textContent = `Player 2: ${player2Score}`

startGame()
