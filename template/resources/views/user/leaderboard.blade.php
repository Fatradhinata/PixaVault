@extends('templates.user')

@section('title', 'Leaderboard')

@section('styles')
    @vite('resources/css/leaderboard.css')
@endsection

@section('navbar')
    @include('components.navbar-white')
@endsection

@section('content')
    <!-- content -->
    <div id="content">
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
          <div class="leaderboard-row">
            <div class="user-detail">
              <h3>1</h3>
              <div class="user-detail-core">
                <img src="{{ Vite::asset('resources/img/faces/user.png') }}" alt="user">
                <div class="user-name">
                  <div>
                    <p class="username">Kelly Austin</p>
                    <p class="download-total">7K Likes</p>
                  </div>
                  <button>Follow</button>
                </div>
              </div>
            </div>
            <div class="user-content">
              <div>
                <img src="{{ Vite::asset('resources/img/foto/category/nature.jpg') }}" alt="">
              </div>
              <div>
                <img src="{{ Vite::asset('resources/img/foto/category/landscape.jpg') }}" alt="">
              </div>
              <div>
                <img src="{{ Vite::asset('resources/img/foto/category/urban-cityscape.jpg') }}" alt="">
              </div>
            </div>
          </div>
          <div class="leaderboard-row">
            <div class="user-detail">
              <h3>2</h3>
              <div class="user-detail-core">
                <img src="{{ Vite::asset('resources/img/faces/user.png') }}" alt="user">
                <div class="user-name">
                  <div>
                    <p class="username">Kelly Austin</p>
                    <p class="download-total">7K Likes</p>
                  </div>
                  <button>Follow</button>
                </div>
              </div>
            </div>
            <div class="user-content">
              <div>
                <img src="{{ Vite::asset('resources/img/foto/category/nature.jpg') }}" alt="">
              </div>
              <div>
                <img src="{{ Vite::asset('resources/img/foto/category/landscape.jpg') }}" alt="">
              </div>
              <div>
                <img src="{{ Vite::asset('resources/img/foto/category/urban-cityscape.jpg') }}" alt="">
              </div>
            </div>
          </div>
          <div class="leaderboard-row">
            <div class="user-detail">
              <h3>3</h3>
              <div class="user-detail-core">
                <img src="{{ Vite::asset('resources/img/faces/user.png') }}" alt="user">
                <div class="user-name">
                  <div>
                    <p class="username">Kelly Austin</p>
                    <p class="download-total">7K Likes</p>
                  </div>
                  <button>Follow</button>
                </div>
              </div>
            </div>
            <div class="user-content">
              <div>
                <img src="{{ Vite::asset('resources/img/foto/category/nature.jpg') }}" alt="">
              </div>
              <div>
                <img src="{{ Vite::asset('resources/img/foto/category/landscape.jpg') }}" alt="">
              </div>
              <div>
                <img src="{{ Vite::asset('resources/img/foto/category/urban-cityscape.jpg') }}" alt="">
              </div>
            </div>
          </div>
        </div>
        <div class="row tab-content" id="most-downloads">
          <div class="leaderboard-row">
            <div class="user-detail">
              <h3>1</h3>
              <div class="user-detail-core">
                <img src="{{ Vite::asset('resources/img/faces/user.png') }}" alt="user">
                <div class="user-name">
                  <div>
                    <p class="username">Kelly Austin</p>
                    <p class="download-total">7K Downloads</p>
                  </div>
                  <button>Follow</button>
                </div>
              </div>
            </div>
            <div class="user-content">
              <div>
                <img src="{{ Vite::asset('resources/img/foto/category/nature.jpg') }}" alt="">
              </div>
              <div>
                <img src="{{ Vite::asset('resources/img/foto/category/landscape.jpg') }}" alt="">
              </div>
              <div>
                <img src="{{ Vite::asset('resources/img/foto/category/urban-cityscape.jpg') }}" alt="">
              </div>
            </div>
          </div>
          <div class="leaderboard-row">
            <div class="user-detail">
              <h3>2</h3>
              <div class="user-detail-core">
                <img src="{{ Vite::asset('resources/img/faces/user.png') }}" alt="user">
                <div class="user-name">
                  <div>
                    <p class="username">Kelly Austin</p>
                    <p class="download-total">7K Downloads</p>
                  </div>
                  <button>Follow</button>
                </div>
              </div>
            </div>
            <div class="user-content">
              <div>
                <img src="{{ Vite::asset('resources/img/foto/category/nature.jpg') }}" alt="">
              </div>
              <div>
                <img src="{{ Vite::asset('resources/img/foto/category/landscape.jpg') }}" alt="">
              </div>
              <div>
                <img src="{{ Vite::asset('resources/img/foto/category/urban-cityscape.jpg') }}" alt="">
              </div>
            </div>
          </div>
          <div class="leaderboard-row">
            <div class="user-detail">
              <h3>3</h3>
              <div class="user-detail-core">
                <img src="{{ Vite::asset('resources/img/faces/user.png') }}" alt="user">
                <div class="user-name">
                  <div>
                    <p class="username">Kelly Austin</p>
                    <p class="download-total">7K Downloads</p>
                  </div>
                  <button>Follow</button>
                </div>
              </div>
            </div>
            <div class="user-content">
              <div>
                <img src="{{ Vite::asset('resources/img/foto/category/nature.jpg') }}" alt="">
              </div>
              <div>
                <img src="{{ Vite::asset('resources/img/foto/category/landscape.jpg') }}" alt="">
              </div>
              <div>
                <img src="{{ Vite::asset('resources/img/foto/category/urban-cityscape.jpg') }}" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- content -->
@endsection

@vite(['resources/js/leaderboard.js'])
