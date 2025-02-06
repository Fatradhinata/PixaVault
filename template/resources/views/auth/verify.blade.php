<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

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
            <div class="left-content d-flex email-verify">
                <h1>Thank You for Signing Up!</h1>
                <p>
                    Before you get started, please verify your email address by clicking the 
                    link we just sent to your email. If you didn't receive the email, we'll be happy to send another one.
                </p>
                <div class="d-flex justify-content-start" style="width: 100%">
                    <a href="{{ url('/send-verification-email') }}">Resend Verification Email</a>
                    <a class="logout" href="{{ route('logout') }}">Log Out</a>
                </div>
            </div>
        </form>
        <div class="right-content">
            <img src="{{ asset('img/illustration/verify.png') }}" alt="login illustration">
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
