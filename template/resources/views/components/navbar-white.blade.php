@section('styles')
  @vite('resources/css/navbar-white.css')
@endsection

<!-- wrapper -->
<div class="mil-wrapper">
  <div class="mil-progress-track">
    <div class="mil-progress"></div>
  </div>

  <!-- top bar -->
  <div class="mil-top-panel">
    <a href="{{ url('/') }}" class="mil-logo">
      <img src="{{ Vite::asset('resources/img/logo/logo_pixavault_black.png') }}" alt="Logo" />
    </a>
    <div class="search-panel">
      <input type="text" autocomplete="on" placeholder="Search for photos">
      <button>
        <img src="{{ Vite::asset('resources/img/icons/search-button.svg') }}" alt="search-button">
      </button>
    </div>
    <div class="mil-navigation">
      <nav>
        <div class="mil-top-panel-right">
          <a href="{{ url('explore') }}" class="mil-top-panel-link" style="color: black">Explore</a>
          <div class="nav-horizontal-dot-wrapper">
            <div class="nav-horizontal-dot toggleDropdown">
              <img src="{{ Vite::asset('resources/img/icons/horiz-dots-variant-2.svg') }}" width="30px" height="30px"
                alt="Horizontal-Dot">
            </div>
            <div class="mil-nav-dropdown dropdownMenu">
              <div>
                <button><a href="#">Leaderboard</a></button>
                <button><a href="#">Pricing</a></button>
              </div>
            </div>
          </div>
        </div>
        <div class="mil-top-panel-right">
          <div class="mil-top-panel-user">
            <img src="{{ Vite::asset('resources/img/icons/user-elipse.svg') }}" width="46px" height="46px" alt=""
              class="toggleDropdown">
            <div class="mil-nav-dropdown mil-nav-dropdown-user dropdownMenu">
              <div>
                <button><a href="#">View</a> Profile</button>
                <button><a href="#">Stats</a></button>
                <button><a href="#">Account</a> Settings</button>
                <hr>
                <button class="mil-nav-dropdown-logout"><a href="#">Logout</a> </button>
              </div>
            </div>
          </div>
          <a href="#" class="mil-top-panel-buttons">
            <img src="{{ Vite::asset('resources/img/icons/upload-icon.svg') }}">UPLOAD
          </a>
        </div>
      </nav>
    </div>
  </div>
</div>