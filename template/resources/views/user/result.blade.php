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
    <h3>Showing result for <span>Bromo</span></h3>
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
      <img src="{{ Vite::asset('resources/img/icons/multi-image.svg') }}" alt="multiple image">Photos 12
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
      <div class="content-item mil-up position-relative">
      <div class="mil-buttons">
        <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
        <button class="mil-download-btn"><i class="fas fa-download"></i></button>
      </div>
      <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp"
        class="w-100 shadow-1-strong rounded" alt="Boat on Calm Water" />
      <div class="image-profile">
        <img src="img/icons/user-elipse.svg" alt="Profile Picture" class="mil-profile-img" />
        <p class="mil-username">PixaVault</p>
      </div>
      </div>

      <div class="content-item mil-up position-relative">
      <div class="mil-buttons">
        <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
        <button class="mil-download-btn"><i class="fas fa-download"></i></button>
      </div>
      <img src="https://mdbcdn.b-cdn.net/img/Photos/Vertical/mountain1.webp" class="w-100 shadow-1-strong rounded"
        alt="Wintry Mountain Landscape" />
      <div class="image-profile">
        <img src="img/icons/user-elipse.svg" alt="Profile Picture" class="mil-profile-img" />
        <p class="mil-username">PixaVault</p>
      </div>
      </div>

      <div class="content-item mil-up position-relative">
      <div class="mil-buttons">
        <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
        <button class="mil-download-btn"><i class="fas fa-download"></i></button>
      </div>
      <img src="https://mdbcdn.b-cdn.net/img/Photos/Thumbnails/Vertical/1.webp" class="w-100 shadow-1-strong rounded"
        alt="Wintry Mountain Landscape" />
      <div class="image-profile">
        <img src="img/icons/user-elipse.svg" alt="Profile Picture" class="mil-profile-img" />
        <p class="mil-username">PixaVault</p>
      </div>
      </div>
    </div>

    <div class="col-lg-4 mb-4 mb-lg-0">
      <div class="content-item mil-up position-relative">
      <div class="mil-buttons">
        <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
        <button class="mil-download-btn"><i class="fas fa-download"></i></button>
      </div>
      <img src="https://mdbcdn.b-cdn.net/img/Photos/Vertical/mountain2.webp" class="w-100 shadow-1-strong rounded"
        alt="Mountains in the Clouds" />
      <div class="image-profile">
        <img src="{{ Vite::asset('resources/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
        <p class="mil-username">PixaVault</p>
      </div>
      </div>

      <div class="content-item mil-up position-relative">
      <div class="mil-buttons">
        <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
        <button class="mil-download-btn"><i class="fas fa-download"></i></button>
      </div>
      <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp"
        class="w-100 shadow-1-strong rounded" alt="Boat on Calm Water" />
      <div class="image-profile">
        <img src="{{ Vite::asset('resources/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
        <p class="mil-username">PixaVault</p>
      </div>
      </div>

      <div class="content-item mil-up position-relative">
      <div class="mil-buttons">
        <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
        <button class="mil-download-btn"><i class="fas fa-download"></i></button>
      </div>
      <img src="https://mdbcdn.b-cdn.net/img/Photos/Thumbnails/Square/1.webp" class="w-100 shadow-1-strong rounded"
        alt="Boat on Calm Water" />
      <div class="image-profile">
        <img src="{{ Vite::asset('resources/img/icons/user-elipse.svg') }}" alt="Profile Picture" class="mil-profile-img" />
        <p class="mil-username">PixaVault</p>
      </div>
      </div>
    </div>

    <div class="col-lg-4 mb-4 mb-lg-0">
      <div class="content-item mil-up position-relative">
      <div class="mil-buttons">
        <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
        <button class="mil-download-btn"><i class="fas fa-download"></i></button>
      </div>
      <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(18).webp"
        class="w-100 shadow-1-strong rounded" alt="Waves at Sea" />
      <div class="image-profile">
        <img src="img/icons/user-elipse.svg" alt="Profile Picture" class="mil-profile-img" />
        <p class="mil-username">PixaVault</p>
      </div>
      </div>

      <div class="content-item mil-up position-relative">
      <div class="mil-buttons">
        <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
        <button class="mil-download-btn"><i class="fas fa-download"></i></button>
      </div>
      <img src="https://mdbcdn.b-cdn.net/img/Photos/Thumbnails/Slides/1.webp" class="w-100 shadow-1-strong rounded"
        alt="Waves at Sea" />
      <div class="image-profile">
        <img src="img/icons/user-elipse.svg" alt="Profile Picture" class="mil-profile-img" />
        <p class="mil-username">PixaVault</p>
      </div>
      </div>

      <div class="content-item mil-up position-relative">
      <div class="mil-buttons">
        <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
        <button class="mil-download-btn"><i class="fas fa-download"></i></button>
      </div>
      <img src="https://mdbcdn.b-cdn.net/img/Photos/Vertical/mountain3.webp" class="w-100 shadow-1-strong rounded"
        alt="Yosemite National Park" />
      <div class="image-profile">
        <img src="img/icons/user-elipse.svg" alt="Profile Picture" class="mil-profile-img" />
        <p class="mil-username">PixaVault</p>
      </div>
      </div>
    </div>
    </div>
    <div class="tab-content" is="users"></div>
    <!-- Gallery -->
  </div>
  <!-- content -->
@endsection
@vite(['resources/js/profile.js'])