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
@stop