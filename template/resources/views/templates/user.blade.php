<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <title>PixaVault - @yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/plugins/bootstrap-grid.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/plugins/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/plugins/swiper.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/plugins/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

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
                <img src="{{ Vite::asset('resources/img/foto/4.jpg') }}" class="mil-bg-img mil-parallax" alt="image" style="object-position: top" data-value-1="-25%" data-value-2="23%" />
                <div class="mil-overlay"></div>
                <div class="container mil-p-120-90">
                    <div class="mil-background-grid"></div>
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mil-footer-navigation mil-up mil-mb-90">
                                        <nav>
                                            <ul>
                                                <li>
                                                    <a href="about.html">About</a>
                                                </li>
                                                <li>
                                                    <a href="services.html">Services</a>
                                                </li>
                                                <li>
                                                    <a href="portfolio.html">Projects</a>
                                                </li>
                                                <li>
                                                    <a href="blog.html">Blog</a>
                                                </li>
                                                <li>
                                                    <a href="contact.html">Contact</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-3">
                                    <span class="mil-suptitle mil-light mil-upper mil-up mil-mb-30">Wills Point</span>
                                    <p class="mil-text-sm mil-up mil-light-soft mil-mb-30">
                                        8619 S Wolcott Avenue <br />Floor 202 <br />Chicago, IL
                                        60620 <br />(773) 238 - 7162
                                    </p>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-3">
                                    <span class="mil-suptitle mil-light mil-upper mil-up mil-mb-30">Chicago</span>
                                    <p class="mil-text-sm mil-up mil-light-soft mil-mb-30">
                                        10233 Gaillard Lake Est <br />Suite 420 <br />Houston, TX
                                        75169 <br />(903) 560 - 9830
                                    </p>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-3">
                                    <span class="mil-suptitle mil-light mil-upper mil-up mil-mb-30">Harriman</span>
                                    <p class="mil-text-sm mil-up mil-light-soft mil-mb-30">
                                        5 Harriman Woods Dr <br />Suite 702 <br />New York, NY
                                        10926 <br />(570) 253 - 2853
                                    </p>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-3">
                                    <span class="mil-suptitle mil-light mil-upper mil-up mil-mb-30">Largo</span>
                                    <p class="mil-text-sm mil-up mil-light-soft mil-mb-30">
                                        1071 Donegan Rd <br />Suite 1300 <br />Florida, FL 33771
                                        <br />(727) 223 - 5371
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <a href="home-1.html" class="mil-footer-logo mil-up mil-mb-30">
                                <img src="{{ Vite::asset('resources/img/logo/logo_pixavault.png') }}" alt="Logo" style="width: 130px" />
                            </a>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="mil-footer-bottom">
                        <p class="mil-light-soft mil-mb-15">
                            © 2025. All rights reserved.
                        </p>
                        <ul class="mil-light-soft mil-mb-15">
                            <li><a href="#.">Facebook</a></li>
                            <li><a href="#.">Twitter</a></li>
                            <li><a href="#.">Instagram</a></li>
                            <li><a href="#.">Youtube</a></li>
                        </ul>
                        <ul class="mil-light-soft mil-mb-15">
                            <li><a href="#.">Our App</a></li>
                            <li><a href="#.">Sitemap</a></li>
                        </ul>
                    </div>
                </div>
            </footer>
            <!-- footer end -->
        </div>
        <!-- content -->
    </div>
    <!-- wrapper end -->

    <script src="{{  asset('js/plugins/jquery.min.js') }}"></script>
    <script src="{{  asset('js/plugins/swiper.min.js') }}"></script>
    <script src="{{  asset('js/plugins/gsap.min.js') }}"></script>
    <script src="{{  asset('js/plugins/imagesloaded.pkgd.js') }}"></script>
    <script src="{{  asset('js/plugins/isotope.min.js') }}"></script>
    <script src="{{  asset('js/plugins/smooth-scroll.js') }}"></script>
    <script src="{{  asset('js/plugins/ScrollTrigger.min.js') }}"></script>
    <script src="{{  asset('js/plugins/magnific-popup.js') }}"></script>
    <script src="{{  asset('js/main.js') }}"></script>

    @yield('scripts')
</body>

</html>