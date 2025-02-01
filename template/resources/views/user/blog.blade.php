@extends('templates.user')

@section('content')
<div id="content">
    <section class="mil-banner mil-banner-sm">
        <img src="img/foto/1.jpg" class="mil-bg-img mil-scale" data-value-1=".4" data-value-2="1.4" alt="image" />
        <div class="mil-overlay"></div>
        <div class="container">
            <div class="mil-background-grid mil-top-space"></div>
            <div class="mil-banner-content mil-center">
                <div class="mil-mb-90">
                    <h1 class="mil-light mil-upper mil-mb-30">Insights</h1>
                    <ul class="mil-breadcrumbs mil-center">
                        <li><a href="home-1.html">Home</a></li>
                        <li><a href="blog.html">Blog</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- banner end -->

    <!-- blog -->
    <section>
        <div class="container mil-p-120-60">
            <div class="mil-background-grid mil-softened"></div>
            <div class="row justify-content-between">
                <div class="col-lg-7">
                    <a href="publication.html" class="mil-blog-card mil-lg-card mil-mb-60">
                        <div class="mil-cover mil-long mil-up">
                            <img src="img/foto/random 1.jpg" alt="cover" />
                            <div class="mil-date">11.09.2023</div>
                        </div>
                        <div class="mil-description">
                            <div class="mil-left-side">
                                <span class="mil-suptitle mil-upper mil-up mil-mb-30">Tips and Trick</span>
                                <h4 class="mil-upper mil-up mil-mb-30">
                                    10 Tips to Take Better Photos with Your Smartphone Like
                                    a Pro
                                </h4>
                            </div>
                            <div class="mil-right-side mil-mt-suptitle-offset">
                                <p class="mil-up mil-mb-30">
                                    Mengambil foto yang bagus tidak selalu membutuhkan
                                    kamera profesional. Dengan teknologi kamera ponsel yang
                                    semakin canggih, Anda dapat menghasilkan foto yang
                                    menakjubkan hanya dengan smartphone. Berikut adalah 10
                                    tips untuk memaksimalkan kemampuan fotografi ponsel
                                    Anda.
                                </p>
                                <span class="mil-link mil-upper mil-up">Read
                                    <span class="mil-arrow"><img src="img/icons/1.svg" alt="arrow" /></span></span>
                            </div>
                        </div>
                    </a>

                    <!-- filter -->
                    <div class="mil-filter mil-up mil-mb-90">
                        <div class="mil-filter-links">
                            <a href="#." class="mil-current">All</a>
                            <a href="#.">Tutorial</a>
                            <a href="#.">Information</a>
                            <a href="#.">Tips and Trick</a>
                        </div>
                    </div>
                    <!-- filter end -->

                    <a href="publication.html" class="mil-blog-card mil-mb-60">
                        <div class="mil-cover mil-square mil-up">
                            <img src="img/foto/2.jpg" alt="cover" />
                            <div class="mil-date">11.09.2023</div>
                        </div>
                        <div class="mil-description">
                            <span class="mil-suptitle mil-upper mil-up mil-mb-30">Information</span>
                            <h4 class="mil-upper mil-up mil-mb-30">
                                Some Features About Pixavault You Should Know
                            </h4>
                            <p class="mil-up mil-mb-30">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                sed do eiusmod tempor incididunt ut labore et dolore
                                magna.
                            </p>
                            <span class="mil-link mil-upper mil-up">Read
                                <span class="mil-arrow"><img src="img/icons/1.svg" alt="arrow" /></span></span>
                        </div>
                    </a>
                    <a href="publication.html" class="mil-blog-card mil-mb-60">
                        <div class="mil-cover mil-square mil-up">
                            <img src="img/foto/3.jpg" alt="cover" />
                            <div class="mil-date">11.09.2023</div>
                        </div>
                        <div class="mil-description">
                            <span class="mil-suptitle mil-upper mil-up mil-mb-30">Information</span>
                            <h4 class="mil-upper mil-up mil-mb-30">
                                Why Choose Pixavault Over Other Platforms?
                            </h4>
                            <p class="mil-up mil-mb-30">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                sed do eiusmod tempor incididunt ut labore et dolore
                                magna.
                            </p>
                            <span class="mil-link mil-upper mil-up">Read
                                <span class="mil-arrow"><img src="img/icons/1.svg" alt="arrow" /></span></span>
                        </div>
                    </a>
                    <a href="publication.html" class="mil-blog-card mil-mb-60">
                        <div class="mil-cover mil-square mil-up">
                            <img src="img/foto/4.jpg" alt="cover" />
                            <div class="mil-date">11.09.2023</div>
                        </div>
                        <div class="mil-description">
                            <span class="mil-suptitle mil-upper mil-up mil-mb-30">Tutorial</span>
                            <h4 class="mil-upper mil-up mil-mb-30">
                                A Beginner’s Guide to Pixavault
                            </h4>
                            <p class="mil-up mil-mb-30">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                sed do eiusmod tempor incididunt ut labore et dolore
                                magna.
                            </p>
                            <span class="mil-link mil-upper mil-up">Read
                                <span class="mil-arrow"><img src="img/icons/1.svg" alt="arrow" /></span></span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-5">
                    <div class="mil-sidebar-frame">
                        <h6 class="mil-upper mil-up mil-mb-30">Media Info</h6>
                        <ul class="mil-list mil-dark mil-up mil-mb-30">
                            <li class="mil-text-sm">media@ruizarch.com</li>
                            <li class="mil-text-sm">authors@ruizarch.com</li>
                        </ul>

                        <div class="mil-divider-lg mil-up mil-mb-30"></div>

                        <div class="mil-sidebar-search mil-up mil-mb-30">
                            <input type="text" placeholder="Search in blog ..." />
                            <button><img src="img/icons/13.svg" alt="search" /></button>
                        </div>

                        <div class="mil-divider-lg mil-up mil-mb-30"></div>

                        <h6 class="mil-upper mil-up mil-mb-30">Recent Posts</h6>
                        <ul class="mil-list mil-list-type-2 mil-dark mil-up mil-mb-30">
                            <li>
                                <span class="mil-text-sm mil-mb-10">This micro camper with glass doors, oversized
                                    window
                                    and a skylight ..</span>
                                <span class="mil-additional-text mil-text-xs mil-upper mil-mb-15">11.09.2023</span>
                            </li>
                            <li>
                                <span class="mil-text-sm mil-mb-10">This micro camper with glass doors, oversized
                                    window
                                    and a skylight ..</span>
                                <span class="mil-additional-text mil-text-xs mil-upper mil-mb-15">11.09.2023</span>
                            </li>
                            <li>
                                <span class="mil-text-sm mil-mb-10">This micro camper with glass doors, oversized
                                    window
                                    and a skylight ..</span>
                                <span class="mil-additional-text mil-text-xs mil-upper mil-mb-15">11.09.2023</span>
                            </li>
                            <li>
                                <span class="mil-text-sm mil-mb-10">This micro camper with glass doors, oversized
                                    window
                                    and a skylight ..</span>
                                <span class="mil-additional-text mil-text-xs mil-upper">11.09.2023</span>
                            </li>
                        </ul>

                        <div class="mil-divider-lg mil-up mil-mb-30"></div>



                        <div class="mil-divider-lg mil-up mil-mb-30"></div>

                        <h6 class="mil-upper mil-up mil-mb-30">Tags</h6>

                        <ul class="mil-list mil-dark mil-up mil-mb-30">
                            <li class="mil-text-sm">Design Stories</li>
                            <li class="mil-text-sm">Perspectives</li>
                            <li class="mil-text-sm">Research</li>
                        </ul>

                        <div class="mil-divider-lg mil-up mil-mb-30"></div>



                        <div class="mil-divider-lg mil-up mil-mb-30"></div>

                        <h6 class="mil-upper mil-up mil-mb-30">Social Media</h6>

                        <ul class="mil-list mil-dark mil-up">
                            <li class="mil-text-sm">Facebook</li>
                            <li class="mil-text-sm">Twitter</li>
                            <li class="mil-text-sm">LinkendIn</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- blog end -->

    <!-- pagination -->
    <div class="container mil-p-0-120">
        <div class="mil-background-grid mil-softened"></div>
        <div class="mil-pagination mil-up">
            <div class="mil-nav-buttons">
                <div class="mil-slider-button mil-banner-prev">Prev</div>
                <div class="mil-slider-button mil-banner-next">Next</div>
            </div>
            <ul class="mil-page-numbers">
                <li class="mil-active"><a href="#.">01</a></li>
                <li><a href="#.">02</a></li>
                <li><a href="#.">...</a></li>
                <li><a href="#.">06</a></li>
            </ul>
        </div>
    </div>
    <!-- pagination end -->
@endsection
