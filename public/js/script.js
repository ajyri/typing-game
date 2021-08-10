const quoteBody = document.getElementById('quote');
const scoreBody = document.getElementById('score');
const timerBody = document.getElementById('timer');
let startTime

function getQuote() {
	return fetch('api/quote/5')
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
timerBody
}

async function gameStart() {
	let regex = /(^\w{1}$)|(^\s$)/
	let index = 0
	await splitCharacters();
	let characterArray = quoteBody.querySelectorAll('span')
	characterArray[index].style.background = "white"
	document.addEventListener('keydown', (input) => {
		console.log(input.key)
		if(index == characterArray.length - 1){
			characterArray[index].style.color = "green"
			characterArray[index].style.removeProperty("background")
			quoteBody.style.display = 'none'
			scoreBody.style.removeProperty('hidden')
			return 
		}
		if (input.key == characterArray[index].innerText && input.key.match(regex)) {
			characterArray[index].style.color = "green"
			characterArray[index].style.removeProperty("background")
			index++
			characterArray[index].style.background = "white"
		}
		else if (input.key !== characterArray[index].innerText && input.key.match(regex)) {
			characterArray[index].style.color = "red"
			characterArray[index].style.removeProperty("background")
			index++
			characterArray[index].style.background = "white"
		}
	})
}

gameStart()