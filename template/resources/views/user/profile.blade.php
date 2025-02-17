@extends('templates.user')

@section('styles')
  @vite('resources/css/profile.css')
@endsection

@section('navbar')
    @include('components.navbar-white')
@endsection

@section('content')
  <!-- content -->
  <div id="content">
    <div class="profile">
    <div class="profile-detail d-flex align-items-center">
      <div class="profile-image d-flex align-items-center">
      <img src="{{ Vite::asset('resources/img/icons/user-elipse.svg') }}" alt="user">
      </div>
      <div class="profile-info d-flex flex-column">
      <div class="profile-header d-flex">
        <h3 class="role-own-profile">{{ $user->name }}</h3>
        <div class="profile-actions d-flex">
        <div class="d-flex align-items-center role-other-user d-none">
          <button id="button-follow" class="btn-follow">Follow</button>
          <button class="btn-options"><img src="{{ Vite::asset('resources/img/icons/horiz-dots.svg') }}" alt=""></button>
          <button class="btn-report d-none">Report</button>
        </div>
        <div class="d-flex align-items-center role-own-profile">
          <button class="btn-edit-profile"><img src="{{ Vite::asset('resources/img/icons/edit-pen.svg') }}" alt="">Edit Profile</button>
        </div>
        </div>
      </div>
      <p class="profile-email">{{ $user->email }}</p>
      <p class="profile-bio">{{ $user->bio }}</p>
      </div>
    </div>
    </div>
    <div class="profile-content">
    <div class="profile-tab-nav">
      <button class="tab-btn active" data-tab="photos">
      <img src="{{ Vite::asset('resources/img/icons/multi-image.svg') }}" alt="multiple image">Photos 12
      </button>
      <button class="tab-btn" data-tab="likes">
      <img src="{{ Vite::asset('resources/img/icons/love-black.svg') }}" alt="likes">Likes 0
      </button>
      <button class="tab-btn role-own-profile" data-tab="stats">
      <img src="{{ Vite::asset('resources/img/icons/stats.svg') }}" alt="stats">Stats
      </button>
    </div>
    <div class="tab-content-container">
      <div class="tab-content active" id="photos">
      <div class="row">
        <div class="col-md-6 col-lg-3">
        <a href="project.html" class="mil-portfolio-item mil-square-item mil-up mil-mb-30 position-relative">
          <!-- Gambar -->
          <img src="{{ Vite::asset('resources/img/foto/1.jpg') }}" alt="cover" class="mil-image no-save" />

          <!-- Profil di kiri bawah -->
          <div class="mil-profile">
          <img src="{{ Vite::asset('resources/img/faces/user.jpg') }}" alt="Profile Picture" class="mil-profile-img" />
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
      <div class="tab-content" id="likes">
      <div class="unavailable d-flex flex-column align-items-center ">
        <img src="{{ Vite::asset('resources/img/icons/frowning-face.svg') }}" alt="frowning-face">
        <h3>This user has not liked any photos</h3>
      </div>
      </div>
      <div class="tab-content tab-content-stats role-own-profile" id="stats">
      <h4>Insights</h4>
      <div class="tab-content-stats-diagram d-flex flex-wrap justify-content-between">
        <div class="card">
        <div class="header">
          <div class="d-flex flex-column align-items-start">
          <h3>Views</h3>
          <h1 id="view-count">2,313</h1>
          </div>
          <select class="dropdown tab-content-stats-dropdown" name="time" id="timeViewFilter">
          <option value="weekly">Weekly</option>
          <option value="monthly">Monthly</option>
          <option value="yearly">Yearly</option>
          </select>
        </div>
        <canvas id="viewsChart" height="200px"></canvas>
        </div>
        <div class="card">
        <div class="header">
          <div class="d-flex flex-column align-items-start">
          <h3>Downloads</h3>
          <h1 id="download-count">512</h1>
          </div>
          <select class="dropdown tab-content-stats-dropdown" name="time" id="timeDownloadFilter">
          <option value="weekly">Weekly</option>
          <option value="monthly">Monthly</option>
          <option value="yearly">Yearly</option>
          </select>
        </div>
        <canvas id="downloadsChart" height="200px"></canvas>
        </div>
      </div>
      <h4>Badge</h4>
      <div class="card badge-card">
        <div class="badge-card-header">
        <p>Achievements</p>
        <div>3</div>
        </div>
        <div class="badge-card-achievements">
        <div class="badge-card-achievements-icon">
          <img src="{{ Vite::asset('resources/img/icons/achievement-icon-1.svg') }}" alt="achievement-icon-1">
          <p>Top Like February 2025</p>
        </div>
        <div class="badge-card-achievements-icon">
          <img src="{{ Vite::asset('resources/img/icons/achievement-icon-2.svg') }}" alt="achievement-icon-2">
          <p>Top Download February 2025</p>
        </div>
        <div class="badge-card-achievements-icon">
          <img src="{{ Vite::asset('resources/img/icons/achievement-icon-3.svg') }}" alt="achievement-icon-3">
          <p>Top Like March 2025</p>
        </div>
        </div>
      </div>
      <!-- <div class="card">
        <div class="header">
        <div class="d-flex flex-column">
        <h3>Views</h3>
        <h1 id="view-count">2,313</h1>
        </div>
        <button class="dropdown">Weekly ▼</button>
        </div>
        <canvas id="viewsChart"></canvas>
      </div> -->
      </div>
    </div>
    </div>
  </div>
  <!-- footer -->
  <footer class="mil-relative">
    <img src="img/foto/4.jpg" class="mil-bg-img mil-parallax" alt="image" style="object-position: top" data-value-1="-25%"
    data-value-2="23%" />
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
        <img src="img/logo/logo.png" alt="Logo" style="width: 130px" />
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
  <!-- content -->
@endsection
@vite(['resources/js/profile.js'])