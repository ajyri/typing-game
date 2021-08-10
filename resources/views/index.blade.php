@extends('layouts.navbar')
@section('title')
    Typing Game
@endsection
@section('content')

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
                            @endguest
                        </div>
                        <div id="timer" class="text-center" hidden>0</div>
                        <div id="quote" class="text-center"></div>
                        <ul id="score" class="text-center" hidden>

                        </ul>
                    </div>
                    </div>
                </div>
            </div>     


    </body>
    <script src="{{ asset('js/script.js') }}" defer></script>
@endsection
