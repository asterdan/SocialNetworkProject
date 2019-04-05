<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/chat.js') }}" defer></script>
    <script src="{{ asset('js/profile.js') }}" defer></script>
    <link href="{{ asset('css/sidenav.css') }}" rel="stylesheet">
    <link href="{{ asset('css/myhomeleftsidebar.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profilepage.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
            
        </style>
</head>
<body>
    
    <div id="app">
            
        <nav class="navbar navbar-expand-md navbar-light  fixed-top" style="background-color:royalblue !important; " >
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="color:gainsboro !important;">
                    Shqip liber
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                @guest
                    @else
                    {!!Form::open(['action'=>'SearchController@searchByName','method'=>'post','class'=>'navbar-form navbar-left form-inline','role'=>'search'])!!}
                        <div class="form-group">
                            {{Form::text('search_name','',['class'=>'form-control','placeholder'=>'search'])}}
                            &nbsp;
                            <button type="submit" class="btn btn-default">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    {!!Form::close()!!}
                  
                    @endguest

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto" >
                        <!-- Authentication Links -->
                        @guest
                           
                            <li class="nav-item">
                                <a  style="color:gainsboro !important;" class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a  style="color:gainsboro !important;" class="nav-link" href="{{ route('registration') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item">
                                <a style="color:gainsboro !important;" class="nav-link" href="{{route('myProfile')}}">{{__('Go to my profile')}}</a></li>
                            <li class="nav-item dropdown">
                                <a style="color:gainsboro !important;"  id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a style="color:gainsboro !important;" class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        
                            @endguest
                   
                   
                   
                   
                   
                   
                   
                        
                        
                        
                        
                        
                        </ul>
                </div>
            </div>
        </nav>

      
<script>

    </script>
@guest
<h3>You are not logged </h3>

@else
<div id="mySidenav" class="sidenav">
    <div class="card">
        <div class="card-header">
            <b>Friends online</b>
        </div>
        <div class="card-body">
                <ul class="list-group">
                        @foreach($data['friends'] as $friend)
                        
                        <li class="list-group-item btnLn" style="width:230px;">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-2">
                                            <img src="https://getuikit.com/v2/docs/images/placeholder_600x400.svg" class="img img-thumbnail" />
                                    </div>
                                    <div class="col-sm-6" class="userLink">
                                            <b href="#" id="{{$friend->friend_id}}" class="btnUser">{{$friend->username}}</b>
                                    </div>
                                </div>
                            </div>
                            
                        </li>
                        <form id="form{{$friend->friend_id}}">
                            <input  type="hidden" name="sent_to" value="{{$friend->friend_id}}" />
                        </form>
                       
                        @endforeach
                    </ul>
        </div>
    </div>
        
</div>
<div id="chatzone">

</div>
@endguest
 


        <main class="py-4">
                
            @include('include.messages')
            @yield('content')
        </main>
    </div>
</body>
</html>
