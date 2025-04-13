<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="baseurl" content="{{ url('/') }}" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pixavault - @yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/plugins/bootstrap-grid.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/plugins/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/plugins/swiper.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/plugins/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <!-- Modal Content Styles -->
    <link rel="stylesheet" href="{{ asset('css/modal-detail-comment.css') }}">

    @yield('styles')

</head>

<body>

    @include('components.flasher')

    <!-- wrapper -->
    <div class="mil-wrapper">
        <div class="mil-progress-track">
            <div class="mil-progress"></div>
        </div>

        @yield('navbar')

        <!-- content -->
        <div id="content">

            @yield('content')

            <!-- footer -->
            <footer class="mil-relative">
                <img src="{{ asset('img/foto/jan-derungs-XMwAnYLHShE-unsplash.jpg') }}" class="mil-bg-img mil-parallax"
                    alt="image" style="object-position: top" data-value-1="-25%" data-value-2="23%" />
                <div class="mil-overlay"></div>
                <div class="container mil-p-60-70">
                    <div class="mil-background-grid"></div>
                    <div class="row align-items-start d-flex flex-column-reverse">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mil-footer-navigation mil-up mil-mb-30">
                                        <nav>
                                            <ul>
                                                <li><a href="{{ route('home') }}">Home</a></li>
                                                <li><a href="{{ route('explore') }}">Explore</a></li>
                                                <li><a href="{{ route('trending') }}">Trending</a></li>
                                                <li><a href="{{ route('leaderboard') }}">Leaderboard</a></li>
                                                <li><a href="{{ route('pricing') }}">Pricing</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <a href="home-1.html" class="col-lg-4 d-flex justify-content-left">
                                <img src="{{ asset('img/logo/logo_pixavault.png') }}" alt="Logo"
                                    style="height: 60px" />
                            </a>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="mil-footer-bottom">
                        <p class="mil-light-soft mil-mb-15">
                            © {{ date('Y') }}. All rights reserved.
                        </p>                      
                    </div>                    
                </div>
            </footer>
            <!-- footer end -->
        </div>
        <!-- content -->
    </div>
    <!-- wrapper end -->

    <script src="{{ asset('js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('js/plugins/swiper.min.js') }}"></script>
    <script src="{{ asset('js/plugins/gsap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/imagesloaded.pkgd.js') }}"></script>
    <script src="{{ asset('js/plugins/isotope.min.js') }}"></script>
    <script src="{{ asset('js/plugins/smooth-scroll.js') }}"></script>
    <script src="{{ asset('js/plugins/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('js/plugins/swal.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        window.isAuthenticated = @json(auth()->check());

        document.addEventListener("DOMContentLoaded", function() {
            const hamburger = document.querySelector(".nav-min-sm img");
            const navMenu = document.querySelector(".nav-max-sm");

            hamburger.addEventListener("click", function() {
                navMenu.classList.toggle("active");
            });

            document.addEventListener("click", function(event) {
                if (!hamburger.contains(event.target) && !navMenu.contains(event.target)) {
                    navMenu.classList.remove("active");
                }
            });
        });


        // Disable right click on images
        document.querySelectorAll("img").forEach((img) => {
            img.addEventListener("contextmenu", (event) => {
                event.preventDefault();
            });
        });
    </script>

    @yield('scripts')


</body>

</html>
