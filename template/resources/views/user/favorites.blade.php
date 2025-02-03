@extends('templates.user')

@section('customcss')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
@endsection

@section('content')
    <!-- content -->
    <div id="content">

      <!-- banner -->
      <section class="mil-banner favorites">
        <img src="img/foto/1.jpg" class="background-content-image mil-bg-img mil-scale" data-value-1=".4"
          data-value-2="1.4" alt="image">
        <div class="mil-overlay favorites-overlay"></div>
        <div class="favorites-parent">
          <div class="favorites-content">
            <div class="d-flex justify-content-between">
              <div class="d-flex flex-column">
                <p class="text-xl font-700">Favorites</p>
                <p class="mil-text-sm">Your favorite picks, all in one place.</p>
              </div>
              <div class="favorites-search">
                <div class="input-group">
                  <input type="text" placeholder="Search favorites...">
                  <img src="img/icons/search-button.svg" alt="search button">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-lg-3">
                <a href="project.html" class="mil-portfolio-item mil-square-item mil-up mil-mb-30 position-relative">
                  <!-- Gambar -->
                  <img src="img/foto/1.jpg" alt="cover" class="mil-image no-save" />
  
                  <!-- Profil di kiri bawah -->
                  <div class="mil-profile">
                    <img src="img/faces/user.jpg" alt="Profile Picture" class="mil-profile-img" />
                    <div>
                      <p class="mil-username mt-1">Leo_Visions</p>
                    </div>
                  </div>
  
                  <!-- Tombol di kanan atas -->
                  <div class="mil-buttons">
                    <button class="mil-love-btn">
                      <i class="fas fa-heart"></i>
                    </button>
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

        </div>
      </section>
    @endsection

    @section('customjs')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    @endsection
