@extends('templates.user')

@section('title', 'Home')

@section('navbar')
    @include('components.navbar-home')
@endsection

@section('content')
    <!-- banner -->
    <section class="mil-banner">
        <img src="{{ Vite::asset('resources/img/foto/jan-derungs-XMwAnYLHShE-unsplash.jpg') }}" class="mil-bg-img mil-scale" data-value-1=".4" data-value-2="1.4" alt="image" />

        <div class="mil-overlay"></div>

        <div class="container">
            <div class="mil-banner-content">
                <div class="row align-items-end">
                    <div class="col-xl-7">
                        <div class="mil-mb-90">
                            <h1 class="mil-upper mil-light mil-mb-60">
                                Unlocking<br /><span class="mil-accent">the Future</span><br />of Digital Assets
                            </h1>
                            <div class="mil-sidebar-search mil-up mil-mb-30" id="search-input">
                                <input type="text" placeholder="Search images..." />
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

    <!-- Trending Image -->
    <section>
        <div class="container mil-p-0-60">
            <div class="col-12">
                <div class="mil-center mil-mb-90 mt-5">
                    <span class="mil-suptitle mil-upper mil-up mil-mb-30">Insights</span>
                    <h2 class="mil-upper mil-up mil-mb-30">Trending Images</h2>
                    <a href="blog.html" class="mil-link mil-upper mil-up">See All
                        <span class="mil-arrow"><img src="{{ Vite::asset('resources/img/icons/1.svg') }}" alt="arrow" /></span></a>
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

                    <div class="content-item mil-up position-relative" id="photo-trigger">
                        <div class="mil-buttons">
                            <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
                            <button class="mil-download-btn"><i class="fas fa-download"></i></button>
                        </div>
                        <img src="{{ Vite::asset('resources/img/foto/2.jpg') }}" class="w-100 shadow-1-strong rounded" alt="Mountains in the Clouds" />
                        <div class="image-profile">
                            <img src="{{ Vite::asset('resources/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
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
                        <img src="{{ Vite::asset('resources/img/foto/6.jpg') }}" alt="cover" />
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
                        <img src="{{ Vite::asset('resources/img/foto/1.jpg') }}" alt="cover" />
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
                        <img src="{{ Vite::asset('resources/img/foto/2.jpg') }}" alt="cover" />
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
                        <img src="{{ Vite::asset('resources/img/foto/6.jpg') }}" alt="cover" />
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
                            <span class="mil-arrow"><img src="{{ Vite::asset('resources/img/icons/1.svg') }}" alt="arrow" /></span></a>
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
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp" class="w-100 shadow-1-strong rounded" alt="Boat on Calm Water" />
                                <div class="image-profile">
                                    <img src="{{ Vite::asset('resources/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
                                    <p class="mil-username">PixaVault</p>
                                </div>
                            </div>

                            <div class="content-item mil-up position-relative">
                                <div class="mil-buttons">
                                    <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
                                    <button class="mil-download-btn"><i class="fas fa-download"></i></button>
                                </div>
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Vertical/mountain1.webp" class="w-100 shadow-1-strong rounded" alt="Wintry Mountain Landscape" />
                                <div class="image-profile">
                                    <img src="{{ Vite::asset('resources/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
                                    <p class="mil-username">PixaVault</p>
                                </div>
                            </div>

                            <div class="content-item mil-up position-relative">
                                <div class="mil-buttons">
                                    <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
                                    <button class="mil-download-btn"><i class="fas fa-download"></i></button>
                                </div>
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Thumbnails/Vertical/1.webp" class="w-100 shadow-1-strong rounded" alt="Wintry Mountain Landscape" />
                                <div class="image-profile">
                                    <img src="{{ Vite::asset('resources/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
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
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Vertical/mountain2.webp" class="w-100 shadow-1-strong rounded" alt="Mountains in the Clouds" />
                                <div class="image-profile">
                                    <img src="{{ Vite::asset('resources/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
                                    <p class="mil-username">PixaVault</p>
                                </div>
                            </div>

                            <div class="content-item mil-up position-relative">
                                <div class="mil-buttons">
                                    <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
                                    <button class="mil-download-btn"><i class="fas fa-download"></i></button>
                                </div>
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp" class="w-100 shadow-1-strong rounded" alt="Boat on Calm Water" />
                                <div class="image-profile">
                                    <img src="{{ Vite::asset('resources/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
                                    <p class="mil-username">PixaVault</p>
                                </div>
                            </div>

                            <div class="content-item mil-up position-relative">
                                <div class="mil-buttons">
                                    <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
                                    <button class="mil-download-btn"><i class="fas fa-download"></i></button>
                                </div>
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Thumbnails/Square/1.webp" class="w-100 shadow-1-strong rounded" alt="Boat on Calm Water" />
                                <div class="image-profile">
                                    <img src="{{ Vite::asset('resources/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
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
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(18).webp" class="w-100 shadow-1-strong rounded" alt="Waves at Sea" />
                                <div class="image-profile">
                                    <img src="{{ Vite::asset('resources/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
                                    <p class="mil-username">PixaVault</p>
                                </div>
                            </div>

                            <div class="content-item mil-up position-relative">
                                <div class="mil-buttons">
                                    <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
                                    <button class="mil-download-btn"><i class="fas fa-download"></i></button>
                                </div>
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Thumbnails/Slides/1.webp" class="w-100 shadow-1-strong rounded" alt="Waves at Sea" />
                                <div class="image-profile">
                                    <img src="{{ Vite::asset('resources/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
                                    <p class="mil-username">PixaVault</p>
                                </div>
                            </div>

                            <div class="content-item mil-up position-relative">
                                <div class="mil-buttons">
                                    <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
                                    <button class="mil-download-btn"><i class="fas fa-download"></i></button>
                                </div>
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Vertical/mountain3.webp" class="w-100 shadow-1-strong rounded" alt="Yosemite National Park" />
                                <div class="image-profile">
                                    <img src="{{ Vite::asset('resources/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
                                    <p class="mil-username">PixaVault</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('components.modal-content')

@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // JS Random Image //
            const randomImageElements =
                document.querySelectorAll(".mil-randomimage");

            randomImageElements.forEach((imgElement) => {
                const randomImageUrl = `https://picsum.photos/600/400?random=${Math.floor(Math.random()*1000)}`;
                imgElement.src = randomImageUrl;
            });
        });
    </script>
@endsection