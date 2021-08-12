@extends('layouts.navbar')
@section('content')

    <body>
        <div class="container-fluid">
            <form action='{{url("api/quote/$quote->id")}}' method="POST">
                @method('PATCH')
                @csrf
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" class="form-control" id="author" name="author" value="{{ $quote->author }}">
                        </div>
                </div>
            </div>
	    <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
                        <div class="form-group">
                            <label for="author">Source</label>
                            <input type="text" class="form-control" id="source" name="source" value="{{ $quote->source }}">
                        </div>
                </div>
            </div>
	    <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
                        <div class="form-group">
                            <label for="author">Quote</label>
                            <textarea type="text" class="form-control" id="quote" name="quote" value="">{{$quote->quote}}</textarea>
                        </div>
			<div class="row text-center">
				<div class="col">
					<button class="btn">Save Changes</button>
                </form>
                <form action="{{url("api/quote/$quote->id")}}" method="POST">
                    @method('DELETE')
                    @csrf
					<button class="btn"> Delete </button>
                </form>
                </div>

			</div>
                </div>
            </div>
        </div>
    </body>
@endsection
