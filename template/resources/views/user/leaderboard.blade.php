@extends('templates.user')

@section('title', 'Leaderboard')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/leaderboard.css') }}">
@endsection

@section('navbar')
    @include('components.navbar', ['search' => true])
    <style>
        .mil-top-panel {
            .mil-logo img {
                filter: invert(1);
            }

            .nav-min-sm {
                filter: invert(1);
                transition: filter 0.3s ease;
            }

            .mil-credit,
            .mil-explore {
                color: black
            }

            .nav-horizontal-dot {
                img {
                    filter: invert(1);
                }

                &:hover {
                    background-color: #000;

                    img {
                        filter: invert(0);
                    }
                }
            }

            &.mil-active {
                .nav-horizontal-dot {
                    img {
                        filter: invert(0) !important;
                    }

                    &:hover {
                        background-color: #fff;

                        img {
                            filter: invert(1) !important;
                        }
                    }
                }

                .nav-min-sm {
                    filter: invert(0) !important;
                }

                .mil-credit * {
                    color: white;
                }
            }
        }
    </style>
@endsection

@php
    $following = Auth::user()->following;
@endphp

@section('content')
    <div class="container">
        <div class="header">
            <h3>LEADERBOARD</h3>
            <p>Members with the most likes on content added in the last 4 weeks.</p>
        </div>
        <div class="tab-header">
            <div class="tab-nav">
                <button class="tab-btn active" data-tab="most-likes">
                    Most Likes
                </button>
                <button class="tab-btn" data-tab="most-downloads">
                    Most Downloads
                </button>
            </div>
        </div>
        <!-- Gallery -->
        <div class="row tab-content active" id="most-likes">

            @foreach ($leaderboardLikes as $index => $item)
                <a href="{{ route('profile') }}?id={{ $item['id'] }}" class="leaderboard-row {{ $item['id'] == Auth::id() ? 'highlight' : '' }}">
                    <div class="user-detail">
                        <h3>{{ $index + 1 }}</h3>
                        <div class="user-detail-core">
                            <img src="{{ $item['photo'] ? asset('storage/profile_photos/' . $item['photo']) : asset('img/icons/user-elipse.svg') }}" alt="Photo Profile">
                            <div class="user-name">
                                <div>
                                    <p class="username">{{ $item['name'] }}</p>
                                    <p class="download-total">{{ $item['total'] }} Likes</p>
                                </div>

                                @if ($item['id'] == Auth::id())
                                    <button class="follow-disabled" disabled>Follow</button>
                                @elseif ($following->contains($item['id']))
                                    <button class="follow btn-followed" data-user-id="{{ $item['id'] }}">Followed</button>
                                @else
                                    <button class="follow btn-follow" data-user-id="{{ $item['id'] }}">Follow</button>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="user-content">
                        @php $contents = $item['top_contents']; @endphp
                        <div>
                            <img src="{{ route('image', $contents[0]['photo']) }}" alt="{{ $contents[0]['name'] }}">
                        </div>
                        <div>
                            <img src="{{ route('image', $contents[1]['photo']) }}" alt="{{ $contents[1]['name'] }}">
                        </div>
                        <div>
                            <img src="{{ route('image', $contents[2]['photo']) }}" alt="{{ $contents[2]['name'] }}">
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
        <div class="row tab-content" id="most-downloads">

            @foreach ($leaderboardDownloads as $index => $item)
                <a href="{{ route('profile') }}?id={{ $item['id'] }}" class="leaderboard-row {{ $item['id'] == Auth::id() ? 'highlight' : '' }}">
                    <div class="user-detail">
                        <h3>{{ $index + 1 }}</h3>
                        <div class="user-detail-core">
                            <img src="{{ $item['photo'] ? asset('storage/profile_photos/' . $item['photo']) : asset('img/icons/user-elipse.svg') }}" alt="Photo Profile">
                            <div class="user-name">
                                <div>
                                    <p class="username">{{ $item['name'] }}</p>
                                    <p class="download-total">{{ $item['total'] }} Downloads</p>
                                </div>

                                @if ($item['id'] == Auth::id())
                                    <button class="follow-disabled" disabled>Follow</button>
                                @elseif ($following->contains($item['id']))
                                    <button class="follow btn-followed" data-user-id="{{ $item['id'] }}">Followed</button>
                                @else
                                    <button class="follow btn-follow" data-user-id="{{ $item['id'] }}">Follow</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="user-content">
                        @php $contents = $item['top_contents']; @endphp
                        <div>
                            <img src="{{ route('image', $contents[0]['photo']) }}" alt="{{ $contents[0]['name'] }}">
                        </div>
                        <div>
                            <img src="{{ route('image', $contents[1]['photo']) }}" alt="{{ $contents[1]['name'] }}">
                        </div>
                        <div>
                            <img src="{{ route('image', $contents[2]['photo']) }}" alt="{{ $contents[2]['name'] }}">
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
    </div>

    @if (
        in_array(Auth::id(), array_column($leaderboardLikes, 'id')) &&
        in_array(Auth::id(), array_column($leaderboardDownloads, 'id'))
    )    
        <script src="https://cdn.jsdelivr.net/npm/@tsparticles/confetti@3.0.3/tsparticles.confetti.bundle.min.js"></script>
        <script>
            const defaults = {
                spread: 360,
                ticks: 50,
                gravity: 0,
                decay: 0.94,
                startVelocity: 30,
                shapes: ["star"],
                colors: ["FFE400", "FFBD00", "E89400", "FFCA6C", "FDFFB8"],
            };

            function shoot() {
                confetti({
                    ...defaults,
                    particleCount: 40,
                    scalar: 1.2,
                    shapes: ["star"],
                });

                confetti({
                    ...defaults,
                    particleCount: 10,
                    scalar: 0.75,
                    shapes: ["circle"],
                });
            }

            setTimeout(shoot, 0);
            setTimeout(shoot, 100);
            setTimeout(shoot, 200);
        </script>
    @endif


@endsection

@section('scripts')
    <script src="{{ asset('js/leaderboard.js') }}"></script>
@endsection
