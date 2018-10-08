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
    @yield('styles')

    {{-- Icon --}}
    <link rel="shortcut icon" href="{{ asset('devmarketer-icon.jpg') }}">
</head>
<body>

    {{-- header --}}
    @include('_includes.nav.main')

    <div id="app">
    
        {{-- content --}}
        @yield('content')
    
        {{-- footer --}}
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @include('_includes.notifications.toast')
    @yield('scripts')
    
</body>
</html>
