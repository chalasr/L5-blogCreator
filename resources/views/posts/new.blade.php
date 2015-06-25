@extends('templates.default')

@section('title')
    Admin Dashboard
@stop

@section('content')
	<h2>Add a New Post</h2>

	<div class="new-post">
		<form role="form" method="post" action="{{ URL::route('posts.store') }}" >
			<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
			    <label for="title">Title</label>
			    <input type="text" class="form-control" name="title" id="title" placeholder="Enter Post Title">

			    @if ($errors->has('title'))
			        {{ $errors->first('title') }}
			    @endif
			</div>

			<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
			    <label for="image">Image</label>
			    <input type="text" class="form-control" name="image" id="image" placeholder="Image URL">

			    @if ($errors->has('image'))
			        {{ $errors->first('image') }}
			    @endif
			</div>

			<div class="form-group {{ $errors->has('body') ? 'has-error' : ''}}">
			    <label for="body">Post Body</label>
			    <textarea class="form-control" name="body" id="body" placeholder="Enter Post Body"></textarea>

			    @if ($errors->has('body'))
			        {{ $errors->first('body') }}
			    @endif
			</div>

			<div class="form-group">
				<label for="draft">Draft</label>

				<div class="radio">
					<label>
						<input type="radio" name="draft" value="1">Yes
					</label>
				</div>

				<div class="radio">
					<label>
						<input checked type="radio" name="draft" value="0">No
					</label>
				</div>
			</div>

			{!! Form::token() !!}

			<div class="form-group">
			    <button type="submit" class="btn btn-default">Save Post</button>
			</div>
		</form>
	</div><!-- new-post -->

@stop
