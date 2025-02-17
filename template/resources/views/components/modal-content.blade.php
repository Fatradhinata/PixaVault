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
                        <img width="15px" height="15px" src="{{ Vite::asset('resources/img/icons/arrow-down.svg') }}" alt="Arrow Down">
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
            <img src="img/icons/camera-variant-1.svg" width="28px" height="28px" alt="cam-1">
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
                        <a href="project.html" class="mil-portfolio-item mil-square-item mil-up mil-mb-30">
                            <img src="{{ Vite::asset('resources/img/foto/1.jpg') }}" alt="cover" />
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

                        <a href="project.html" class="mil-portfolio-item mil-square-item mil-up mil-mb-30">
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
                        <a href="project.html" class="mil-portfolio-item mil-long-item mil-up mil-mb-30">
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
                        <a href="project.html" class="mil-portfolio-item mil-square-item mil-up mil-mb-30">
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

                        <a href="project.html" class="mil-portfolio-item mil-square-item mil-up mil-mb-30">
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
                        <a href="project.html" class="mil-portfolio-item mil-long-item mil-up mil-mb-30">
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