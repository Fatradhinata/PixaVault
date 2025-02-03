@extends('templates.user')

@section('customcss')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
@endsection

@section('content')
 <!-- content -->
 <div id="content">
        <!-- banner -->
        <section class="mil-banner history">
          <img
            src="img/foto/1.jpg"
            class="background-content-image mil-bg-img mil-scale"
            data-value-1=".4"
            data-value-2="1.4"
            alt="image"
          />
          <div class="mil-overlay history-overlay"></div>
          <div class="history-parent">
            <div class="history-content">
              <div class="d-flex justify-content-between">
                <div class="d-flex flex-column">
                  <p class="text-xl font-700">History</p>
                  <p class="mil-text-sm">
                    Track and revisit everything you've downloaded here.
                  </p>
                </div>
                <div class="background-secondary p-3 d-flex ms-auto" style="border-radius: 100%;">
                  <img src="img/icons/calendar-solid.svg" alt="">
                </div>
                <div class="history-search">
                  <div class="input-group">
                    <input type="text" placeholder="Search history..." />
                    <img
                      src="img/icons/search-button.svg"
                      alt="search button"
                    />
                  </div>
                </div>
              </div>
              <div class="d-flex flex-column mb-auto">
                <div class="col-12 d-flex flex-column pb-6" style="width: 100%; gap: 36px; border-bottom: 1px solid #464646; margin-bottom: 4rem;">
                  <h5>Today - Thursday, January 23, 2025</h5>
                  <div class="p-2 d-flex">
                    <div class="d-flex">
                        <input type="checkbox" />
                    </div>
                    <img src="./img/foto/1.jpg" width="200px" alt="">
                    <div class="d-flex flex-column" style="gap: 2px;">
                      <div class="d-flex">
                        <h6>The bird on the lake</h6>
                        <p> - 11.32 AM</p>
                      </div>
                      <div class="d-flex">
                        <img src="./img/foto/category/potraits.JPG" width="25px" height="25px" alt="" style="border-radius: 100%; object-fit: cover;">
                        <p>Nopal Bin Ajaib</p>
                      </div>
                      <div class="mt-3">
                        A serene lake at sunset, reflecting soft hues of orange and pink. A solitary bird with white feathers and an orange beak stan...
                      </div>
                    </div>
                  </div>
                  <div class="p-2 d-flex">
                    <div class="d-flex">
                        <input type="checkbox" />
                    </div>
                    <img src="./img/foto/1.jpg" width="200px" alt="">
                    <div class="d-flex flex-column" style="gap: 2px;">
                      <div class="d-flex">
                        <h6>The bird on the lake</h6>
                        <p> - 11.32 AM</p>
                      </div>
                      <div class="d-flex">
                        <img src="./img/foto/category/potraits.JPG" width="25px" height="25px" alt="" style="border-radius: 100%; object-fit: cover;">
                        <p>Nopal Bin Ajaib</p>
                      </div>
                      <div class="mt-3">
                        A serene lake at sunset, reflecting soft hues of orange and pink. A solitary bird with white feathers and an orange beak stan...
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 d-flex flex-column pb-6" style="width: 100%; gap: 36px; border-bottom: 1px solid #464646; margin-bottom: 4rem;">
                  <h5>Today - Thursday, January 23, 2025</h5>
                  <div class="p-2 d-flex">
                    <div class="d-flex">
                        <input type="checkbox" />
                    </div>
                    <img src="./img/foto/1.jpg" width="200px" alt="">
                    <div class="d-flex flex-column" style="gap: 2px;">
                      <div class="d-flex">
                        <h6>The bird on the lake</h6>
                        <p> - 11.32 AM</p>
                      </div>
                      <div class="d-flex">
                        <img src="./img/foto/category/potraits.JPG" width="25px" height="25px" alt="" style="border-radius: 100%; object-fit: cover;">
                        <p>Nopal Bin Ajaib</p>
                      </div>
                      <div class="mt-3">
                        A serene lake at sunset, reflecting soft hues of orange and pink. A solitary bird with white feathers and an orange beak stan...
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <footer class="mil-relative">
          <img
            src="img/foto/4.jpg"
            class="mil-bg-img mil-parallax"
            alt="image"
            style="object-position: top"
            data-value-1="-25%"
            data-value-2="23%"
          />
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
                          <li class="mil-active">
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
                    <span
                      class="mil-suptitle mil-light mil-upper mil-up mil-mb-30"
                      >Wills Point</span
                    >
                    <p class="mil-text-sm mil-up mil-light-soft mil-mb-30">
                      8619 S Wolcott Avenue <br />Floor 202 <br />Chicago, IL
                      60620 <br />(773) 238 - 7162
                    </p>
                  </div>
                  <div class="col-md-6 col-lg-6 col-xl-3">
                    <span
                      class="mil-suptitle mil-light mil-upper mil-up mil-mb-30"
                      >Chicago</span
                    >
                    <p class="mil-text-sm mil-up mil-light-soft mil-mb-30">
                      10233 Gaillard Lake Est <br />Suite 420 <br />Houston, TX
                      75169 <br />(903) 560 - 9830
                    </p>
                  </div>
                  <div class="col-md-6 col-lg-6 col-xl-3">
                    <span
                      class="mil-suptitle mil-light mil-upper mil-up mil-mb-30"
                      >Harriman</span
                    >
                    <p class="mil-text-sm mil-up mil-light-soft mil-mb-30">
                      5 Harriman Woods Dr <br />Suite 702 <br />New York, NY
                      10926 <br />(570) 253 - 2853
                    </p>
                  </div>
                  <div class="col-md-6 col-lg-6 col-xl-3">
                    <span
                      class="mil-suptitle mil-light mil-upper mil-up mil-mb-30"
                      >Largo</span
                    >
                    <p class="mil-text-sm mil-up mil-light-soft mil-mb-30">
                      1071 Donegan Rd <br />Suite 1300 <br />Florida, FL 33771
                      <br />(727) 223 - 5371
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <a href="home-1.html" class="mil-footer-logo mil-up mil-mb-30">
                  <img
                    src="img/logo/logo.png"
                    alt="Logo"
                    style="width: 130px"
                  />
                </a>
              </div>
            </div>
          </div>
          <div class="container-fluid">
            <div class="mil-footer-bottom">
              <p class="mil-light-soft mil-mb-15">
                © 2023. All rights reserved.
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
    @endsection

    @section('customjs')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    @endsection
