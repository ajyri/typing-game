<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <script src="{{asset('js/app.js')}}"></script>
    <title>@yield('title')</title>
</head>
<nav class= "navbar navbar-expand-lg">
<div class="container-fluid m-0 p-0">
		<div class="">
            <a class="navbar-brand" href="{{url('/')}}">Unnamed Typing Game</a>
        </div>
            <ul class="navbar-nav p-0">
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/register')}}">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/login')}}">Login</a>
                </li>
                @endguest
                @auth
                <li class="nav-item mr-3">
                    <a href="{{url('leaderboards')}}">Leaderboards</a>
                </li>
                <li class="nav-item dropdown" role="button">
                    <a class="nav-item dropdown-toggle" data-toggle="dropdown" id="navbarDropdown">{{Auth::user()->name}}</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="">My Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         {{ __('Logout') }}
                     </a>

                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                         @csrf
                     </form>
                    </div>
                </li>  
                @endauth
            </ul>
        </div>
</div>

</nav>
@yield('content')
</html>