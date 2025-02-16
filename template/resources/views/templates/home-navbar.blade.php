<!-- wrapper -->
<div class="mil-wrapper">
    <div class="mil-progress-track">
        <div class="mil-progress"></div>
    </div>

    <!-- top bar -->
    <div class="mil-top-panel">
        <a href="{{ url('/') }}" class="mil-logo">
            <img src="{{ Vite::asset('resources/img/logo/logo_pixavault.png') }}" alt="Logo" />
        </a>
        <div class="mil-navigation">
            <nav>
                @guest
                    <div class="mil-top-panel-right">
                        <p style="color: white;"><span>5</span> Credit Available</p>
                        <a href="{{ url('explore') }}" class="mil-top-panel-link">Explore</a>
                        <a href="{{ route('login') }}" class="mil-top-panel-buttons">Login</a>
                @else
                    <div class="mil-top-panel-right">
                        <p style="color: white;"><span>5</span> Credit Available</p>
                        <a href="{{ url('explore') }}" class="mil-top-panel-link">Explore</a>
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
                                <a href="{{ url('profile/'. Auth::user()->id) }}"><button>View Profile</button></a>
                                    <button><a href="#">Stats</a></button>
                                    <button><a href="#">Account</a> Settings</button>
                                    <hr>
                                    <button class="mil-nav-dropdown-logout"><a href="#">Logout</a> </button>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('upload') }}" class="mil-top-panel-buttons">
                            <img src="{{ Vite::asset('resources/img/icons/upload-icon.svg') }}">
                            UPLOAD
                        </a>
                    </div>
                @endguest
            </nav>
        </div>
    </div>
</div>
