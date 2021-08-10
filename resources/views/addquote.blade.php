@extends('layouts.navbar')
@section('content')

    <body>
        <div class="container-fluid">
            <form action="{{url("api/quote/")}}" method="POST">
                @csrf
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" class="form-control" id="author" name="author">
                        </div>
                </div>
            </div>
	    <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
                        <div class="form-group">
                            <label for="author">Source</label>
                            <input type="text" class="form-control" id="source" name="source">
                        </div>
                </div>
            </div>
	    <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
                        <div class="form-group">
                            <label for="author">Quote</label>
                            <textarea type="text" class="form-control" id="quote" name="quote" value=""></textarea>
                        </div>
			<div class="row">
				<div class="col">
					<button class="btn">Save Quote</button>
				</div>

			</div>
                </div>
            </div>
        </form>
        </div>
    </body>
@endsection
