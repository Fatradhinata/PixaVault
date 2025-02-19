@extends('templates.user')

@section('title', 'Explore')

@section('styles')
    @vite('resources/css/explore.css')
@endsection

@section('navbar')
    @include('components.navbar-black')
@endsection

@section('content')
    <!-- content -->
    <div class="container-fluid">
        <div class="header">
            <h3 style="font-weight: 400;">Discover the best of <b>Pixavault</b></h3>
            <p>Discover a curated collection of high-definition photos</p>
        </div>
        <div class="tag-wrapper">
            <h4>Trending Tag</h4>
            <div class="tag-row">
                <button>Natures</button>
                <button>Bromo</button>
                <button>Indonesia</button>
                <button>Mountain</button>
                <button>Outdoor</button>
                <button>East java</button>
            </div>
        </div>
        
        <!-- Gallery -->
        <div class="row core-content">
            <h4>Fresh Images</h4>
            <div class="row">
                <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
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
                            <img src="{{ route('image', $content->photo) }}" class="w-100 shadow-1-strong rounded" alt="Photo"
                                data-modal-target="modal-content" data-id="{{ $content->id }}"/>
                            <div class="image-profile">
                                <img src="{{ $content->user['photo'] ?? Vite::asset('resources/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
                                <p class="mil-username">{{ $content->user['name'] ?? "anonymous" }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-lg-4 mb-4 mb-lg-0">
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
                            <img src="{{ route('image', $content->photo) }}" class="w-100 shadow-1-strong rounded" alt="Photo"
                                data-modal-target="modal-content" data-id="{{ $content->id }}"/>
                            <div class="image-profile">
                                <img src="{{ $content->user['photo'] ?? Vite::asset('resources/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
                                <p class="mil-username">{{ $content->user['name'] ?? "anonymous" }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-lg-4 mb-4 mb-lg-0">
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
                            <img src="{{ route('image', $content->photo) }}" class="w-100 shadow-1-strong rounded" alt="Photo"
                                data-modal-target="modal-content" data-id="{{ $content->id }}"/>
                            <div class="image-profile">
                                <img src="{{ $content->user['photo'] ?? Vite::asset('resources/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
                                <p class="mil-username">{{ $content->user['name'] ?? "anonymous" }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- content -->

    @include('components.modal-content')
@endsection

@section('scripts')
    @vite('resources/js/misc.js')
@endsection