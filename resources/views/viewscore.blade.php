@extends('layouts.navbar')
@section('content')

    <body>
        <div class="container-fluid text-center">
            <h1>Scores for quote {{$scores[0]->quote_id}}</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">WPM</th>
                        <th scope="col">Accuracy</th>
                        <th scope="col">User</th>
                        <th scope="col">Score date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($scores as $score)
                        <tr>
                            <td>{{ $score->wpm }}</a></td>
                            <td>{{ $score->acc }}</td>
                            <td>{{$score->name}}</td>
                            <td>{{$score->created_at}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
@endsection
