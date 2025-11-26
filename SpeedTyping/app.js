const displayText = document.getElementById("displayText");
const inputField = document.getElementById("inputField");
const startBtn = document.getElementById("startBtn");
const resetBtn = document.getElementById("resetBtn");
const timeSelect = document.getElementById("timeSelect");
const difficultySelect = document.getElementById("difficultySelect");

const timeText = document.getElementById("time");
const wpmText = document.getElementById("wpm");


let words = [];
let textArray = [];
let currentIndex = 0;
let timer = 60;
let interval = null;
let started = false;
let startTime = null;

// Load words
async function loadWords(difficulty = "Easy") {
    try {
        const response = await fetch("words.json");
        const data = await response.json();
        words = data[difficulty] || data["Easy"];
    } catch (err) {
        console.error("Failed to load words:", err);
        words = ["Please", "check", "words.json"];
    }
}

// Generate text array
function generateTextArray() {
    let text = [];
    for (let i = 0; i < 40; i++) {
        text.push(words[Math.floor(Math.random() * words.length)]);
    }
    return text;
}

// Display static text 
function updateDisplay(typedSoFar = "") {
    const nextWords = textArray.slice(currentIndex, currentIndex + 7); 
    const allText = nextWords.join(" ");
    let highlighted = "";

    for (let i = 0; i < allText.length; i++) {
        const typedChar = typedSoFar[i];
        const actualChar = allText[i];

        if (typedChar === actualChar) {
            highlighted += `<span style="color:#6c82ff">${actualChar}</span>`;
        } else if (typedChar && typedChar !== actualChar) {
            highlighted += `<span style="color:#ff4c4c">${actualChar}</span>`;
        } else {
            highlighted += actualChar;
        }
    }

    displayText.innerHTML = highlighted;
}


// Start test
async function startTest() {
    if (started) return;
    started = true;

    inputField.disabled = false;
    inputField.value = "";
    inputField.focus();

    timer = parseInt(timeSelect.value) || 60;
    timeText.innerText = timer;

    const difficulty = difficultySelect.value;
    await loadWords(difficulty);

    textArray = generateTextArray();
    currentIndex = 0;
    startTime = Date.now();

    updateDisplay();

    interval = setInterval(() => {
        timer--;
        timeText.innerText = timer;
        if (timer <= 0) endTest();
    }, 1000);

    inputField.addEventListener("input", trackTyping);
}

// Track typing
function trackTyping() {
    const typed = inputField.value;
    const typedWords = typed.trim().split(/\s+/).filter(w => w.length > 0);

    // Move currentIndex forward only for correctly typed words
    for (let i = currentIndex; i < typedWords.length; i++) {
        if (textArray[i] && typedWords[i] === textArray[i]) {
            currentIndex++;
        } else {
            break;
        }
    }

    updateDisplay(typed);
    updateStats(typedWords.length);
}

// Update WPM live
function updateStats(totalTypedWords) {
    const elapsedSec = (Date.now() - startTime) / 1000; 
    const wpm = elapsedSec > 0 ? Math.round((totalTypedWords / elapsedSec) * 60) : 0;
    wpmText.innerText = wpm;

    
}

// End test
function endTest() {
    clearInterval(interval);
    started = false;
    inputField.disabled = true;

    const typedWords = inputField.value.trim().split(/\s+/).filter(w => w.length > 0);
    const wpm = Math.round((typedWords.length / ((parseInt(timeSelect.value) - timer) / 60)));

    const userName = prompt("Enter your name for the leaderboard:");
    if(userName) {
        fetch("submit.php", {
            method: "POST",
            headers: {"Content-Type": "application/x-www-form-urlencoded"},
            body: `name=${encodeURIComponent(userName)}&wpm=${wpm}&time=${parseInt(timeSelect.value) - timer}`
        })
        .then(response => response.text())
        .then(data => {
            alert("Saved to leaderboard!");
            window.location.href = "leaderboard.php"; 
        });
    }

    wpmText.innerText = wpm;
}



// Reset
function resetTest() {
    clearInterval(interval);
    started = false;
    timer = parseInt(timeSelect.value) || 60;
    timeText.innerText = timer;

    inputField.value = "";
    inputField.disabled = true;

    textArray = [];
    currentIndex = 0;
    displayText.innerText = "Click 'Start Test' to begin";

    wpmText.innerText = "0";
    
}

// Events
startBtn.addEventListener("click", startTest);
resetBtn.addEventListener("click", resetTest);
timeSelect.addEventListener("change", resetTest);
difficultySelect.addEventListener("change", resetTest);

loadWords();
