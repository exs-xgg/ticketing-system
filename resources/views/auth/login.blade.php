<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Wireless Access for Health</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mdb-pro.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lms.css') }}" rel="stylesheet">
    <style>
        .borderbot {
            border-bottom: 1px solid #929496 !important
        }
    </style>
</head>
<body>
    <div id="app" class="login_page">
        @include('partials.guest_nav')
        <div class="">
            {{-- <div class="full-bg-img rgba-black-light"> --}}
            <div class="full-bg-img">
                <main class="py-4">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5 col-sm-10 col-md-8 my-5">
                                <div class="card card-login">
                                    <div class="card-body">
                                        <div class="row justify-content-center">
                                            <img src="{{asset('images/wah1.png')}}" class="img-fluid" alt="">
                                        </div>
                                        <form action="{{route('login')}}" method="post">
                                            @csrf
                                            <div class="md-form">
                                                <input type="text" name="email" id="email" value="{{old('email')}}" class="form-control borderbot {{ $errors->has('email') ? 'is-invalid' : '' }}">
                                                <label for="email">Username or Email</label>
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="md-form">
                                                <input type="password" id="password" name="password" class="form-control borderbot {{ $errors->has('password') ? 'is-invalid' : '' }}">
                                                <label for="password">Password</label>
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="row justify-content-between d-flex">
                                                <div class="md-form mt-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                        <label class="form-check-label" for="remember">
                                                            {{ __('Remember Me') }}
                                                        </label>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <button type="submit" name="button" class="btn btn-primary btn-block mt-4">Login</button>

                                            <center> <a class="btn btn-link" href="{{ route('register') }}">
                                                    {{ __('Dont have an account yet? click here.') }}
                                                </a></center>

                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/mdb.min.js') }}"></script>
    @yield('script')
</body>
</html>
