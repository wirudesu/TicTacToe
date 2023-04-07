let playerText = document.getElementById('playerText')
let restartBtn = document.getElementById('restartBtn')
let resetScoreBtn = document.getElementById('resetScoreBtn')
let boxes = Array.from(document.getElementsByClassName('box'))

let winnerIndicator = getComputedStyle(document.body).getPropertyValue('--winning-blocks')

const O_TEXT = "O"
const X_TEXT = "X"
let currentPlayer = X_TEXT
let spaces = Array(9).fill(null)

let xScore = 0
let oScore = 0

const startGame = () => {
    boxes.forEach(box => box.addEventListener('click', boxClicked))
}

function boxClicked(e) {
    const id = e.target.id

    if(!spaces[id] && playerHasWon() === false){
        spaces[id] = currentPlayer
        e.target.innerText = currentPlayer

        if(playerHasWon() !== false){
            playerText.innerHTML = `${currentPlayer} has won!`
            let winning_blocks = playerHasWon()

            winning_blocks.map( box => boxes[box].style.backgroundColor=winnerIndicator)

            if (currentPlayer === X_TEXT) {
                xScore++
                document.getElementById('xScore').innerHTML = xScore
            } else {
                oScore++
                document.getElementById('oScore').innerHTML = oScore
            }
            
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
    spaces.fill(null)

    boxes.forEach( box => {
        box.innerText = ''
        box.style.backgroundColor=''
    })

    playerText.innerHTML = 'Tic Tac Toe'

    currentPlayer = X_TEXT    
    xScore = 0;
    oScore = 0;
    updateScoreBoard();
}

function resetScore() {
    xScore = 0
    oScore = 0

    document.getElementById('xScore').innerHTML = xScore
    document.getElementById('oScore').innerHTML = oScore
}

function updateScoreBoard() {
    document.getElementById('xScore').innerHTML = xScore
    document.getElementById('oScore').innerHTML = oScore
}

startGame()
