@extends('templates.default')

@section('title')
    Admin Dashboard
@stop

@section('content')
    <h1>Admin Dashboard</h1>

    @if($blogs->count())
      <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Type</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($blogs as $item)
          <tr >
            <td>{{ $item->name }}</td>
            <td>{{ $item->description }}</td>
            <td>
              <a class="btn btn-default" href="{{URL::to('admin/delete/blog/'.$item->id)}}">Remove</a>
              <a class="btn btn-default" href="{{URL::to('blogs/'.$item->id.'/edit')}}">Edit</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
  @endif

@stop
