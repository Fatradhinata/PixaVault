@inject('services', 'App\Http\Controllers\ServiceProvider')

<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

<!-- top bar -->
<div class="mil-top-panel">
    <a href="{{ url('/') }}" class="mil-logo">
        <img src="{{ asset('img/logo/logo_pixavault.png') }}" alt="Logo" />
    </a>
    
    @if (isset($search))
        <div class="search-panel" id="search-input">
            <input type="text" autocomplete="on" placeholder="Search for photos" value="{{ Request::input('q') }}">
            <button>
                <img src="{{ asset('img/icons/search-button.svg') }}" alt="search-button">
            </button>
        </div>
    @endif

    <div class="mil-navigation">
        <nav class="nav-min-sm">
            <img src="{{ asset('img/icons/hamburger.svg') }}" alt="hamburger">
        </nav>
        <nav class="nav-max-sm">
            <div class="mil-top-panel-right">
                @auth
                    <p class="mil-credit">
                        @if ($services::subscriptionCheck(Auth::user()->id))
                            <a href="{{ route('subscription') }}">
                                <b>Unlimited</b> Credit Available
                            </a>
                        @else
                            <a href="{{ route('pricing') }}">
                                <b id="amount-limit">{{ Auth::user()->free_limit }}</b> Credit Available
                            </a>
                        @endif
                    </p>
                @endauth
                <a href="{{ url('explore') }}" class="mil-top-panel-link mil-explore">Explore</a>
                @auth
                    <a href="{{ route('profile', ['id' => Auth::user()->id]) }}" class="mil-top-panel-link mil-pricing mil-top-panel-link-max-sm">View Profile</a>
                @endauth
                <div class="nav-horizontal-dot-wrapper">
                    <div class="nav-horizontal-dot toggleDropdown">
                        <img src="{{ asset('img/icons/horiz-dots-variant-2.svg') }}" width="30px" height="30px" alt="Horizontal-Dot">
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
                        <div class="profile-image-container toggleDropdown">
                            <img class="profile-image" src="{{ Auth::user()->photo ? asset('storage/profile_photos/' . Auth::user()->photo) : asset('img/icons/user-elipse.svg') }}" alt="User Profile">
                        </div>
                        <div class="mil-nav-dropdown mil-nav-dropdown-user dropdownMenu">
                            <div>
                                <a href="{{ route('profile') }}">
                                    <button>View Profile</button>
                                </a>
                                <a href="{{ route('profile.edit') }}"><button>Account Settings</button></a>
                                <hr>
                                <a href="{{ route('logout') }}">
                                    <button class="mil-nav-dropdown-logout">Logout</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('upload') }}" class="mil-top-panel-buttons upload-title">
                        <img src="{{ asset('img/icons/upload-icon.svg') }}" style="height: 24px;">
                        <p>UPLOAD</p>
                    </a>
                </div>
            @else
                <div class="mil-top-panel-right">
                    <a href="{{ route('login') }}" class="mil-top-panel-buttons" style="padding-left: 2rem; padding-right: 2rem; width: max-content">
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
