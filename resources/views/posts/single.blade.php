@extends('templates.default')

@section('title')
    {{ $post->title }}
@stop

@section('content')
    <article>
        <h1>{{ $post->title }}</h1>
        <p><b>Posted on {{ $post->created_at->format('l jS \\of F Y') }}</b></p>
        {!! nl2br(Markdown::parse($post->body)) !!}
    </article>

    <hr />
    <article>
		<form role="form" method="post" action="{{ URL::route('comments.store') }}"" >

			<div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
				<input name="_token" type="hidden" value="{!! csrf_token() !!}" />
				<input type="hidden" value="{{ $post->id }}" name="post">
			    <label for="title">Contenu</label>
			    <input type="text" class="form-control" name="content" id="content" placeholder="Entrez votre commentaire">

			    @if ($errors->has('content'))
			        {{ $errors->first('content') }}
			    @endif
			</div>
		</form> 
	</article>
    	@foreach($post->comments as $comment)
    		<p>{{ $comment->content }}</p>
    	@endforeach
@stop