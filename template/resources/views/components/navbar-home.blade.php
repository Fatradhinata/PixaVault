@vite('resources/css/navbar-home.css')

<div class="mil-top-panel">
    <a href="{{ route('home') }}" class="mil-logo">
        <img src="{{ Vite::asset('resources/img/logo/logo_pixavault.png') }}" alt="Logo" />
    </a>
    <div class="mil-navigation">
        <nav>
            <div class="mil-top-panel-right">
                @auth
                    <p style="color: white;" class="mil-credit">
                        @if (Auth::user()->free_limit == -1)
                            <b>Unlimited</b> Credit Available
                        @else
                            <b>
                                {{ Auth::user()->free_limit }}
                            </b> Credit Available
                        @endif
                    </p>
                @endauth
                <a href="{{ route('explore') }}" class="mil-top-panel-link mil-explore">Explore</a>
                <div class="nav-horizontal-dot-wrapper">
                    <div class="nav-horizontal-dot toggleDropdown">
                        <img src="{{ Vite::asset('resources/img/icons/horiz-dots-variant-2.svg') }}" width="30px"
                            height="30px" alt="Horizontal-Dot">
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
                        <img src="{{ Vite::asset('resources/img/icons/user-elipse.svg') }}" width="46px" height="46px"
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
                    <a href="{{ route('upload') }}" class="mil-top-panel-buttons">
                        <img src="{{ Vite::asset('resources/img/icons/upload-icon.svg') }}"
                            style="height: 24px; margin-right: 8px;"> UPLOAD
                    </a>
                </div>
            @else
                <div class="mil-top-panel-right">
                    <a href="{{ route('login') }}" class="mil-top-panel-buttons"
                        style="padding-left: 2rem; padding-right: 2rem;">
                        Get Started
                    </a>
                </div>
            @endif

        </nav>
    </div>
</div>

@section('scripts')
    @parent
    @vite('resources/js/navbar.js')
@endsection