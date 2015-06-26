<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')| Blog</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
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
          <a class="navbar-brand" href="{{ URL::route('home') }}">L5 Blog Creator</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="{{ URL::route('home') }}">Home</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">

            @if(!Auth::check())
              <li><a href="{{ URL::route('getLogin') }}">Login</a></li>
             @elseif(Auth::user()->isAdmin == 1)
               <li><a href="{{ URL::route('posts.create') }}">New post</a></li>
               <li>
                 <a class="dropdown-toggle" href="#" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                   Admin
                   <span class="caret"></span>
                 </a>
                 <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                   <li><a href="{{ URL::to('blogs/create') }}">New Blog</a></li>
                   <li><a href="{{ URL::to('admin/dash') }}">Manage Blogs</a></li>
                 </ul>
               </li>
              <li><a href="{{ URL::route('getLogout') }}">Logout</a></li>
             @else
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
