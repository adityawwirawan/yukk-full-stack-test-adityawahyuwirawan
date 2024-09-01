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
    <div class="container-fluid">
        <div class="row" style="  height: 100vh;">
            <div class="col-6" style="background-color: #cc2f8e; background-image: url({{asset('/images/bg-login2.jpg')}});background-size: 100% 100%;background-repeat:no-repeat">
            </div>
            <div class="col-6" style="display: flex;align-items: center;justify-content: center; flex-direction: column; background-color: #f2e7fe">
                <div style="padding-bottom: 50px">
                    <h1><b><font color="#c31f87">Log In</font></b></h1>
                </div>
                @if (Session::has('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="btn-close pull-right" data-dismiss="alert"></button>
                        <strong>{{ Session::get('success') }}</strong>
                    </div>
                @endif
                <div class="card" style="width: 50%;background-color: #212529; padding-top:40px; padding-bottom:40px;">

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3" style="justify-content: center">
                                {{-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> --}}

                                <div class="col-md-9">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-5" style="justify-content: center">
                                {{-- <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label> --}}

                                <div class="col-md-9">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-md btn-purple" style="width: 120px;">
                                        <b>{{ __('LOG IN') }}</b>
                                    </button>

                                </div>
                            </div>

                            <div class="row mb-0" style="">
                                <a class="btn btn-link" href="{{ route('register') }}">
                                    <font color="#b8b9bb"> <b> {{ __('Didnt have account?') }} <font color="#c31f87"> {{ __('Register') }} </font> </b></font>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
