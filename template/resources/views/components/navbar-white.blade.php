@vite('resources/css/navbar-white.css')


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
        <div class="search-panel" id="search-input">
            <input type="text" autocomplete="on" placeholder="Search for photos">
            <button>
                <img src="{{ Vite::asset('resources/img/icons/search-button.svg') }}" alt="search-button">
            </button>
        </div>
        <div class="mil-navigation">
            <nav>
                <div class="mil-top-panel-right">
                    @auth
                        <p style="color: white;" class="mil-credit"><b>{{ Auth::user()->credit }}</b> Credit Available</p>
                    @endauth
                    <a href="{{ url('explore') }}" class="mil-top-panel-link mil-explore" style="color: black">Explore</a>
                    <div class="nav-horizontal-dot-wrapper">
                        <div class="nav-horizontal-dot toggleDropdown">
                            <img src="{{ Vite::asset('resources/img/icons/horiz-dots-variant-2.svg') }}" width="30px" height="30px" alt="Horizontal-Dot">
                        </div>
                        <div class="mil-nav-dropdown dropdownMenu">
                            <div>
                                <a href="{{ route('leaderboard') }}">
                                    <button>Leaderboard</button>
                                </a>
                                <a href="{{ route('pricing') }}">
                                    <button>Pricing</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mil-top-panel-right">
                    <div class="mil-top-panel-user">
                        <img src="{{ Vite::asset('resources/img/icons/user-elipse.svg') }}" width="46px" height="46px" alt="" class="toggleDropdown">
                        <div class="mil-nav-dropdown mil-nav-dropdown-user dropdownMenu">
                            <div>
                                <a href="{{ route('profile') }}">
                                    <button>View Profile</button>
                                </a>
                                <a href="#"><button>Account Settings</button></a>
                                <hr>
                                <a href="{{ route('logout') }}">
                                    <button class="mil-nav-dropdown-logout">Logout</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('upload') }}" class="mil-top-panel-buttons">
                        <img src="{{ Vite::asset('resources/img/icons/upload-icon.svg') }}">UPLOAD
                    </a>
                </div>
            </nav>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    @vite('resources/js/navbar.js')
@endsection
