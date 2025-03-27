@extends('templates.user')

@section('title', 'Profile')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('navbar')
    @include('components.navbar-black')
@endsection

@section('content')
    
    <div class="profile-banner">
        <div class="profile-detail d-flex align-items-center">
            <div class="profile-image d-flex align-items-center">
                <img src="{{ asset('/img/icons/user-elipse.svg') }}" alt="user">
            </div>
            <div class="profile-info d-flex flex-column">
                <div class="profile-header d-flex">
                    <h3 class="role-own-profile">
                        {{ $user->name }}
                    </h3>
                    <div class="profile-actions d-flex">
                        <div class="d-flex align-items-center role-other-user d-none">
                            <button id="button-follow" class="btn-follow">Follow</button>
                            <button class="btn-options"><img src="{{ asset('/img/icons/horiz-dots.svg') }}" alt=""></button>
                            <button class="btn-report d-none">Report</button>
                        </div>
                        <div class="d-flex align-items-center role-own-profile">
                            <a href="{{ route('profile.edit') }}"><button class="btn-edit-profile"><img src="{{ asset('/img/icons/edit-pen.svg') }}" alt="">Edit Profile</button></a>
                        </div>
                    </div>
                </div>
                <p class="profile-email">
                    {{ $user->email }}
                </p>
                <p class="profile-bio">
                    {{ $user->bio }}
                </p>
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
            <button class="tab-btn role-own-profile" data-tab="stats">
                <img src="{{ asset('/img/icons/stats.svg') }}" alt="stats">Stats
            </button>
        </div>
        <div class="tab-content-container">
            <div class="tab-content active" id="photos">

                @if (count($contents[0]))
                    <div class="row">
                        <div class="col-lg-4 col-md-4 mb-4 col-sm-4 mb-lg-0 px-sm-2">
                            @foreach ($contents[0] as $content)
                                <div class="content-item mil-up position-relative" 
                                    data-modal-target="modal-detail" data-id="{{ $content->id }}">
                                    <div class="mil-buttons">
                                        <p class="mil-card-title"><span>Uploaded At</span> {{ date('d/m/y', strtotime($content->created_at)) }}</p>
                                    </div>
                                    <img src="{{ route('image', $content->photo) }}" class="w-100 shadow-1-strong rounded" alt="Photo" />
                                    <div class="image-profile">
                                        <p class="mil-card-subtitle">{{ $content->name }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
        
                        <div class="col-lg-4 col-md-4 mb-4 col-sm-4 mb-lg-0 px-sm-2">
                            @foreach ($contents[1] as $content)
                                <div class="content-item mil-up position-relative" 
                                    data-modal-target="modal-detail" data-id="{{ $content->id }}">
                                    <div class="mil-buttons">
                                        <p class="mil-card-title"><span>Uploaded At</span> {{ date('d/m/y', strtotime($content->created_at)) }}</p>
                                    </div>
                                    <img src="{{ route('image', $content->photo) }}" class="w-100 shadow-1-strong rounded" alt="Photo" />
                                    <div class="image-profile">
                                        <p class="mil-card-subtitle">{{ $content->name }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
        
                        <div class="col-lg-4 col-md-4 mb-4 col-sm-4 mb-lg-0 px-sm-2">
                            @foreach ($contents[2] as $content)
                                <div class="content-item mil-up position-relative" 
                                    data-modal-target="modal-detail" data-id="{{ $content->id }}">
                                    <div class="mil-buttons">
                                        <p class="mil-card-title"><span>Uploaded At</span> {{ date('d/m/y', strtotime($content->created_at)) }}</p>
                                    </div>
                                    <img src="{{ route('image', $content->photo) }}" class="w-100 shadow-1-strong rounded" alt="Photo" />
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
                                        <img src="{{ $content->user['photo'] ?? asset('/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
                                        <p class="mil-username">{{ $content->user['name'] ?? "anonymous" }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
        
                        <div class="col-lg-4 mb-4 mb-lg-0">
                            @foreach ($liked[1] as $content)
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
                                        <img src="{{ $content->user['photo'] ?? asset('/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
                                        <p class="mil-username">{{ $content->user['name'] ?? "anonymous" }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
        
                        <div class="col-lg-4 mb-4 mb-lg-0">
                            @foreach ($liked[2] as $content)
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
                                        <img src="{{ $content->user['photo'] ?? asset('/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
                                        <p class="mil-username">{{ $content->user['name'] ?? "anonymous" }}</p>
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
            <div class="tab-content tab-content-stats role-own-profile" id="stats">
                <h4>Insights</h4>
                <div class="tab-content-stats-diagram d-flex flex-wrap justify-content-between">
                    <div class="card">
                        <div class="header">
                            <div class="d-flex flex-column align-items-start">
                                <h3>Views</h3>
                                <h1 id="view-count">2,313</h1>
                            </div>
                            <select class="dropdown tab-content-stats-dropdown" name="time" id="timeViewFilter">
                                <option value="weekly">Weekly</option>
                                <option value="monthly">Monthly</option>
                                <option value="yearly">Yearly</option>
                            </select>
                        </div>
                        <canvas id="viewsChart" height="200px"></canvas>
                    </div>
                    <div class="card">
                        <div class="header">
                            <div class="d-flex flex-column align-items-start">
                                <h3>Downloads</h3>
                                <h1 id="download-count">512</h1>
                            </div>
                            <select class="dropdown tab-content-stats-dropdown" name="time" id="timeDownloadFilter">
                                <option value="weekly">Weekly</option>
                                <option value="monthly">Monthly</option>
                                <option value="yearly">Yearly</option>
                            </select>
                        </div>
                        <canvas id="downloadsChart" height="200px"></canvas>
                    </div>
                </div>
                <h4>Badge</h4>
                <div class="card badge-card">
                    <div class="badge-card-header">
                        <p>Achievements</p>
                        <div>3</div>
                    </div>
                    <div class="badge-card-achievements">
                        <div class="badge-card-achievements-icon">
                            <img src="{{ asset('/img/icons/achievement-icon-1.svg') }}" alt="achievement-icon-1">
                            <p>Top Like February 2025</p>
                        </div>
                        <div class="badge-card-achievements-icon">
                            <img src="{{ asset('/img/icons/achievement-icon-2.svg') }}" alt="achievement-icon-2">
                            <p>Top Download February 2025</p>
                        </div>
                        <div class="badge-card-achievements-icon">
                            <img src="{{ asset('/img/icons/achievement-icon-3.svg') }}" alt="achievement-icon-3">
                            <p>Top Like March 2025</p>
                        </div>
                    </div>
                </div>
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
