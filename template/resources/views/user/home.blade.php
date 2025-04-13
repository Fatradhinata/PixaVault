@extends('templates.user')

@section('title', 'Home')

@section('navbar')
    @include('components.navbar')
@endsection

@section('content')
    <!-- banner -->
    <section class="mil-banner">
        <img src="{{ asset('img/foto/jan-derungs-XMwAnYLHShE-unsplash.jpg') }}" class="mil-bg-img mil-scale" data-value-1=".4"
            data-value-2="1.4" alt="image" loading="lazy" />

        <div class="mil-overlay"></div>

        <div class="container">
            <div class="mil-banner-content">
                <div class="row align-items-end">
                    <div class="col-xl-7">
                        <div class="mil-mb-90">
                            <h1 class="mil-upper mil-light mil-mb-60">
                                Unlocking<br /><span class="mil-accent">the Future</span><br />of Digital Assets
                            </h1>
                            <div class="mil-sidebar-search mil-up mil-mb-30" id="search-input">
                                <input type="text" placeholder="Search images..." />
                                <button>
                                    <img src="{{ asset('img/icons/13.svg') }}" alt="search" loading="lazy" />
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5">
                        <div class="row mil-mb-60">
                            <div class="col-6">
                                <div class="mil-counter-frame mil-light mil-mb-30">
                                    <h4 class="mil-accent mil-thin mil-mb-10">
                                        <span>High-Quality</span>
                                    </h4>
                                    <p class="mil-light">Images</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mil-counter-frame mil-light mil-mb-30">
                                    <h4 class="mil-accent mil-thin mil-mb-10">
                                        <span>Join</span>
                                    </h4>
                                    <p class="mil-light">Our First Creators</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mil-counter-frame mil-light mil-mb-30">
                                    <h4 class="mil-accent mil-thin mil-mb-10">
                                        <span>New & Growing</span>
                                    </h4>
                                    <p class="mil-light">Community</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mil-counter-frame mil-light mil-mb-30">
                                    <h4 class="mil-accent mil-thin mil-mb-10">
                                        <span>Built </span>
                                    </h4>
                                    <p class="mil-light">for the Future</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trending Image -->
    <section>
        <div class="container mil-p-120-120">
            <div class="mil-background-grid mil-softened"></div>

            <div class="row">
                <div class="col-12 mb-15">
                    <div class="mil-center mil-mb-90">
                        <span class="mil-suptitle mil-upper mil-up mil-mb-30">Insights</span>
                        <h2 class="mil-upper mil-up mil-mb-30">Trending Images</h2>
                        <a href="{{ 'trending' }}" class="mil-link mil-upper mil-up">See All
                            <span class="mil-arrow"><img src="{{ asset('img/icons/1.svg') }}" loading="lazy"
                                    alt="arrow" /></span></a>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 mb-4 col-sm-4 mb-lg-0 px-sm-2">
                            @foreach ($trending[0] as $content)
                                <div class="content-item mil-up position-relative">
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
                                    <img src="{{ route('image', $content->photo) }}" class="w-100 shadow-1-strong rounded"
                                        height="300px" alt="Photo" data-modal-target="modal-content"
                                        data-id="{{ $content->id }}" />
                                    <div class="image-profile">
                                        <img src="{{ $content->user['photo'] ? asset('storage/profile_photos/' . $content->user['photo']) : asset('img/icons/user-elipse.svg') }}"
                                            alt="Profile Picture" class="mil-profile-img" />
                                        <p class="mil-username">{{ $content->user['name'] ?? 'anonymous' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-lg-4 col-md-4 mb-4 col-sm-4 mb-lg-0 px-sm-2">
                            @foreach ($trending[1] as $content)
                                <div class="content-item mil-up position-relative">
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
                                    <img src="{{ route('image', $content->photo) }}" class="w-100 shadow-1-strong rounded"
                                        height="300px" alt="Photo" data-modal-target="modal-content"
                                        data-id="{{ $content->id }}" />
                                    <div class="image-profile">
                                        <img src="{{ $content->user['photo'] ? asset('storage/profile_photos/' . $content->user['photo']) : asset('img/icons/user-elipse.svg') }}"
                                            alt="Profile Picture" class="mil-profile-img" />
                                        <p class="mil-username">{{ $content->user['name'] ?? 'anonymous' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-lg-4 col-md-4 mb-4 col-sm-4 mb-lg-0 px-sm-2">
                            @foreach ($trending[2] as $content)
                                <div class="content-item mil-up position-relative">
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
                                        class="w-100 shadow-1-strong rounded" alt="Photo"
                                        data-modal-target="modal-content" height="300px"
                                        data-id="{{ $content->id }}" />
                                    <div class="image-profile">
                                        <img src="{{ $content->user['photo'] ? asset('storage/profile_photos/' . $content->user['photo']) : asset('img/icons/user-elipse.svg') }}"
                                            alt="Profile Picture" class="mil-profile-img" />
                                        <p class="mil-username">{{ $content->user['name'] ?? 'anonymous' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Explore Image -->
    <section>
        <div class="container mil-p-120-120">
            <div class="mil-background-grid mil-softened"></div>

            <div class="row">
                <div class="col-12 mb-15">
                    <div class="mil-center mil-mb-90">
                        <a href="{{ 'explore' }}"><span
                                class="mil-suptitle mil-upper mil-up mil-mb-30">EXPLORE</span></a>
                        <h2 class="mil-upper mil-up">FRAME BY FRAME DISCOVERY</h2>
                        <p class="mil-mb-30">
                            Dive into a world of creativity with handpicked collections tailored to your interests.
                        </p>
                        <a href="{{ 'explore' }}" class="mil-link mil-upper mil-up">See All
                            <span class="mil-arrow"><img src="{{ asset('img/icons/1.svg') }}"
                                    alt="arrow" /></span></a>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 mb-4 col-sm-4 mb-lg-0 px-sm-2">
                            @foreach ($explore[0] as $content)
                                <div class="content-item mil-up position-relative">
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
                                        class="w-100 shadow-1-strong rounded" alt="Photo"
                                        data-modal-target="modal-content" data-id="{{ $content->id }}" />
                                    <div class="image-profile">
                                        <img src="{{ $content->user['photo'] ? asset('storage/profile_photos/' . $content->user['photo']) : asset('img/icons/user-elipse.svg') }}"
                                            alt="Profile Picture" class="mil-profile-img" />
                                        <p class="mil-username">{{ $content->user['name'] ?? 'anonymous' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-lg-4 col-md-4 mb-4 col-sm-4 mb-lg-0 px-sm-2">
                            @foreach ($explore[1] as $content)
                                <div class="content-item mil-up position-relative">
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
                                        class="w-100 shadow-1-strong rounded" alt="Photo"
                                        data-modal-target="modal-content" data-id="{{ $content->id }}" />
                                    <div class="image-profile">
                                        <img src="{{ $content->user['photo'] ? asset('storage/profile_photos/' . $content->user['photo']) : asset('img/icons/user-elipse.svg') }}"
                                            alt="Profile Picture" class="mil-profile-img" />
                                        <p class="mil-username">{{ $content->user['name'] ?? 'anonymous' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-lg-4 col-md-4 mb-4 col-sm-4 mb-lg-0 px-sm-2">
                            @foreach ($explore[2] as $content)
                                <div class="content-item mil-up position-relative">
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
                                        class="w-100 shadow-1-strong rounded" alt="Photo"
                                        data-modal-target="modal-content" data-id="{{ $content->id }}" />
                                    <div class="image-profile">
                                        <img src="{{ $content->user['photo'] ? asset('storage/profile_photos/' . $content->user['photo']) : asset('img/icons/user-elipse.svg') }}"
                                            alt="Profile Picture" class="mil-profile-img" />
                                        <p class="mil-username">{{ $content->user['name'] ?? 'anonymous' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('components.modal-content')

@endsection

@section('scripts')
    <script src="{{ asset('js/misc.js') }}"></script>
@endsection
