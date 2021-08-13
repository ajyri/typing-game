//Initialize variables.
const quoteBody = document.getElementById('quote');
const scoreBody = document.getElementById('score');
const timerBody = document.getElementById('timer');
const wpmBody = document.getElementById('wpm')
const accBody = document.getElementById('accuracy')
const wordBody = document.getElementById('wordcount')
const timeBody = document.getElementById('time')
const userBody = document.getElementById('user')
let token
let hasStarted = false
let regex = /(^[a-z A-z]{1}$)|(^\s$)|(^[,.?:;"'-]$)/ //Regex for reading only alphabetical characters, whitespace or punctuation marks.
let index = 0
let mistakes = 0
let correctChars = 0
let startTime
let wpm
let words
let interval
let accuracy
let quote


function saveScore(){
	token = document.querySelector('meta[id="csrf-token"]')['content']
	
	fetch('api/savescore', {
		method: 'post',
		headers: {
			'X-CSRF-TOKEN':token,
			'Accept': 'application/json',
			'Content-Type': 'application/json'
		},
		body: JSON.stringify({quote_id: quote.id, wpm: wpm, acc:accuracy})
	})
	.then(res => res.text())
	.then(res => console.log(res))
}

function getQuote() {
	return fetch('api/randomquote')
		.then(result => result.json())
		.then(result => quote = result)

}

//Split every character and insert them into a span, then append those spans inside the quote body.
async function splitCharacters() {
	quote.quote.split("").map((char) => {
		const span = document.createElement('span')
		span.innerText = char
		quoteBody.appendChild(span)
		return span;
	})
}

function startTimer(){
timerBody.removeAttribute('hidden')
startTime = Date.now()
interval = setInterval(() => {
	timerBody.innerText = getTimerTime()
}, 1000)
}

function getTimerTime(){
	return Math.floor((new Date() - startTime) / 1000)
}


//Read incoming inputs and handle them accordingly.

async function keyHandler(input) {
	let characterArray = quoteBody.querySelectorAll('span')

	if(input.key.match(regex) && hasStarted == false){
		hasStarted = true
		startTimer()
	}

	//If the input happens on the last character in the quote stop the game and calculate the score.
	if(index == characterArray.length - 1){
		characterArray[index].style.removeProperty("background")
		quoteBody.style.display = 'none'
		clearInterval(interval)
		let endTime = Date.now()
		let delta = endTime - startTime
		let seconds = delta / 1000
		let minutes = (seconds / 60).toFixed(2)
		wpm = Math.floor((correctChars / 5) / (minutes))
		accuracy = Math.floor(100 - (mistakes / characterArray.length)*100)
		scoreBody.removeAttribute('hidden')
		userBody.removeAttribute('hidden')
		timerBody.style.display = 'none'

		wpmBody.innerHTML = `<li>WPM: ${wpm}</li>`
		accBody.innerHTML = `<li>Accuracy: ${accuracy}%</li>`
		wordBody.innerHTML = `<li>Total words: ${words}</li>`
		timeBody.innerHTML = `<li>Total time: ${Math.floor(seconds)} seconds</li>`

		this.removeEventListener('keydown', keyHandler)
		saveScore()
		return 
	}
	if (input.key == characterArray[index].innerText && input.key.match(regex)) {
		++correctChars
		characterArray[index].style.color = "white"
		characterArray[index].style.removeProperty("background")
		++index
		characterArray[index].style.background = "white"
	}
	else if(input.key == "Backspace"){
		characterArray[index].style.removeProperty("background")
		--index
		characterArray[index].style.removeProperty("color")
		characterArray[index].style.background = "white"

	}
	else if (input.key !== characterArray[index].innerText && input.key.match(regex)) {
		characterArray[index].style.color = "salmon"
		characterArray[index].style.removeProperty("background")
		++index
		++mistakes
		--words
		characterArray[index].style.background = "white"
	}
}

async function gameStart() {
	await getQuote();
	await splitCharacters();
	words = quote.quote.split(" ").length
	let characterArray = quoteBody.querySelectorAll('span')
	characterArray[0].style.background = "rgba(255,255,255,0.7)"
	document.addEventListener("keydown", keyHandler)
}

gameStart()