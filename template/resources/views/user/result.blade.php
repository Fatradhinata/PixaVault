@extends('templates.user')

@section('title', 'Search')

@section('styles')
    @vite('resources/css/result.css')
@endsection

@section('navbar')
    @include('components.navbar-black')
@endsection

@section('content')
    <!-- content -->
    <div class="container">
        <h3>Showing result for <b>"{{ $search }}"</b></h3>

        <div class="tag-row">
            <button>Natures</button>
            <button>Bromo</button>
            <button>Indonesia</button>
            <button>Mountain</button>
            <button>Outdoor</button>
            <button>East java</button>
        </div>

        <div class="tab-header">
            <div class="tab-nav">
                <button class="tab-btn active" data-tab="photos">
                    <img src="{{ Vite::asset('resources/img/icons/multi-image.svg') }}" alt="multiple image">
                    Photos <b>{{ count(array_merge($contents[0], $contents[1], $contents[2])) }}</b>
                </button>
                <button class="tab-btn" data-tab="users">
                    <img src="{{ Vite::asset('resources/img/icons/people.svg') }}" alt="multiple image"
                    >Users 3
                </button>
            </div>
            <div class="filter-wrapper">
                <p>Sort by :</p>
                <select class="dropdown select-sort">
                    <option value="newest">Newest</option>
                    <option value="oldest">Oldest</option>
                    <option value="highest-resolution">Highest Resolution</option>
                    <option value="lowest-resolution">Lowest Resolution</option>
                </select>
            </div>
        </div>
        <!-- Gallery -->
        <div class="row tab-content active" id="photos">
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
                            data-modal-target="modal-content" data-id="{{ $content->id }}" />
                        <div class="image-profile">
                            <img src="{{ $content->user['photo'] ?? Vite::asset('resources/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
                            <p class="mil-username">{{ $content->user['name'] ?? 'anonymous' }}</p>
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
                            data-modal-target="modal-content" data-id="{{ $content->id }}" />
                        <div class="image-profile">
                            <img src="{{ $content->user['photo'] ?? Vite::asset('resources/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
                            <p class="mil-username">{{ $content->user['name'] ?? 'anonymous' }}</p>
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
                            data-modal-target="modal-content" data-id="{{ $content->id }}" />
                        <div class="image-profile">
                            <img src="{{ $content->user['photo'] ?? Vite::asset('resources/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
                            <p class="mil-username">{{ $content->user['name'] ?? 'anonymous' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        <div class="tab-content" is="users">

        </div>
        
    </div>
    <!-- content -->

    @include('components.modal-content')

@endsection

@section('scripts')
    @vite('resources/js/misc.js')
@endsection
