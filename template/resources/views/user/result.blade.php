@extends('templates.user')

@section('styles')
  @vite('resources/css/result.css')
@endsection

@section('navbar')
  @include('components.navbar-white')
@endsection

@section('content')
  <!-- content -->
  <div class="container">
    <h3>Showing result for <span>{{$search}}</span></h3>
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
      <img src="{{ Vite::asset('resources/img/icons/multi-image.svg') }}" alt="multiple image">Photos <span>{{ count($contents) }}</span>
      </button>
      <button class="tab-btn" data-tab="users">
      <img src="{{ Vite::asset('resources/img/icons/people.svg') }}" alt="multiple image">Users 3
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
                        <div class="content-item mil-up position-relative"
                            data-modal-target="modal-content" data-id="{{ $content->id }}">
                            <div class="mil-buttons">
                                <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
                                <button class="mil-download-btn"><i class="fas fa-download"></i></button>
                            </div>
                            <img src="{{ $content->photo }}" class="w-100 shadow-1-strong rounded" alt="Boat on Calm Water" />
                            <div class="image-profile">
                                <img src="{{ $content->user['photo'] ?? Vite::asset('resource/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
                                <p class="mil-username">{{ $content->user['name'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-lg-4 mb-4 mb-lg-0">
                    @foreach ($contents[1] as $content)
                        <div class="content-item mil-up position-relative"
                            data-modal-target="modal-content" data-id="{{ $content->id }}">
                            <div class="mil-buttons">
                                <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
                                <button class="mil-download-btn"><i class="fas fa-download"></i></button>
                            </div>
                            <img src="{{ $content->photo }}" class="w-100 shadow-1-strong rounded" alt="Boat on Calm Water" />
                            <div class="image-profile">
                                <img src="{{ $content->user['photo'] ?? Vite::asset('resource/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
                                <p class="mil-username">{{ $content->user['name'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-lg-4 mb-4 mb-lg-0">
                    @foreach ($contents[2] as $content)
                        <div class="content-item mil-up position-relative"
                            data-modal-target="modal-content" data-id="{{ $content->id }}">
                            <div class="mil-buttons">
                                <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
                                <button class="mil-download-btn"><i class="fas fa-download"></i></button>
                            </div>
                            <img src="{{ $content->photo }}" class="w-100 shadow-1-strong rounded" alt="Boat on Calm Water" />
                            <div class="image-profile">
                                <img src="{{ $content->user['photo'] ?? Vite::asset('resource/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
                                <p class="mil-username">{{ $content->user['name'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
    
    </div>
    <div class="tab-content" is="users"></div>
    <!-- Gallery -->
  </div>
  <!-- content -->
@endsection
<!-- @vite(['resources/js/profile.js']) -->