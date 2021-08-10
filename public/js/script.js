const quoteBody = document.getElementById('quote');
const scoreBody = document.getElementById('score');
const timerBody = document.getElementById('timer');
let hasStarted = false
let startTime
let wpm
let words
let interval
let regex = /(^[a-z A-z]{1}$)|(^\s$)|(^[,.?:;"'-]$)/
let index = 0

function getQuote() {
	return fetch('api/randomquote')
		.then(result => result.json())
		.then(result => text = result[0].quote)
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
	characterArray[index].style.background = "white"

	if(input.key.match(regex) && hasStarted == false){
		hasStarted = true
		startTimer()
	}
	if(index == characterArray.length - 1){
		characterArray[index].style.color = "green"
		characterArray[index].style.removeProperty("background")
		quoteBody.style.display = 'none'
		clearInterval(interval)
		let endTime = Date.now()
		let delta = endTime - startTime
		let seconds = delta / 1000
		let minutes = (seconds / 60).toFixed(2)
		console.log(seconds + " " + minutes)
		let wpm = Math.floor((characterArray.length / 5) / (minutes))
		scoreBody.removeAttribute('hidden')
		scoreBody.innerHTML = `<li>WPM:${wpm}`
		this.removeEventListener('keydown', arguments.callee)
		return 
	}
	if (input.key == characterArray[index].innerText && input.key.match(regex)) {
		characterArray[index].style.color = "green"
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
		characterArray[index].style.color = "red"
		characterArray[index].style.removeProperty("background")
		++index
		characterArray[index].style.background = "white"
	}
}

async function gameStart() {
	await splitCharacters();
	let characterArray = quoteBody.querySelectorAll('span')
	characterArray[0].style.background = "white"
	document.addEventListener("keydown", keyHandler)
}

gameStart()