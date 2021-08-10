const quoteBody = document.getElementById('quote');
const scoreBody = document.getElementById('score');
const timerBody = document.getElementById('timer');
const wpmBody = document.getElementById('wpm')
const accBody = document.getElementById('accuracy')
const wordBody = document.getElementById('wordcount')
const timeBody = document.getElementById('time')
const userBody = document.getElementById('user')

let hasStarted = false
let regex = /(^[a-z A-z]{1}$)|(^\s$)|(^[,.?:;"'-]$)/
let index = 0
let mistakes = 0
let correctChars = 0
let startTime
let wpm
let words
let interval


function getQuote() {
	return fetch('api/quote/4')
		.then(result => result.json())
		.then(result => text = result.quote)
}

async function splitCharacters() {
	let text = await getQuote();
	text.split("").map((char) => {
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

async function keyHandler(input) {
	console.log(input.key)
	words = await getQuote();
	words = words.split(" ").length
	let characterArray = quoteBody.querySelectorAll('span')

	if(input.key.match(regex) && hasStarted == false){
		hasStarted = true
		startTimer()
	}
	if(index == characterArray.length - 1){
		characterArray[index].style.removeProperty("background")
		quoteBody.style.display = 'none'
		clearInterval(interval)
		let endTime = Date.now()
		let delta = endTime - startTime
		let seconds = delta / 1000
		let minutes = (seconds / 60).toFixed(2)
		let wpm = Math.floor((correctChars / 5) / (minutes))
		let accuracy = Math.floor(100 - (mistakes / characterArray.length)*100)
		scoreBody.removeAttribute('hidden')
		userBody.removeAttribute('hidden')
		timerBody.style.display = 'none'

		wpmBody.innerHTML = `<li>WPM: ${wpm}</li>`
		accBody.innerHTML = `<li>Accuracy: ${accuracy}%</li>`
		wordBody.innerHTML = `<li>Total words: ${words}</li>`
		timeBody.innerHTML = `<li>Total time: ${Math.floor(seconds)} seconds</li>`

		this.removeEventListener('keydown', keyHandler)
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
	await splitCharacters();
	let characterArray = quoteBody.querySelectorAll('span')
	characterArray[0].style.background = "rgba(255,255,255,0.7)"
	document.addEventListener("keydown", keyHandler)
}

gameStart()