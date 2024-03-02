window.addEventListener('load', addSpecialBoxImages);
// Add more event listeners as needed...


document.addEventListener('keydown', function(event) {
    if (event.keyCode === 32) {
        startGame();
    }
});

//player position
let player1 = { "position": 1, "wins": 0 };
let player2 = { "position": 1, "wins": 0 };
let player1Turn = true;

//name prompt
setTimeout(function () {
    let naam = prompt("What is your name?");
    naam = naam.charAt(0).toUpperCase() + naam.slice(1);
    document.getElementById("ownname").innerHTML = naam + ":";
}, 1000);

//generate random number between 1 and 6
function dice() {
    let number = Math.random() * 6;
    number = Math.floor(number) + 1;
    return number;
}
document.getElementById("placeholder").innerHTML = dice();

//show rolled number on the "placeholder" id
function roll(player) {
    // Controleer of de speler al heeft gewonnen voordat de dobbelsteen wordt gegooid
    if (player["position"] >= 64) {
        return;
    }

    let score = dice();
    document.getElementById("placeholder").innerHTML = score;
    hidePlayer();
    player["position"] += score;
    //stop players from going over 64 or under 1
    if (player["position"] > 63) {
        player["position"] = 64;
    }
    if (player["position"] < 1) {
        player["position"] = 1;
    }
    showPlayer();
}

//special boxes
function special(player, otherPlayer) {
    let bridge = [3, 15, 22, 42]
    let dice = [8, 20, 33, 58]
    let joker = [10, 23, 52]
    let allIn = [18, 48]
    let blut = [25, 50]
    let jackpot = [31, 38, 55]

    setTimeout(function() {
        //if the player is on a bridge, move 4 boxes forward
        if (bridge.includes(player["position"])) {
            hidePlayer();
            player["position"] += 4;
            if (player["position"] >= 63) {
                player["position"] = 64;
            }
            showPlayer();
        //if the player is on a dice, throw again
        } else if (dice.includes(player["position"])) {
            roll(player);
            if (player === player1) {
                alert("Throw again");
            } else if (player === player2) {
                alert("Bot throws again");
            }
        //if the player is on a joker, move 3 boxes back    
        } else if (joker.includes(player["position"])) {
            hidePlayer();
            player["position"] -= 3;
            if (player["position"] < 1) {
                player["position"] = 1;
            }
            showPlayer();
        //if the player is on an all-in, move to box 1    
        } else if (allIn.includes(player["position"])) {
            hidePlayer();
            player["position"] = 1;
            showPlayer();
        //if the player is on a blut box, move to box 16    
        } else if (blut.includes(player["position"])) {
            hidePlayer();
            player["position"] = 16;
            showPlayer();
        //if the player is on a jackpot, the other player moves 5 boxes back    
        } else if (jackpot.includes(player["position"])) {
            hidePlayer();
            otherPlayer["position"] -= 5;
            if (otherPlayer["position"] < 1) {
                otherPlayer["position"] = 1;
            }
            showPlayer();
        }
    }, 800); // Delay of 2 seconds
}

function addSpecialBoxImages() {
    let specialBoxes = {
        bridge: {
            positions: [3, 15, 22, 42],
            image: 'Game_graphics_en_assets/Bridge_icon.png'
        },
        dice: {
            positions: [8, 20, 33, 58],
            image: 'Game_graphics_en_assets/Dice_icon.png'
        },
        joker: {
            positions: [10, 23, 52],
            image: 'Game_graphics_en_assets/Joker_icon.png'
        },
        allIn: {
            positions: [18, 48],
            image: 'Game_graphics_en_assets/All_in_icon.png'
        },
        blut: {
            positions: [25, 50],
            image: 'Game_graphics_en_assets/Empty_wallet_icon.png'
        },
        jackpot: {
            positions: [31, 38, 55],
            image: 'Game_graphics_en_assets/Jackpot_icon.png'
        },
        start: {
            positions: [1],
            image: 'Game_graphics_en_assets/Start_icon.png'
        },
        finish: {
            positions: [64],
            image: 'Game_graphics_en_assets/Finish_icon.png'
        }
    };

    for (let boxType in specialBoxes) {
        let box = specialBoxes[boxType];    
        box.positions.forEach(function(position) {
            let img = document.createElement('img');
            img.src = box.image;
            img.className = 'special-box-image';
            document.querySelector(`div.vakje${position}`).appendChild(img);
        });
    }
}

