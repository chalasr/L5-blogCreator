@extends('templates.default')

@section('title')
    Admin Login
@stop

@section('content')
    <h1>Login to the Blog</h1>
        
    <form class="login-form" role="form" method="post" action="{{ URL::route('postLogin') }}" >
        <div class="form-group {{ $errors->has('username') ? 'has-error' : ''}}">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username">

            @if ($errors->has('username'))
                {{ $errors->first('username') }}
            @endif
        </div>

        <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">

            @if ($errors->has('password'))
                {{ $errors->first('password') }}
            @endif
        </div>

        {!! Form::token() !!}

        <div class="form-group">
            <button type="submit" class="btn btn-default">Login</button>
        </div>
    </form>        
@stop