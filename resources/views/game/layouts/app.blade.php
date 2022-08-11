<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('image/logo.svg') }}" type="image/svg" sizes="32x32">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md fixed-top navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex text-center" href="{{ url('/') }}">
                    <img src="{{ asset('image/logo.svg') }}" alt="logo" class="mr-2" height="50">
                    <h3 class="mb-0 align-self-center"><span class="text-primary">Touch</span> <span class="text-success">To</span> <span class="text-danger">Play</span>!</h3>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item{{ Request::is('community') || Request::is('community/*') || Request::is('myposts') || Request::is('mycomments') ? ' active-link' : '' }}">
                            <a class="nav-link" href="{{ url('/community') }}">Community</a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item{{ Request::is('login') ? ' active-link' : '' }}">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item{{ Request::is('register') ? ' active-link' : '' }}">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="{{ url('/account/management') }}" class="dropdown-item text-center">Manage Account</a>
                                    @if (Auth::user()->is_admin === 1)
                                        <a class="dropdown-item text-center" href="{{ url('/admin') }}">Admin Sites</a>
                                    @endif
                                    <a class="dropdown-item text-center" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        <li class="nav-item align-self-center">
                            <img id="fullscreen" src="{{ asset('image/games/icons/expand.svg') }}" alt="fullscreen" class="cursor-pointer" height="30px" onclick="openFullScreen();">
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>

        <div id="mobile-tips" class="d-md-none" style="position: absolute; width:100%; min-height:100vh; background-color:black; opacity:0.7; z-index:1; display: none;">
            <div class="container min-vh-100">
                <div class="d-flex justify-content-end" style="padding-top: 77px">
                    <span style="font-size: 64px; color: white;">^</span>
                </div>
                <div class="d-flex justify-content-center">
                    <span style="font-size: 32px; color: white;">Click</span>
                </div>
                <div class="d-flex justify-content-center">
                    <span style="font-size: 32px; color: white;">To</span>
                </div>
                <div class="d-flex justify-content-center">
                    <span style="font-size: 32px; color: white;">Select</span>
                </div>
                <div class="d-flex justify-content-center">
                    <span style="font-size: 32px; color: white;">Full</span>
                </div>
                <div class="d-flex justify-content-center">
                    <span style="font-size: 32px; color: white;">Screen</span>
                </div>
            </div>
        </div>
        <div id="mobile-mask" class="d-md-none" style="position: absolute; width:100%; min-height:100vh; z-index:2; display: none;"></div>
    </div>
    <script>
        var elem = document.getElementById("gameIframe");
        function openFullScreen() {
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.webkitRequestFullscreen) { /* Safari */
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) { /* IE11 */
                elem.msRequestFullscreen();
            }
        }
        if (typeof(Storage) !== "undefined") {
            if (localStorage["full-screen-remember"] === null || localStorage["full-screen-remember"] !== "true") {
                $("#fullscreen").click(function () {
                    localStorage["full-screen-remember"] = "true";
                    $("#mobile-tips,#mobile-mask").hide();
                });
                $("#mobile-tips,#mobile-mask").fadeIn(2000);
            }
        }
    </script>
</body>
</html>
