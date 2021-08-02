<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{asset('js/app.js')}}" defer></script>
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <title>@yield('title')</title>
</head>
<nav>
	<div>
		This is a navbar
	</div>
</nav>
@yield('content')
</html>