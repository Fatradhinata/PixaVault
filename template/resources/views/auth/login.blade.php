<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <link rel="stylesheet" href="{{ asset('css/plugins/bootstrap-grid.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <title>PixaVault - Login</title>

</head>

<body>
    @include('templates.flasher')
    
    <div class="wrapper login-wrapper">
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="left-content d-flex">
                <h1>Welcome Back</h1>
                <p class="content-subheading">Welcome back to <b>PixaVault</b>! Discover stunning photography, upload your best shots, and be inspired by visual stories from around the world.</p>
                <div class="login-input d-flex">
                    <div class="input-group">
                        <input type="text" placeholder="Email" name="email" required>
                    </div>
                    <div class="input-group input-password">
                        <input type="password" placeholder="Password" name="password" required>
                        <img src="{{ Vite::asset('resources/img/icons/eye-close.svg') }}" alt="password close" width="28px">
                        <img src="{{ Vite::asset('resources/img/icons/eye-open.svg') }}" alt="password open" width="28px" style="display: none">
                    </div>
                </div>
                <button class="btn btn-login">Login</button>
                <div class="continue-text-bar">
                    <div></div>
                    <p>or continue with</p>
                    <div></div>
                </div>
                <a href="{{ route('google-auth') }}" class="btn-outline btn-google d-flex">
                    <img src="{{ Vite::asset('resources/img/icons/google.svg') }}" alt="google">
                    <p>Log In with Google</p>
                </a>
                <p class="register-text text-dark-gray">Don't have an account? <a href="{{ route('register') }}">Register now</a></p>
            </div>
        </form>
        <div class="right-content">
            <img src="{{ Vite::asset('resources/img/illustration/login.png') }}" alt="login illustration">
        </div>
    </div>

    <script src="{{ asset('js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('js/plugins/swiper.min.js') }}"></script>
    <script src="{{ asset('js/plugins/gsap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/imagesloaded.pkgd.js') }}"></script>
    <script src="{{ asset('js/plugins/isotope.min.js') }}"></script>
    <script src="{{ asset('js/plugins/smooth-scroll.js') }}"></script>
    <script src="{{ asset('js/plugins/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    
    <script src="{{ asset('js/login.js') }}"></script>


</body>

</html>
