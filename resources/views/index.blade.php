@extends('layouts.navbar')
@section('title')
    Typing Game
@endsection
@section('content')
<meta id="csrf-token" content="{{ csrf_token() }}" />
    <body>
            <div class="container h-100">
                <div class="row align-items-center h-100 justify-content-center">
                    <div class="col-6 mx-auto mt-5">
                    <div id="quoteContainer">
                        <div id="user" class="text-center" hidden>
                            @auth
                                <h3>Results for: {{Auth::user()->name}}</h3>
                            @endauth
                            @guest
                                <h1>Results for: Guest</h1>
                               <p><a href="{{url('register')}}">Sign in</a> to save and view your scores.</p>
                            @endguest
                        </div>
                        <div id="timer" class="text-center" hidden>0</div>
                        <div id="quote" class="text-center"></div>
                        <ul id="score" class="text-center" hidden>
                            <li id="wpm"></li>
                            <li id="accuracy"></li>
                            <li id="wordcount"></li>
                            <li id="time"></li>
                        </ul>
                        <div class="text-center" hidden>
                            <button>test</button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>     


    </body>
    <script src="{{ asset('js/script.js') }}" defer></script>
@endsection
