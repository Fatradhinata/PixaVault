@extends('templates.user')

@section('title', 'Trending')

@section('styles')
    @parent
    <link rel="stylesheet" href="{{ asset('css/trending.css') }}">
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
    
    <div class="container">

        <h3>TRENDING IMAGES</h3>

        <div class="tab-header">
            <button class="tab-btn active" data-tab="photos">
                <img src="{{ asset('img/icons/multi-image.svg') }}" alt="multiple image">
                Photos {{ count($contents[0])+count($contents[1])+count($contents[2]) }}
            </button>           
        </div>

        <div class="row">
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
                            <img src="{{ $content->user['photo'] ?? asset('/img/icons/user-elipse.svg') }}"
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
                            <img src="{{ $content->user['photo'] ?? asset('/img/icons/user-elipse.svg') }}"
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
                            <img src="{{ $content->user['photo'] ?? asset('/img/icons/user-elipse.svg') }}"
                                alt="Profile Picture" class="mil-profile-img" />
                            <p class="mil-username">{{ $content->user['name'] ?? 'anonymous' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('components.modal-content')

@endsection

@section('scripts')
    <script src="{{ asset('js/misc.js') }}"></script>
@endsection
@section('scripts')
    <script src="{{ asset('js/misc.js') }}"></script>
@endsection
