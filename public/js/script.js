
fetch('api/quote')
	.then(result => result.text())
	.then(result => console.log(result))