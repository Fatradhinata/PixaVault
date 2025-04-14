@extends('templates.user')

@section('title', 'Search')

@section('styles')
    @parent
    <link rel="stylesheet" href="{{ asset('css/result.css') }}">
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

@section('content')
    <!-- content -->
    <div class="container">
        <h3>Showing result for <b>"{{ $search }}"</b></h3>


        <div class="tab-header">
            <div class="tab-nav">
                <button class="tab-btn active" data-tab="photos">
                    <img src="{{ asset('img/icons/multi-image.svg') }}" alt="multiple image">
                    Photos <b>{{ count(array_merge($contents[0], $contents[1], $contents[2])) }}</b>
                </button>
                <button class="tab-btn" data-tab="users">
                    <img src="{{ asset('img/icons/people.svg') }}" alt="users icon">
                    Users <b>{{ count($users) }}</b>
                </button>
            </div>
            {{-- <div class="filter-wrapper">
                <p>Sort by :</p>
                <select class="dropdown select-sort">
                    <option value="newest">Newest</option>
                    <option value="oldest">Oldest</option>
                    <option value="highest-resolution">Highest Resolution</option>
                    <option value="lowest-resolution">Lowest Resolution</option>
                </select>
            </div> --}}
        </div>
        <!-- Gallery -->
        <div class="row tab-content active" id="photos">
            <div class="col-lg-4 col-md-4 mb-4 col-sm-4 mb-lg-0 px-sm-2">

                @foreach ($contents[0] as $content)
                    <div class="content-item mil-up position-relative">
                        <div class="mil-buttons">
                            <button class="mil-love-btn like-btn" data-id="{{ $content->id }}">
                                @if ($content->is_liked)
                                    <i class="fas fa-heart"></i>
                                @else
                                    <i class="far fa-heart"></i>
                                @endif
                            </button>
                            <button class="mil-download-btn" data-href="{{ route('image.download', $content->id) }}">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                        <img src="{{ route('image', $content->photo) }}" class="w-100 shadow-1-strong rounded"
                            alt="Photo" data-modal-target="modal-content" data-id="{{ $content->id }}" />
                        <div class="image-profile">
                            <img src="{{ $content->user['photo'] ? asset('storage/profile_photos/' . $content->user['photo']) : asset('img/icons/user-elipse.svg') }}"
                                alt="Profile Picture" class="mil-profile-img" />
                            <p class="mil-username">{{ $content->user['name'] ?? 'anonymous' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-lg-4 col-md-4 mb-4 col-sm-4 mb-lg-0 px-sm-2">
                @foreach ($contents[1] as $content)
                    <div class="content-item mil-up position-relative">
                        <div class="mil-buttons">
                            <button class="mil-love-btn like-btn" data-id="{{ $content->id }}">
                                @if ($content->is_liked)
                                    <i class="fas fa-heart"></i>
                                @else
                                    <i class="far fa-heart"></i>
                                @endif
                            </button>
                            <button class="mil-download-btn" data-href="{{ route('image.download', $content->id) }}">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                        <img src="{{ route('image', $content->photo) }}" class="w-100 shadow-1-strong rounded"
                            alt="Photo" data-modal-target="modal-content" data-id="{{ $content->id }}" />
                        <div class="image-profile">
                            <img src="{{ $content->user['photo'] ? asset('storage/profile_photos/' . $content->user['photo']) : asset('img/icons/user-elipse.svg') }}"
                                alt="Profile Picture" class="mil-profile-img" />
                            <p class="mil-username">{{ $content->user['name'] ?? 'anonymous' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-lg-4 col-md-4 mb-4 col-sm-4 mb-lg-0 px-sm-2">
                @foreach ($contents[2] as $content)
                    <div class="content-item mil-up position-relative">
                        <div class="mil-buttons">
                            <button class="mil-love-btn like-btn" data-id="{{ $content->id }}">
                                @if ($content->is_liked)
                                    <i class="fas fa-heart"></i>
                                @else
                                    <i class="far fa-heart"></i>
                                @endif
                            </button>
                            <button class="mil-download-btn" data-href="{{ route('image.download', $content->id) }}">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                        <img src="{{ route('image', $content->photo) }}" class="w-100 shadow-1-strong rounded"
                            alt="Photo" data-modal-target="modal-content" data-id="{{ $content->id }}" />
                        <div class="image-profile">
                            <img src="{{ $content->user['photo'] ? asset('storage/profile_photos/' . $content->user['photo']) : asset('img/icons/user-elipse.svg') }}"
                                alt="Profile Picture" class="mil-profile-img" />
                            <p class="mil-username">{{ $content->user['name'] ?? 'anonymous' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        <div class="tab-content users-content" id="users">
            <div class="users__list">
                @forelse ($users as $user)
                    <a href="{{ route('user.profile', $user->id) }}" class="users__list--link">
                        <div class="users__item">
                            <div class="users__item--photo">
                                <img src="{{ $user->photo ? asset('storage/profile_photos/' . $user->photo) : asset('img/icons/user-elipse.svg') }}"
                                    alt="Users Item Profile Photo">
                            </div>
                            <div class="users__item--identity">
                                <p class="users__item--username">{{ $user->username }}</p>
                                <p class="users__item--fullname">
                                    {{ $user->name }} <span class="dot">·</span>
                                    <strong>{{ $user->followers_count }} <span>Followers</span></strong>
                                </p>
                                <p class="users__item--bio">{{ $user->bio ?? 'No bio' }}</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="px-3">No users found for "{{ $search }}"</p>
                @endforelse
            </div>
        </div>


    </div>
    <!-- content -->

    @include('components.modal-content')

    <button id="scrollToTopBtn" class="scroll-to-top" title="Go to top">
        ↑
    </button>

@endsection

@section('scripts')
    <script src="{{ asset('js/misc.js') }}"></script>
    <script src="{{ asset('js/scrollToTop.js') }}"></script>
    <script>
        document.querySelectorAll('.tab-btn').forEach(button => {
            button.addEventListener('click', () => {
                document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));

                button.classList.add('active');
                const targetTab = button.getAttribute('data-tab');

                document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));


                document.getElementById(targetTab).classList.add('active');
            });
        });
    </script>

@endsection
