@extends('templates.default')

@section('title')
    {{ $blog->name }} Dashboard
@stop

@section('content')
    <h1>Blog's posts</h1>
    @if($blog->count())

            <div class="row">

                @foreach ($blog->posts as $item)

                <article class="col-md-4">
                  <h1><a href="{{ URL::route('fullPost', $item->slug) }}">{{ $item->name }}</a></h1>
                  <p><b>Posted on {{ $item->created_at->diffForHumans() }}</b></p>
                  <img src="{{ $item->image }}" title="{{ $item->title}}" alt="">

                   {!! Markdown::parse(Str::limit($item->body, 200)) !!}

                   <a href="{{ URL::route('fullPost', $item->slug) }}" class="btn btn-primary">ReadMore</a>
                </article>
                @endforeach

            </div>

    @endif


@stop
