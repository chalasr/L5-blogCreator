@extends('templates.default')

@section('title')

    Home

@stop

@section('content')
	<h2>Create a new Blog</h2>

	<div class="new-post">
		<form role="form" method="post" action="{{ URL::route('blogs.store') }}" >
			<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
			    <label for="title">Title</label>
			    <input type="text" class="form-control" name="name" id="title" placeholder="Enter Blog Title">

			    @if ($errors->has('name'))
			        {{ $errors->first('name') }}
			    @endif
			</div>

			<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
			    <label for="description">Blog Description</label>
			    <textarea class="form-control" name="description" id="description" placeholder="Enter Post Description"></textarea>

			    @if ($errors->has('description'))
			        {{ $errors->first('description') }}
			    @endif
			</div>

      {!! Form::token() !!}

			<div class="form-group">
			    <button type="submit" class="btn btn-default">Save Blog</button>
			</div>
		</form>
	</div><!-- new-post -->

@stop
