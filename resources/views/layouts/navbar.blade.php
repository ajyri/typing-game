<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <title>@yield('title')</title>
</head>
<nav class="navbar">
	<div class="container m-0 p-0">
		<h3>Unnamed Typing Game</h3>
    </div>
</nav>
@yield('content')
</html>