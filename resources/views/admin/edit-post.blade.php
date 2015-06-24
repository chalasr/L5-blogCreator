@extends('templates.default')

@section('title')
    Admin Dashboard
@stop

@section('content')
    <h1>Edit the Post</h1>
		<form role="form" method="post" action="{{ URL::route('editPost', $post->id) }}" >
			<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
			    <label for="title">Title</label>
			    <input type="text" class="form-control" name="title" id="title" placeholder="Enter Post Title" value="{{ $post->title }}">

			    @if ($errors->has('title'))
			        {{ $errors->first('title') }}
			    @endif
			</div>
			<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
			    <label for="image">Image</label>
			    <input type="text" class="form-control" name="image" id="image" value="{{ $post->image }}">
				<img src="{{ $post->image }}">
			    @if ($errors->has('image'))
			        {{ $errors->first('image') }}
			    @endif
			</div>

			<div class="form-group {{ $errors->has('body') ? 'has-error' : ''}}">
			    <label for="body">Post Body</label>
			    <textarea class="form-control" name="body" id="body" placeholder="Enter Post Body">{{ $post->body }}</textarea>

			    @if ($errors->has('body'))
			        {{ $errors->first('body') }}
			    @endif
			</div>

			<div class="form-group">
				<label for="draft">Draft</label>

				<div class="radio">
					<label>
						@if($post->draft == '1')
							<input checked type="radio" name="draft" value="1">Yes
						@else
							<input type="radio" name="draft" value="1">Yes
						@endif
					</label>
				</div>

				<div class="radio">	
					<label>
						@if($post->draft == '0')
							<input checked type="radio" name="draft" value="0">No
						@else
							<input type="radio" name="draft" value="0">No
						@endif
					</label>	
				</div>
			</div>

			{!! Form::token() !!}

			<div class="form-group">
			    <button type="submit" class="btn btn-default">Save Post</button>
			</div>
		</form>  
@stop