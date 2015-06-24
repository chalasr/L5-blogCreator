<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')| Blog</title>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ URL::route('home') }}">Simple Laravel Blog</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="{{ URL::route('home') }}">Home</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">

            @if(!Auth::check())
              <li><a href="{{ URL::route('getLogin') }}">Login</a></li>
             @else
              <li><a href="{{ URL::route('adminDash') }}">Admin Dash</a></li>
              <li><a href="{{ URL::route('getLogout') }}">Logout</a></li>
            @endif

        </ul>
        </div>
      </div>
    </nav>

    <div class="container">
      @if(Session::has('success'))
        <div class="alert alert-success" > {{ session::get('success') }}</div>
      @elseif(Session::has('fail'))
        <div class="alert alert-danger"> {{ session::get('fail') }}</div>
      @endif