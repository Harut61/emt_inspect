<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>emt | inspect </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/users/login-1.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

</head>

<body class="login">

    <form class="form-login" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="row">
            <div class="col-md-12 text-center mb-4">
                <img alt="logo" src="assets/img/logo-5.png" class="theme-logo">
            </div>

            <div class="col-md-12">
                <label for="email" class="">Login</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label for="password" class="">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="checkbox d-flex justify-content-between mb-4 mt-3">
                    <div class="custom-control custom-checkbox mr-3">

                        <input class="custom-control-input" type="checkbox" name="remember" id="customCheck1"
                            {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="customCheck1">
                            {{ __('Remember Me') }}
                        </label>


                        <label class="custom-control-label" for="customCheck1">Remember</label>
                    </div>
                    <div class="forgot-pass">
                        <a href="forgot-password.html">Forgot Password?</a>
                    </div>
                </div>
                <button class="btn btn-lg btn-gradient-danger btn-block btn-rounded mb-4 mt-5"
                    type="submit">Login</button>

            </div>


        </div>
    </form>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- END GLOBAL MANDATORY SCRIPTS -->
</body>

</html>
