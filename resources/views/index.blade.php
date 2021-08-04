@extends('layouts.navbar')
@section('title')
    Typing Game
@endsection
@section('content')
<body>
    <div id="timer">0</div>
    <div id="container">
    <div id="quote"></div>
    <div id="score" class="hidden"></div>
    </div>
</body>
<script src="{{asset('js/script.js')}}" defer></script>
@endsection

