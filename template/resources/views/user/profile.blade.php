@extends('templates.user')

@section('title', 'Profile')

@section('styles')
    @parent
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('navbar')
    @include('components.navbar')
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

        .swal2-confirm-btn,
        .swal2-cancel-btn {
            font-family: 'Figtree', sans-serif !important;
        }
    </style>
@endsection

@section('content')

    <div class="profile-banner">
        <div class="profile-detail d-flex align-items-center">
            <div class="preview-image-container">
                <img class="preview-image"
                    src="{{ $user->photo ? asset('storage/profile_photos/' . $user->photo) : asset('img/icons/user-elipse.svg') }}"
                    alt="User Profile">
            </div>
            <div class="profile-info d-flex flex-column">
                <div class="profile-header d-flex">
                    <h3>
                        {{ $user->name }}
                    </h3>
                    <div class="profile-actions d-flex">
                        @if ($user->id == Auth::user()->id)
                            <div class="d-flex align-items-center">
                                <a href="{{ route('profile.edit') }}">
                                    <button class="btn-edit-profile">
                                        <img src="{{ asset('/img/icons/edit-pen.svg') }}" alt="Edit Pen"> Edit Profile
                                    </button>
                                </a>
                            </div>
                        @else
                            <div class="d-flex align-items-center">
                                @php
                                    $isFollowing = Auth::user()->following->contains($user->id);
                                @endphp

                                <button id="button-follow" class="{{ $isFollowing ? 'btn-followed' : 'btn-follow' }}"
                                    data-user-id="{{ $user->id }}">
                                    {{ $isFollowing ? 'Followed' : 'Follow' }}
                                </button>

                                <div class="relative">
                                    <button class="option-btn dropdown-toggle">
                                        <img src="{{ asset('img/icons/horiz-dots-variant-2.svg') }}" alt="">
                                    </button>

                                    <!-- Dropdown menu -->
                                    <div
                                        class="dropdown-report hidden absolute right-0 mt-2 w-40 bg-white border border-gray-300 rounded shadow-md">
                                        <p class="block px-4 py-2 text-gray-800 hover:bg-gray-200 report-btn user-report"
                                            data-modal-target="modal-report" data-id-user="{{ $user->id }}">
                                            Report User
                                        </p>
                                    </div>

                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <p class="profile-email">
                    {{ $user->email }}
                </p>
                <p class="profile-bio collapsed" id="profileBio">
                    {{ $user->bio }}
                </p>
                <a href="#" id="toggleBio" class="view-more d-none">View more...</a>
            </div>
        </div>
    </div>

    <div class="profile-content">
        <div class="profile-tab-nav">
            <button class="tab-btn active" data-tab="photos">
                <img src="{{ asset('/img/icons/multi-image.svg') }}" alt="multiple image">
                Photos {{ array_sum(array_map('count', $contents)) }}
            </button>
            <button class="tab-btn" data-tab="likes">
                <img src="{{ asset('/img/icons/love-black.svg') }}" alt="likes">
                Likes {{ array_sum(array_map('count', $liked)) }}
            </button>            
        </div>
        <div class="tab-content-container">
            <div class="tab-content active" id="photos">

                @if (count($contents[0]))
                    <div class="row">
                        <div class="col-lg-4 col-md-4 mb-4 col-sm-4 mb-lg-0 px-sm-2">
                            @foreach ($contents[0] as $content)
                                <div class="content-item mil-up position-relative" data-modal-target="modal-detail"
                                    data-id="{{ $content->id }}">
                                    <div class="mil-buttons">
                                        <p class="mil-card-title"><span>Uploaded At</span>
                                            {{ date('d/m/y', strtotime($content->created_at)) }}</p>
                                    </div>
                                    <img src="{{ route('image', $content->photo) }}" class="w-100 shadow-1-strong rounded"
                                        alt="Photo" loading="lazy" />
                                    <div class="image-profile">
                                        <p class="mil-card-subtitle">{{ $content->name }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-lg-4 col-md-4 mb-4 col-sm-4 mb-lg-0 px-sm-2">
                            @foreach ($contents[1] as $content)
                                <div class="content-item mil-up position-relative" data-modal-target="modal-detail"
                                    data-id="{{ $content->id }}">
                                    <div class="mil-buttons">
                                        <p class="mil-card-title"><span>Uploaded At</span>
                                            {{ date('d/m/y', strtotime($content->created_at)) }}</p>
                                    </div>
                                    <img src="{{ route('image', $content->photo) }}" class="w-100 shadow-1-strong rounded"
                                        alt="Photo" loading="lazy" />
                                    <div class="image-profile">
                                        <p class="mil-card-subtitle">{{ $content->name }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-lg-4 col-md-4 mb-4 col-sm-4 mb-lg-0 px-sm-2">
                            @foreach ($contents[2] as $content)
                                <div class="content-item mil-up position-relative" data-modal-target="modal-detail"
                                    data-id="{{ $content->id }}">
                                    <div class="mil-buttons">
                                        <p class="mil-card-title"><span>Uploaded At</span>
                                            {{ date('d/m/y', strtotime($content->created_at)) }}</p>
                                    </div>
                                    <img src="{{ route('image', $content->photo) }}" class="w-100 shadow-1-strong rounded"
                                        alt="Photo" loading="lazy" />
                                    <div class="image-profile">
                                        <p class="mil-card-subtitle">{{ $content->name }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                @else
                    <div class="unavailable d-flex flex-column align-items-center ">
                        <img src="{{ asset('/img/icons/frowning-face.svg') }}" alt="frowning-face">
                        <h3>This user has not uploaded any photos</h3>
                    </div>
                @endif

            </div>
            <div class="tab-content" id="likes">

                @if (count($liked[0]))
                    <div class="row">
                        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                            @foreach ($liked[0] as $content)
                                <div class="content-item mil-up position-relative" data-modal-target="modal-content"
                                    data-id="{{ $content->id }}">
                                    <div class="mil-buttons">
                                        <button class="mil-love-btn like-btn" data-id="{{ $content->id }}">
                                            @if ($content->is_liked)
                                                <i class="fas fa-heart"></i>
                                            @else
                                                <i class="far fa-heart"></i>
                                            @endif
                                        </button>
                                        <button class="mil-download-btn"
                                            data-href="{{ route('image.download', $content->id) }}">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </div>
                                    <img src="{{ route('image', $content->photo) }}"
                                        class="w-100 shadow-1-strong rounded" alt="Photo" loading="lazy" />
                                    <div class="image-profile">
                                        <img src="{{ $content->user['photo'] ?? asset('/img/icons/user-elipse.svg') }}"
                                            alt="Profile Picture" class="mil-profile-img" />
                                        <p class="mil-username">{{ $content->user['name'] ?? 'anonymous' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-lg-4 mb-4 mb-lg-0">
                            @foreach ($liked[1] as $content)
                                <div class="content-item mil-up position-relative" data-modal-target="modal-content"
                                    data-id="{{ $content->id }}">
                                    <div class="mil-buttons">
                                        <button class="mil-love-btn like-btn" data-id="{{ $content->id }}">
                                            @if ($content->is_liked)
                                                <i class="fas fa-heart"></i>
                                            @else
                                                <i class="far fa-heart"></i>
                                            @endif
                                        </button>
                                        <button class="mil-download-btn"
                                            data-href="{{ route('image.download', $content->id) }}">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </div>
                                    <img src="{{ route('image', $content->photo) }}"
                                        class="w-100 shadow-1-strong rounded" alt="Photo" loading="lazy" />
                                    <div class="image-profile">
                                        <img src="{{ $content->user['photo'] ?? asset('/img/icons/user-elipse.svg') }}"
                                            alt="Profile Picture" class="mil-profile-img" />
                                        <p class="mil-username">{{ $content->user['name'] ?? 'anonymous' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-lg-4 mb-4 mb-lg-0">
                            @foreach ($liked[2] as $content)
                                <div class="content-item mil-up position-relative" data-modal-target="modal-content"
                                    data-id="{{ $content->id }}">
                                    <div class="mil-buttons">
                                        <button class="mil-love-btn like-btn" data-id="{{ $content->id }}">
                                            @if ($content->is_liked)
                                                <i class="fas fa-heart"></i>
                                            @else
                                                <i class="far fa-heart"></i>
                                            @endif
                                        </button>
                                        <button class="mil-download-btn"
                                            data-href="{{ route('image.download', $content->id) }}">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </div>
                                    <img src="{{ route('image', $content->photo) }}"
                                        class="w-100 shadow-1-strong rounded" alt="Photo" loading="lazy" />
                                    <div class="image-profile">
                                        <img src="{{ $content->user['photo'] ?? asset('/img/icons/user-elipse.svg') }}"
                                            alt="Profile Picture" class="mil-profile-img" />
                                        <p class="mil-username">{{ $content->user['name'] ?? 'anonymous' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                @else
                    <div class="unavailable d-flex flex-column align-items-center ">
                        <img src="{{ asset('/img/icons/frowning-face.svg') }}" alt="frowning-face">
                        <h3>This user has not liked any photos</h3>
                    </div>
                @endif

            </div>
        </div>
    </div>

    @include('components.modal-detail')
    @include('components.modal-content')

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/misc.js') }}"></script>
    <script src="{{ asset('js/profile.js') }}"></script>
@endsection
