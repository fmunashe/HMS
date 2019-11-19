<!DOCTYPE html>
<html lang="en">


<!-- forgot-password24:03-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/assets/img/favi.ico')}}">
    <title>Agribank Loans Facility</title>
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/style.css')}}">
    <!--[if lt IE 9]>
    <script src="{{asset('frontend/assets/js/html5shiv.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/respond.min.js')}}"></script>
    <![endif]-->
</head>

<body>
<div class="main-wrapper account-wrapper">
    <div class="account-page">
        <div class="account-center">
            <div class="account-box">
                <form class="form-signin" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="account-logo">
                        <a href="/"><img src="{{asset('frontend/assets/img/logo1.png')}}" alt=""></a>
                    </div>
                    <div class="form-group">
                        <label>Enter Your Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-success account-btn" type="submit">{{ __('Send Password Reset Link') }}</button>
                    </div>
                    <div class="text-center register-link">
                        <a href="/">Back to Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('frontend/assets/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/popper.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/app.js')}}"></script>
</body>


<!-- forgot-password24:03-->
</html>
