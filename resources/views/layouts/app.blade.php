<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DevMarketer</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Icon --}}
    <link rel="shortcut icon" href="{{ asset('devmarketer-icon.jpg') }}">
</head>
<body>
    <div id="app">

        {{-- header --}}
        <nav class="navbar has-shadow">
            <div class="container">
                <div class="navbar-start">
                    <a class="navbar-item" href="{{route('home')}}">
                        <img src="{{ asset('images/devmarketer-logo.png') }}" alt="DevMarketer"/>
                    </a>
                    <a href="#" class="navbar-item is-tab is-hidden-mobile m-l-10">Learn</a>
                    <a href="#" class="navbar-item is-tab is-hidden-mobile">Discuss</a>
                    <a href="#" class="navbar-item is-tab is-hidden-mobile">Share</a>
                </div>
                
                <div class="navbar-end">
                    @if (Auth::guest())
                        <a href="{{route('login')}}" class="navbar-item is-tab">LogIn</a>
                        <a href="{{route('register')}}" class="navbar-item is-tab">Join the community</a>
                    @else
                        <button class="dropdown is-aligned-right navbar-item is-tab">
                            Hey Aabed <span class="icon"><i class="fa fa-caret-down"></i></span>

                            <ul class="dropdown-menu">
                                <li><a href="#">
                                    <span class="icon"><i class="fa fa-w m-r-10 fa-user-circle"></i></span>
                                    Profile</a></li>
                                <li><a href="#">
                                    <span class="icon"><i class="fa fa-w m-r-10 fa-bell"></i></span>
                                    Notifications</a></li>
                                <li><a href="#">
                                    <span class="icon"><i class="fa fa-w m-r-10 fa-cog"></i></span>
                                    Settings</a></li>
                                <li class="separator"></li> {{-- to separate items with line --}}
                                <li><a href="#">
                                    <span class="icon"><i class="fa fa-w m-r-10 fa-sign-out"></i></span>
                                    Logout</a></li>
                            </ul>
                        </button>
                    @endif
                </div>
            </div>
        </nav>
        {{-- content --}}
        @yield('content')

        {{-- footer --}}
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
