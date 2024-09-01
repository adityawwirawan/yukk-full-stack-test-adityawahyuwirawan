<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Yukk-Test') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" />

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="sidebar">
                <div class="logo" style="padding-top: 20px; padding-left:10px">
                    <img src="{{asset('images/YUKK.png')}}">
                </div>
                <ul>
                    <li style="@if (Request::segment(1)=='transaksi') background:#c31f87 @endif">
                        <a href="{{ route('transaksi') }}">
                            <i class="fa fa-usd"></i>
                            <span style="padding-left: 10px"> Transaksi
                        </a>
                    </li>
                    <li style="@if (Request::segment(1)=='riwayat') background:#c31f87 @endif">
                        <a href="{{ route('riwayat') }}">
                            <i class="fa fa-history"></i>
                            <span style="padding-left: 10px"> Riwayat Saldo
                        </a>
                    </li>
                </ul>

                <div class="sidebar-footer">
                    <ul>
                        <li>
                            <a href="{{ route('logout') }}">
                                <i class="fa fa-sign-out"></i>
                                <span style="padding-left: 10px"> Log Out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="container">
                {{-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Yukk-Testcode') }}
                </a> --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="navbar-brand"> <i class="fa fa-user-circle" aria-hidden="true"></i> <label><h6>{{ Auth::user()->name }}</h2></label> </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="main-content">
            @yield('content')
        </main>
    </div>
</body>
</html>
