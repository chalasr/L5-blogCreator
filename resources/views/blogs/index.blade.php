@extends('templates.default')

@section('content')
	<div class="all-posts">
		<h1>All Posts</h1>
		<ul class="list-group">
			@foreach($posts as $post)
			<li class="list-group-item">{{ $post->title }}
				<div style="float:right">
					<a href="{{ URL::route('deletePost', $post->id) }}" class="btn btn-danger btn-xs">Delete</a>
					<a href="{{ URL::route('getEditPost', $post->id) }}" class="btn btn-default btn-xs">Edit</a>
				</div>
			</li>
			@endforeach
		</ul>
	</div>
  @stop