//turn manager
function turnManager() {
    let currentPlayer = player1Turn ? player1 : player2;
    let otherPlayer = player1Turn ? player2 : player1;

    // Controleer of de speler al heeft gewonnen voordat de dobbelsteen wordt gegooid
    if (currentPlayer["position"] >= 64) {
        return;
    }

    if (currentPlayer != player1) {
        roll(currentPlayer);
    } else {
        alert("Roll the dice!!!");
        roll(currentPlayer);
    }

    //show winner on alert
    if (currentPlayer["position"] >= 63) {
        alert("Game over! Player " + (player1Turn ? "1" : "bot") + " wins!");
        currentPlayer["wins"] += 1;
        saveCookies();
        updateHighscore();
        return;
    }

    //delays the action of the special boxes so it doesn't go too fast
    setTimeout(function () {
        special(currentPlayer, otherPlayer);
        //delays the turn switch so it doesn't go too fast
        player1Turn = !player1Turn;
        setTimeout(function () {
            turnManager();
        }, 1000); // Verkort de vertraging tot 1 seconde
    }, 1500); // Verkort de vertraging tot 1,5 seconde
}


function botTurn() {
    console.log("bot turn")
    player1Turn = false;
    turnManager();
}

function startGame() {
    // Reset player positions
    player1["position"] = 1;
    player2["position"] = 1;

    showPlayer(); // Make players visible first

    // Add a small delay before starting the game
    setTimeout(function() {
        turnManager();
        updateHighscore();
    }, 500); // 500 milliseconds delay
}

document.querySelectorAll(".start").forEach(function(element) {
    element.addEventListener("click", startGame);
});
function refreshPage() {
    window.location.reload();
}

//show on the board
function showPlayer() {
    document.querySelector(`div.vakje${player1["position"]}>div[class^='base']>div>img.player1image`).style.visibility = "visible";
    document.querySelector(`div.vakje${player2["position"]}>div[class^='base']>div>img.player2image`).style.visibility = "visible";
}

//hide on the board
function hidePlayer() {
    document.querySelector(`div.vakje${player1["position"]}>div[class^='base']>div>img.player1image`).style.visibility = "hidden";
    document.querySelector(`div.vakje${player2["position"]}>div[class^='base']>div>img.player2image`).style.visibility = "hidden";
}
//cookies
//set highscore for the cookies
function updateHighscore() {
    let cookieRead = getCookies();
    player1["wins"] = cookieRead["player1"];
    player2["wins"] = cookieRead["player2"];
    let highscore1 = document.getElementById("player1Highscore");
    let highscore2 = document.getElementById("player2Highscore");
    highscore1.innerHTML = player1["wins"];
    highscore2.innerHTML = player2["wins"];
}

//read the cookies that are saved and splits them into a name and value
function getCookies() {
    let cookie = document.cookie;
    let cookieArray = cookie.split(";");
    if (!cookie.includes("player1") || !cookie.includes("player2")) {
        return { "player1": 0, "player2": 0 };
    }
    let cookieObject = {};
    for (let i = 0; i < cookieArray.length; i++) {
        let keyValue = cookieArray[i].split("=");
        cookieObject[keyValue[0].trim()] = parseInt(keyValue[1].trim());
    }
    return cookieObject;

}

//make the cookies
function saveCookies() {
    let cookieObject = getCookies();
    cookieObject["player1"] = player1["wins"];
    cookieObject["player2"] = player2["wins"];
    const d = new Date();
    d.setTime(d.getTime() + (30 * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    let cookieString = "player1=" + cookieObject["player1"] + ";" + expires + ";path=/";
    let cookieString2 = "player2=" + cookieObject["player2"] + ";" + expires + ";path=/";
    document.cookie = cookieString;
    document.cookie = cookieString2;
}

//reset the cookies
function resetCookies() {
    let cookies = document.cookie.split(";");

    for (let i = 0; i < cookies.length; i++) {
        let cookie = cookies[i];
        let eqPos = cookie.indexOf("=");
        let name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=0;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/";
    }
}