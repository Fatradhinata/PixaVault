@extends('templates.user')

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div id="content">
        <section class="mil-banner mil-banner-sm">
            <img src="img/foto/1.jpg" class="mil-bg-img mil-scale" data-value-1=".4" data-value-2="1.4" alt="image" />
            <div class="mil-overlay"></div>
            <div class="container">
                <div class="mil-background-grid mil-top-space"></div>

                <div class="mil-banner-content mil-center">
                    <!-- Lightbox untuk gambar -->
                    <a href="img/foto/3.jpg" data-lightbox="image-1" data-title="Gambar di-upload">
                        <img src="img/foto/3.jpg" style="max-width: 42%; cursor: zoom-in" alt="Zoomable Image" />
                    </a>
                </div>
            </div>
        </section>
        <!-- banner end -->

        <!-- description -->
        <section>
            <div class="container">
                <div class="mil-background-grid mil-softened"></div>
                <div class="row justify-content-between">
                    <div class="col-lg-6">
                        <div class="d-flex my-3">
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
                        </div>

                        <div class="mb-3">
                            <h4 class="mil-up">Background Furniture</h4>
                        </div>
                        <!-- deskripsi -->
                        <p class="mil-up mil-mb-30">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                            Velit voluptates provident est numquam earum et perspiciatis
                            veniam libero quidem, doloremque quasi laborum dolore minus
                            enim animi nostrum sequi fugiat sunt?
                        </p>
                        <!-- Tambahkan div untuk gambar profil, username, dan nama -->
                        <div class="d-flex align-items-center mb-3 mil-up">
                            <!-- Gambar profil -->
                            <img src="img/faces/user.jpg" alt="Profile Picture" class="rounded-circle"
                                style="
                  width: 50px;
                  height: 50px;
                  object-fit: cover;
                  margin-right: 15px;
                  border-radius: 100%;
                " />
                            <!-- Username dan nama -->
                            <div>
                                <p class="mb-0" style="font-weight: bold">Gracy Even</p>
                                <p class="mb-0 text-muted">gracyindy_</p>
                            </div>
                        </div>
                        <!-- Icon publish dan teks -->
                        <div class="d-flex align-items-center my-1 mil-up">
                            <!-- Icon publish -->
                            <i class="fas fa-upload" style="font-size: 14px; margin-right: 10px; color: #6c757d"></i>
                            <!-- Teks -->
                            <p class="mb-0" style="color: #6c757d; font-size: 14px">
                                10-01-2025
                            </p>
                        </div>
                        <div class="d-flex align-items-center my-1 mil-up">
                            <!-- Icon publish -->
                            <i class="fas fa-camera" style="font-size: 14px; margin-right: 10px; color: #6c757d"></i>
                            <!-- Teks -->
                            <p class="mb-0" style="color: #6c757d; font-size: 14px">
                                Iphone XR
                            </p>
                        </div>
                        <div class="d-flex align-items-center my-1 mil-up">
                            <!-- Icon publish -->
                            <i class="fas fa-certificate" style="font-size: 14px; margin-right: 10px; color: #6c757d"></i>
                            <!-- Teks -->
                            <p class="mb-0" style="color: #6c757d; font-size: 14px">
                                Free to use
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="d-flex align-items-center gap-2 my-3 justify-content-end">
                            <!-- Button Favorit -->
                            <button type="button" class="btn btn-outline-dark custom-btn">
                                <i class="fas fa-heart"></i>
                            </button>

                            <div class="position-relative">
                                <!-- Button Option -->
                                <button type="button" class="btn btn-outline-dark" onclick="toggleReport(this)">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <!-- Teks Report -->
                                <a href="#" class="report-text mb-2" style="display: none">Report</a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2 my-3 justify-content-end">
                            <!-- Button Favorit -->
                            <button type="button" class="btn btn-dark">
                                Download Now
                            </button>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <!-- Tombol untuk setiap tag -->
                        <button type="button" class="btn btn-secondary btn-sm btn-tag">
                            Modern
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm btn-tag">
                            Furniture
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm btn-tag">
                            Technology
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm btn-tag">
                            Design
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm btn-tag">
                            Home Decor
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm btn-tag">
                            Background
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm btn-tag">
                            Lamp
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm btn-tag">
                            Chair
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm btn-tag">
                            Table
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm btn-tag">
                            Living Room
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <!-- description end -->

        <!-- Related -->
        <section>
            <div class="container mt-5">
                <div class="mil-background-grid mil-softened"></div>
                <div class="mil-mb-90">
                    <h2 class="mil-upper mil-up">Related Images</h2>
                </div>
                <div class="row">
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
        <!-- info end -->

        <div class="container">
            <div class="mil-divider-lg"></div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
@endsection
