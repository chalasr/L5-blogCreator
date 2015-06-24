@extends('templates.default')

@section('title')

    Home

@stop

@section('content')

    @if($posts->count())

        @foreach(array_chunk($posts->getCollection()->all(), 3) as $row)

            <div class="row">

                @foreach ($row as $item)

                    <article class="col-md-4">

                        <h1><a href="{{ URL::route('fullPost', $item->slug) }}">{{ $item->title }}</a></h1>
                        
                        <p><b>Posted on {{ $item->created_at->diffForHumans() }}</b></p>
                        
                        <img src="{{ $item->image }}" title="{{ $item->title}}" alt="">
                        
                        {!! Markdown::parse(Str::limit($item->body, 200)) !!}
                        
                        <a href="{{ URL::route('fullPost', $item->slug) }}" class="btn btn-primary">ReadMore
                        </a>

                    </article>

                @endforeach

            </div>

        @endforeach

        {!! $posts->appends(Request::except('page'))->render() !!}

    @endif

@stop