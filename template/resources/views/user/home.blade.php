@extends('templates.user')

@section('styles')
    <style>
        .mil-top-panel {
            position: fixed;
            width: 100%;
            background: transparent;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .mil-logo img {
            max-width: 120px;
        }

        .mil-navigation nav {
            display: flex;
            gap: 45px;
        }

        .mil-navigation nav ul li {
            position: relative;
        }

        .mil-navigation nav ul li a {
            text-decoration: none;
            color: #ffffff;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 20px;
            transition: color 0.3s, background 0.3s;
            position: relative;
        }

        .mil-navigation nav ul li a:hover,
        .mil-navigation nav ul li a.active {
            color: #bcff00;
            /* Warna teks hover dan aktif */
        }

        .mil-navigation nav ul li a::after {
            content: "";
            position: absolute;
            bottom: -4px;
            left: 50%;
            right: 50%;
            height: 2px;
            background-color: transparent;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .mil-navigation nav ul li a:hover::after {
            left: 0;
            right: 0;
        }

        .mil-navigation nav ul li ul {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background: #282c34;
            border-radius: 10px;
            padding: 10px;
            list-style: none;
            z-index: 2000;
        }

        .mil-navigation nav ul li:hover ul {
            display: block;
        }

        .mil-navigation nav ul li ul li a {
            padding: 8px 12px;
            color: #ffffff;
            display: block;
        }

        .mil-top-panel-right {
            display: flex;
            align-items: center;
            text-decoration: none;
            gap: 30px;

            &>* {
                cursor: pointer;
            }

            .mil-top-panel-user {
                position: relative;
            }
        }

        .mil-top-panel-buttons {

            background: rgb(188, 255, 0);
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: bold;
            transition: background 0.3s;

            &:hover {
                background-color: #CFFF00;
            }
        }

        .mil-top-panel-link {
            color: white;
            font-size: 18px;
            font-weight: 700;
            text-transform: uppercase;

            &:hover {
                color: rgb(188, 255, 0);
            }
        }

        .nav-horizontal-dot-wrapper {
            position: relative;
        }

        .mil-nav-dropdown {
            position: absolute;
            display: none;
            left: -120%;
            transform: translateY(15%);
            border: 1px solid #D9D9D9;
            border-radius: 8px;
            background-color: white;

            hr {
                margin: 0px -11px;
                border: none;
                border-top: 1px solid #D9D9D9;
                width: calc(100% + 22px);
            }

            .mil-nav-dropdown-logout {
                color: rgba(252, 120, 120, 0.64);

                &:hover {
                    color: #FC7878;
                }
            }

            div {
                display: flex;
                flex-direction: column;
                padding: 11px;
                gap: 10px;

                button {
                    text-align: left;
                    outline: none;
                    border: none;
                    min-width: 145px;
                    padding: 10px;
                    border-radius: 8px;
                    background-color: transparent;
                    cursor: pointer;
                    color: #7F7F7F;

                    &:hover {
                        background-color: #F7F7F7;
                        color: black;
                    }
                }
            }
        }

        .mil-nav-dropdown-user {
            transform: translateY(6%);
        }

        .nav-horizontal-dot {
            padding: 10px;
            display: flex;
            transition: background-color 1s, border-radius 1.2s;

            &:hover {
                background-color: #000;
                border-radius: 100px;
            }
        }

        .mil-top-panel-buttons a:hover {
            filter: brightness(110%);
        }
    </style>
@endsection

@section('navbar')
    @include('templates.home-navbar')
@endsection

@section('content')
    <div id="content">
        <!-- banner -->
        <section class="mil-banner">
            <img src="{{ Vite::asset('resources/img/foto/jan-derungs-XMwAnYLHShE-unsplash.jpg') }}"
                class="mil-bg-img mil-scale" data-value-1=".4" data-value-2="1.4" alt="image" />
            <div class="mil-overlay"></div>
            <div class="container">
                <div class="mil-banner-content">
                    <div class="row align-items-end">
                        <div class="col-xl-7">
                            <div class="mil-mb-90">
                                <h1 class="mil-upper mil-light mil-mb-60">
                                    Unlocking<br /><span class="mil-accent">the Future</span><br />of Digital Assets
                                </h1>
                                <div class="mil-sidebar-search mil-up mil-mb-30">
                                    <input type="text" placeholder="Search in blog ..." />
                                    <button>
                                        <img src="{{ Vite::asset('resources/img/icons/13.svg') }}" alt="search" />
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5">
                            <div class="row mil-mb-60">
                                <div class="col-6">
                                    <div class="mil-counter-frame mil-light mil-mb-30">
                                        <h4 class="mil-accent mil-thin mil-mb-10">
                                            <span class="mil-counter" data-number="346">0</span>+
                                        </h4>
                                        <p class="mil-light">Succeeded <br />Projects</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mil-counter-frame mil-light mil-mb-30">
                                        <h4 class="mil-accent mil-thin mil-mb-10">
                                            <span class="mil-counter" data-number="9">0</span>k+
                                        </h4>
                                        <p class="mil-light">Working <br />Hours</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mil-counter-frame mil-light mil-mb-30">
                                        <h4 class="mil-accent mil-thin mil-mb-10">
                                            <span class="mil-counter" data-number="10">0</span>+
                                        </h4>
                                        <p class="mil-light">Years <br />Experience</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mil-counter-frame mil-light mil-mb-30">
                                        <h4 class="mil-accent mil-thin mil-mb-10">
                                            <span class="mil-counter" data-number="99">0</span>+
                                        </h4>
                                        <p class="mil-light">Billion <br />Invested</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- banner end -->

        <!-- portfolio -->
        <section>
            <div class="container mil-p-0-60">
                <div class="col-12">
                    <div class="mil-center mil-mb-90 mt-5">
                        <span class="mil-suptitle mil-upper mil-up mil-mb-30">Insights</span>
                        <h2 class="mil-upper mil-up mil-mb-30">Trending Images</h2>
                        <a href="blog.html" class="mil-link mil-upper mil-up">See All
                            <span class="mil-arrow"><img src="img/icons/1.svg" alt="arrow" /></span></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="content-item mil-up position-relative" id="photo-trigger">
                            <div class="mil-buttons">
                                <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
                                <button class="mil-download-btn"><i class="fas fa-download"></i></button>
                            </div>
                            <img src="{{ Vite::asset('resources/img/foto/1.jpg') }}" class="w-100 shadow-1-strong rounded" alt="Mountains in the Clouds" />
                            <div class="image-profile">
                                <img src="{{ Vite::asset('resources/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
                                <p class="mil-username">PixaVault</p>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal" id="photo-modal">
                            <div class="modal-content">
                                <img class="close" id="close-modal" src="{{ Vite::asset('resources/img/icons/cancel.svg') }}" alt="close">
                                <hr class="line">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <div class="user-info">
                                        <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="User Avatar" />
                                        <div>
                                            <p class="username">storyset</p>
                                            <p class="follow">View Profile</p>
                                        </div>
                                    </div>
                                    <div class="actions">
                                        <button class="like-btn">
                                            <i class="far fa-heart"></i>
                                        </button>
                                        <img class="option-icon" src="{{ Vite::asset('resources/img/icons/horiz-dots-variant-2.svg') }}" alt="">
                                        <button class="download-btn">
                                            <div>
                                                <img src="{{ Vite::asset('resources/img/icons/download.svg') }}" alt="">
                                                <p>Download</p>
                                            </div>
                                            <div class="right-part">
                                                <hr>
                                                <img width="15px" height="15px" src="{{ Vite::asset('resources/img/icons/arrow-down.svg') }}"
                                                    alt="Arrow Down">
                                            </div>
                                        </button>
                                    </div>
                                </div>
                                <img src="{{ Vite::asset('resources/img/foto/1.jpg') }}" class="image-content" alt="Photo Detail" />
                                <div class="d-flex my-4">
                                    <!-- Bagian Views -->
                                    <div class="mil-up">
                                        <p style="margin: 0; font-size: 14px; color: #6c757d">
                                            Views
                                        </p>
                                        <p style="margin: 0; font-size: 18px; font-weight: bold">
                                            1,234
                                        </p>
                                    </div>

                                    <!-- Bagian Download -->
                                    <div class="ms-5 mil-up">
                                        <p style="margin: 0; font-size: 14px; color: #6c757d">
                                            Downloads
                                        </p>
                                        <p style="margin: 0; font-size: 18px; font-weight: bold">
                                            567
                                        </p>
                                    </div>

                                    <button class="share-btn">
                                        <img src="{{ Vite::asset('resources/img/icons/share.svg') }}" alt="share">
                                        <p>Share</p>
                                    </button>
                                </div>
                                <div class="details">
                                    <div class="mb-1">
                                        <h4 class="mil-up">Background Furniture</h4>
                                    </div>
                                </div>
                                <!-- deskripsi -->
                                <p class="mil-up mil-mb-30 content-description">
                                    A vibrant orange lovebird perched gracefully, showcasing its bright plumage
                                    and playful charm. Its striking colors and curious gaze make it a captivating sight
                                </p>

                                <div class="d-flex align-items-center my-1 mil-up created-date">
                                    <!-- Icon publish -->
                                    <i class="fas fa-upload" style="margin-right: 10px; color: #6c757d"></i>
                                    <!-- Teks -->
                                    <p class="mb-0" style="color: #6c757d">10-01-2025</p>
                                </div>
                                <div class="d-flex align-items-center my-1 mil-up publish-cam">
                                    <!-- Icon publish -->
                                    <img src="{{ Vite::asset('resources/img/icons/camera-variant-1.svg') }}" width="28px" height="28px" alt="cam-1">
                                    <!-- Teks -->
                                    <p class="mb-0" style="color: #6c757d">FUJIFILM, X100VI</p>
                                </div>
                                <div class="tag-row">
                                    <button>Natures</button>
                                    <button>Bromo</button>
                                    <button>Indonesia</button>
                                    <button>Mountain</button>
                                    <button>Outdoor</button>
                                    <button>East java</button>
                                </div>
                                <section class="more-images">
                                    <div class="mt-5">
                                        <div class="header">
                                            <h4>More Like This</h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-3">
                                                <a href="project.html"
                                                    class="mil-portfolio-item mil-square-item mil-up mil-mb-30">
                                                    <img src="{{ Vite::asset('resources/img/foto/1.jpg') }} alt="cover" />
                                                    <div class="mil-project-descr">
                                                        <h4 class="mil-upper mil-mb-20">
                                                            Modern architecture
                                                        </h4>
                                                        <div class="mil-divider-sm mil-mb-20"></div>
                                                        <p>
                                                            Consectetur adipiscing elit, sed do eiusmod
                                                            tempor incididunt ut labore aliqua.
                                                        </p>
                                                    </div>
                                                </a>

                                                <a href="project.html"
                                                    class="mil-portfolio-item mil-square-item mil-up mil-mb-30">
                                                    <img src="{{ Vite::asset('resources/img/foto/2.jpg') }}" alt="cover" />
                                                    <div class="mil-project-descr">
                                                        <h4 class="mil-upper mil-mb-20">Ice castle</h4>
                                                        <div class="mil-divider-sm mil-mb-20"></div>
                                                        <p>
                                                            Consectetur adipiscing elit, sed do eiusmod
                                                            tempor incididunt ut labore aliqua.
                                                        </p>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-6 col-lg-3">
                                                <a href="project.html"
                                                    class="mil-portfolio-item mil-long-item mil-up mil-mb-30">
                                                    <img src="{{ Vite::asset('resources/img/foto/3.jpg') }}" alt="cover" />
                                                    <div class="mil-project-descr">
                                                        <h4 class="mil-upper mil-mb-20">Cubism</h4>
                                                        <div class="mil-divider-sm mil-mb-20"></div>
                                                        <p>
                                                            Consectetur adipiscing elit, sed do eiusmod
                                                            tempor incididunt ut labore aliqua.
                                                        </p>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-6 col-lg-3">
                                                <a href="project.html"
                                                    class="mil-portfolio-item mil-square-item mil-up mil-mb-30">
                                                    <img src="{{ Vite::asset('resources/img/foto/4.jpg') }}" alt="cover" />
                                                    <div class="mil-project-descr">
                                                        <h4 class="mil-upper mil-mb-20">
                                                            Horizontal elevator
                                                        </h4>
                                                        <div class="mil-divider-sm mil-mb-20"></div>
                                                        <p>
                                                            Consectetur adipiscing elit, sed do eiusmod
                                                            tempor incididunt ut labore aliqua.
                                                        </p>
                                                    </div>
                                                </a>

                                                <a href="project.html"
                                                    class="mil-portfolio-item mil-square-item mil-up mil-mb-30">
                                                    <img src="{{ Vite::asset('resources/img/foto/5.jpg') }}" alt="cover" />
                                                    <div class="mil-project-descr">
                                                        <h4 class="mil-upper mil-mb-20">Home Decor</h4>
                                                        <div class="mil-divider-sm mil-mb-20"></div>
                                                        <p>
                                                            Consectetur adipiscing elit, sed do eiusmod
                                                            tempor incididunt ut labore aliqua.
                                                        </p>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-6 col-lg-3">
                                                <a href="project.html"
                                                    class="mil-portfolio-item mil-long-item mil-up mil-mb-30">
                                                    <img src="{{ Vite::asset('resources/img/foto/6.jpg') }}" alt="cover" />
                                                    <div class="mil-project-descr">
                                                        <h4 class="mil-upper mil-mb-20">
                                                            Modern architecture
                                                        </h4>
                                                        <div class="mil-divider-sm mil-mb-20"></div>
                                                        <p>
                                                            Consectetur adipiscing elit, sed do eiusmod
                                                            tempor incididunt ut labore aliqua.
                                                        </p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>

                        <div class="content-item mil-up position-relative" id="photo-trigger">
                            <div class="mil-buttons">
                                <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
                                <button class="mil-download-btn"><i class="fas fa-download"></i></button>
                            </div>
                            <img src="{{ Vite::asset('resources/img/foto/2.jpg') }}"  class="w-100 shadow-1-strong rounded" alt="Mountains in the Clouds" />
                            <div class="image-profile">
                                <img src="img/icons/user-elipse.svg" alt="Profile Picture" class="mil-profile-img" />
                                <p class="mil-username">PixaVault</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a href="project.html" class="mil-portfolio-item mil-long-item mil-up mil-mb-30">
                            <img src="{{ Vite::asset('resources/img/foto/3.jpg') }}" alt="cover" />
                            <div class="mil-project-descr">
                                <h4 class="mil-upper mil-mb-20">Cubism</h4>
                                <div class="mil-divider-sm mil-mb-20"></div>
                                <p>
                                    Consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore aliqua.
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a href="project.html" class="mil-portfolio-item mil-square-item mil-up mil-mb-30">
                            <img src="{{ Vite::asset('resources/img/foto/4.jpg') }}" alt="cover" />
                            <div class="mil-project-descr">
                                <h4 class="mil-upper mil-mb-20">Horizontal elevator</h4>
                                <div class="mil-divider-sm mil-mb-20"></div>
                                <p>
                                    Consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore aliqua.
                                </p>
                            </div>
                        </a>

                        <a href="project.html" class="mil-portfolio-item mil-square-item mil-up mil-mb-30">
                            <img src="{{ Vite::asset('resources/img/foto/5.jpg') }}" alt="cover" />
                            <div class="mil-project-descr">
                                <h4 class="mil-upper mil-mb-20">Home Decor</h4>
                                <div class="mil-divider-sm mil-mb-20"></div>
                                <p>
                                    Consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore aliqua.
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a href="project.html" class="mil-portfolio-item mil-long-item mil-up mil-mb-30">
                            <img src="img/foto/6.jpg" alt="cover" />
                            <div class="mil-project-descr">
                                <h4 class="mil-upper mil-mb-20">Modern architecture</h4>
                                <div class="mil-divider-sm mil-mb-20"></div>
                                <p>
                                    Consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore aliqua.
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a href="project.html" class="mil-portfolio-item mil-square-item mil-up mil-mb-30">
                            <img src="img/foto/1.jpg" alt="cover" />
                            <div class="mil-project-descr">
                                <h4 class="mil-upper mil-mb-20">Modern architecture</h4>
                                <div class="mil-divider-sm mil-mb-20"></div>
                                <p>
                                    Consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore aliqua.
                                </p>
                            </div>
                        </a>

                        <a href="project.html" class="mil-portfolio-item mil-square-item mil-up mil-mb-30">
                            <img src="img/foto/2.jpg" alt="cover" />
                            <div class="mil-project-descr">
                                <h4 class="mil-upper mil-mb-20">Ice castle</h4>
                                <div class="mil-divider-sm mil-mb-20"></div>
                                <p>
                                    Consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore aliqua.
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a href="project.html" class="mil-portfolio-item mil-long-item mil-up mil-mb-30">
                            <img src="img/foto/3.jpg" alt="cover" />
                            <div class="mil-project-descr">
                                <h4 class="mil-upper mil-mb-20">Cubism</h4>
                                <div class="mil-divider-sm mil-mb-20"></div>
                                <p>
                                    Consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore aliqua.
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a href="project.html" class="mil-portfolio-item mil-square-item mil-up mil-mb-30">
                            <img src="img/foto/4.jpg" alt="cover" />
                            <div class="mil-project-descr">
                                <h4 class="mil-upper mil-mb-20">Horizontal elevator</h4>
                                <div class="mil-divider-sm mil-mb-20"></div>
                                <p>
                                    Consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore aliqua.
                                </p>
                            </div>
                        </a>

                        <a href="project.html" class="mil-portfolio-item mil-square-item mil-up mil-mb-30">
                            <img src="img/foto/5.jpg" alt="cover" />
                            <div class="mil-project-descr">
                                <h4 class="mil-upper mil-mb-20">Home Decor</h4>
                                <div class="mil-divider-sm mil-mb-20"></div>
                                <p>
                                    Consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore aliqua.
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a href="project.html" class="mil-portfolio-item mil-long-item mil-up mil-mb-30">
                            <img src="img/foto/6.jpg" alt="cover" />
                            <div class="mil-project-descr">
                                <h4 class="mil-upper mil-mb-20">Modern architecture</h4>
                                <div class="mil-divider-sm mil-mb-20"></div>
                                <p>
                                    Consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore aliqua.
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- portfolio end -->

        <!-- how we work end -->
        <!-- Explore Image -->
        <section>
            <div class="container mil-p-120-120">
                <div class="mil-background-grid mil-softened"></div>

                <div class="row">
                    <div class="col-12 mb-15">
                        <div class="mil-center mil-mb-90">
                            <span class="mil-suptitle mil-upper mil-up mil-mb-30">EXPLORE</span>
                            <h2 class="mil-upper mil-up">FRAME BY FRAME DISCOVERY</h2>
                            <p class="mil-mb-30">
                                Dive into a world of creativity with handpicked collections tailored to your interests.
                            </p>
                            <a href="blog.html" class="mil-link mil-upper mil-up">See All
                                <span class="mil-arrow"><img src="img/icons/1.svg" alt="arrow" /></span></a>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                                <div class="content-item mil-up position-relative">
                                    <div class="mil-buttons">
                                        <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
                                        <button class="mil-download-btn"><i class="fas fa-download"></i></button>
                                    </div>
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp"
                                        class="w-100 shadow-1-strong rounded" alt="Boat on Calm Water" />
                                    <div class="image-profile">
                                        <img src="img/icons/user-elipse.svg" alt="Profile Picture"
                                            class="mil-profile-img" />
                                        <p class="mil-username">PixaVault</p>
                                    </div>
                                </div>

                                <div class="content-item mil-up position-relative">
                                    <div class="mil-buttons">
                                        <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
                                        <button class="mil-download-btn"><i class="fas fa-download"></i></button>
                                    </div>
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Vertical/mountain1.webp"
                                        class="w-100 shadow-1-strong rounded" alt="Wintry Mountain Landscape" />
                                    <div class="image-profile">
                                        <img src="img/icons/user-elipse.svg" alt="Profile Picture"
                                            class="mil-profile-img" />
                                        <p class="mil-username">PixaVault</p>
                                    </div>
                                </div>

                                <div class="content-item mil-up position-relative">
                                    <div class="mil-buttons">
                                        <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
                                        <button class="mil-download-btn"><i class="fas fa-download"></i></button>
                                    </div>
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Thumbnails/Vertical/1.webp"
                                        class="w-100 shadow-1-strong rounded" alt="Wintry Mountain Landscape" />
                                    <div class="image-profile">
                                        <img src="img/icons/user-elipse.svg" alt="Profile Picture"
                                            class="mil-profile-img" />
                                        <p class="mil-username">PixaVault</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 mb-4 mb-lg-0">
                                <div class="content-item mil-up position-relative">
                                    <div class="mil-buttons">
                                        <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
                                        <button class="mil-download-btn"><i class="fas fa-download"></i></button>
                                    </div>
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Vertical/mountain2.webp"
                                        class="w-100 shadow-1-strong rounded" alt="Mountains in the Clouds" />
                                    <div class="image-profile">
                                        <img src="img/icons/user-elipse.svg" alt="Profile Picture"
                                            class="mil-profile-img" />
                                        <p class="mil-username">PixaVault</p>
                                    </div>
                                </div>

                                <div class="content-item mil-up position-relative">
                                    <div class="mil-buttons">
                                        <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
                                        <button class="mil-download-btn"><i class="fas fa-download"></i></button>
                                    </div>
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp"
                                        class="w-100 shadow-1-strong rounded" alt="Boat on Calm Water" />
                                    <div class="image-profile">
                                        <img src="img/icons/user-elipse.svg" alt="Profile Picture"
                                            class="mil-profile-img" />
                                        <p class="mil-username">PixaVault</p>
                                    </div>
                                </div>

                                <div class="content-item mil-up position-relative">
                                    <div class="mil-buttons">
                                        <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
                                        <button class="mil-download-btn"><i class="fas fa-download"></i></button>
                                    </div>
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Thumbnails/Square/1.webp"
                                        class="w-100 shadow-1-strong rounded" alt="Boat on Calm Water" />
                                    <div class="image-profile">
                                        <img src="img/icons/user-elipse.svg" alt="Profile Picture"
                                            class="mil-profile-img" />
                                        <p class="mil-username">PixaVault</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 mb-4 mb-lg-0">
                                <div class="content-item mil-up position-relative">
                                    <div class="mil-buttons">
                                        <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
                                        <button class="mil-download-btn"><i class="fas fa-download"></i></button>
                                    </div>
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(18).webp"
                                        class="w-100 shadow-1-strong rounded" alt="Waves at Sea" />
                                    <div class="image-profile">
                                        <img src="img/icons/user-elipse.svg" alt="Profile Picture"
                                            class="mil-profile-img" />
                                        <p class="mil-username">PixaVault</p>
                                    </div>
                                </div>

                                <div class="content-item mil-up position-relative">
                                    <div class="mil-buttons">
                                        <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
                                        <button class="mil-download-btn"><i class="fas fa-download"></i></button>
                                    </div>
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Thumbnails/Slides/1.webp"
                                        class="w-100 shadow-1-strong rounded" alt="Waves at Sea" />
                                    <div class="image-profile">
                                        <img src="img/icons/user-elipse.svg" alt="Profile Picture"
                                            class="mil-profile-img" />
                                        <p class="mil-username">PixaVault</p>
                                    </div>
                                </div>

                                <div class="content-item mil-up position-relative">
                                    <div class="mil-buttons">
                                        <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
                                        <button class="mil-download-btn"><i class="fas fa-download"></i></button>
                                    </div>
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Vertical/mountain3.webp"
                                        class="w-100 shadow-1-strong rounded" alt="Yosemite National Park" />
                                    <div class="image-profile">
                                        <img src="img/icons/user-elipse.svg" alt="Profile Picture"
                                            class="mil-profile-img" />
                                        <p class="mil-username">PixaVault</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        var user = @json(Auth::user());
        console.log(user); // Cek semua data user
        console.log(user.role); // Kalau ada role
    </script>
@endsection
@vite(['resources/js/home.js'])