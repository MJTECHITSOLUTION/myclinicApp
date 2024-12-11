<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tayssir - Login</title>

    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">

    <!-- Custom styles for this template-->
    <link href="{{ asset('dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        .login-container {
            display: flex;
            height: 100vh;
        }

        .login-form {
            flex: 1;
            padding: 50px;
            text-align: right;
        }

        .login-image {
            flex: 1;
            background-image: url('pharmacist.jpg');
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-image img {
            max-width: 200px;
        }

        .small-logo {
            max-width: 100px;
        }

        .form-control-user {
            padding: 8px;
            font-size: 14px;
        }
    </style>
</head>

<body class="bg-gradient-primary">
    <div class="login-container">
        <div class="login-image">
        </div>
        <div class="login-form">
            <div class="text-center">
                {{--            <h4 class="h5 text-gray-700 mb-4">{{ __('sentence.Welcome') }}</h4> --}}
            </div>
            <div class="login-form" style="margin-top: 35%;">
                <div class="text-center">
                    <img src="{{ asset('img/logo-grey.png') }}" class="small-logo">
                    <h4 class="h5 text-gray-700 mb-4">{{ __('sentence.Welcome') }}</h4>
                </div>
                <form method="POST" action="{{ route('login') }}" class="user">
                    <div class="form-group">
                        <input id="email" type="email"
                            class="form-control form-control-sm form-control-user @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            aria-describedby="emailHelp" placeholder="{{ __('sentence.Email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="password" type="password"
                            class="form-control form-control-sm form-control-user @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password"
                            placeholder="{{ __('sentence.Password') }}">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                            <input class="custom-control-input" type="checkbox" name="remember" id="customCheck"
                                {{ old('remember') ? 'checked' : '' }}>
                            {{ csrf_field() }}
                            <label class="custom-control-label"
                                for="customCheck">{{ __('sentence.Remember Me') }}</label>
                        </div>
                    </div>
                    <button class="btn   btn-sm btn-warning btn-user btn-block"
                        type="submit">{{ __('sentence.Login') }}</button>
                </form>
                <hr>
                @if (Route::has('password.request'))
                    <div class="text-center">
                        <a class="small"
                            href="{{ route('password.request') }}">{{ __('sentence.Forgot Your Password') }}</a>
                    </div>
                @endif
            </div>

            <hr>
            @if (Route::has('password.request'))
                <div class="text-center">
                    <a class="small"
                        href="{{ route('password.request') }}">{{ __('sentence.Forgot Your Password') }}</a>
                </div>
            @endif
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>
