@extends('templates.default')

@section('title')
    Home
@stop

@section('content')
      <div class="jumbotron">
        <h1>Welcome on BlogCreator!</h1>
      </div>
      @if($blogs->count())
        <div class="row">
            @foreach ($blogs as $item)
                <article class="col-md-4">
                    <h1><a href="{{ URL::route('fullBlog', $item->slug) }}">{{$item->name}}</a></h1>
                    {!! Markdown::parse(Str::limit($item->description, 200)) !!}
                    <a href="{{ URL::route('fullBlog', $item->slug) }}" class="btn btn-primary">Visit</a>
                </article>
            @endforeach
        </div>
      @else
    @endif

@stop
