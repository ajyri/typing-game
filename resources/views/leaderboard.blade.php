@extends('layouts.navbar')
@section('content')

    <body>
        <div class="container-fluid">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Source</th>
                        <th scope="col">Author</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quotes as $quote)
                        <tr>
                            <th scope="row">{{ $quote->id }}</th>
                            <td><a href="{{ url("viewscore/$quote->id") }}">{{ $quote->source }}</a></td>
                            <td>{{ $quote->author }}</td>
                            <td>{{$quote->scores}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
@endsection
