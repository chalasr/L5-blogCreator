@extends('templates.default')

@section('title')

    Home

@stop

@section('content')

    @if($blogs->count())

            <div class="row">

                @foreach ($blogs as $item)

                    <article class="col-md-4">
                        <h1><a href="{{ URL::route('fullBlog', $item->slug) }}">{{$item->name}}</a></h1>

                        <p><b>Posted on {{ $item->created_at->diffForHumans() }}</b></p>
                        {!! Markdown::parse(Str::limit($item->description, 200)) !!}

                        <a href="{{ URL::route('fullBlog', $item->slug) }}" class="btn btn-primary">ReadMore</a>

                    </article>

                @endforeach

            </div>

    @endif

@stop
