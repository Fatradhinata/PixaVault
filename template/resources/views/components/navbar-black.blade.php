<link rel="stylesheet" href="{{ asset('css/navbar-black.css') }}">

<!-- top bar -->
<div class="mil-top-panel">
    <a href="{{ url('/') }}" class="mil-logo">
        <img src="{{ asset('img/logo/logo_pixavault.png') }}" alt="Logo" />
    </a>
    <div class="search-panel" id="search-input">
        <input type="text" autocomplete="on" placeholder="Search for photos" value="{{ Request::input('q') }}">
        <button>
            <img src="{{ asset('img/icons/search-button.svg') }}" alt="search-button">
        </button>
    </div>
    <div class="mil-navigation">
        <nav class="nav-min-sm">
            <img src="{{ asset('img/icons/hamburger.svg') }}" alt="">
        </nav>
        <nav class="nav-max-sm">
            <div class="mil-top-panel-right">
                @auth
                    <p style="color: white;" class="mil-credit">
                        @if (Auth::user()->free_limit == -1)
                            <b>Unlimited</b> Credit Available
                        @else
                            <a href="{{ route('pricing') }}">
                                <b id="amount-limit">{{ Auth::user()->free_limit }}</b> Credit Available
                            </a>
                        @endif
                    </p>
                @endauth
                <a href="{{ url('explore') }}" class="mil-top-panel-link mil-explore" style="color: black">Explore</a>
                <a href="{{ route('leaderboard') }}" class="mil-top-panel-link mil-leaderboard mil-top-panel-link-max-sm">Leaderboard</a>
                <a href="{{ route('pricing') }}" class="mil-top-panel-link mil-pricing mil-top-panel-link-max-sm">Pricing</a>
                <a href="{{ route('profile', ['id' => Auth::user()->id]) }}"
                    class="mil-top-panel-link mil-pricing mil-top-panel-link-max-sm">View Profile</a>
                <div class="nav-horizontal-dot-wrapper">
                    <div class="nav-horizontal-dot toggleDropdown">
                        <img src="{{ asset('img/icons/horiz-dots-variant-2.svg') }}" width="30px" height="30px"
                            alt="Horizontal-Dot">
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
            @if (Auth::check())
                <div class="mil-top-panel-right">
                    <div class="mil-top-panel-user">
                        <img src="{{ asset('img/icons/user-elipse.svg') }}" width="46px" height="46px"
                            alt="" class="toggleDropdown">
                        <div class="mil-nav-dropdown mil-nav-dropdown-user dropdownMenu">
                            <div>
                                <a href="{{ route('profile', ['id' => Auth::user()->id]) }}">
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
                    <a href="{{ route('upload') }}" class="mil-top-panel-buttons upload-title">
                        <img src="{{ asset('img/icons/upload-icon.svg') }}" style="height: 24px; margin-right: 8px;">
                        <p>UPLOAD</p>
                    </a>
                </div>
            @else
                <div class="mil-top-panel-right">
                    <a href="{{ route('login') }}" class="mil-top-panel-buttons"
                        style="padding-left: 2rem; padding-right: 2rem; width: max-content">
                        Get Started
                    </a>
                </div>
            @endif
        </nav>
    </div>
</div>

@section('scripts')
    @parent
    <script src="{{ asset('js/navbar.js') }}"></script>
@endsection
