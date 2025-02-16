@extends('templates.user')
@section('title', 'Leaderboard | PixaVault')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/leaderboard.css') }}" />
@endsection

@section('navbar')
    @include('templates.white-navbar')
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
@section('scripts')
<script>
        // Menonaktifkan klik kanan pada elemen gambar
        document.querySelectorAll("img").forEach((img) => {
          img.addEventListener("contextmenu", (event) => {
            event.preventDefault(); // Mencegah menu konteks default
            alert("Fitur penyimpanan gambar telah dinonaktifkan!");
          });
        });
      </script>

      <!-- js modal photo -->
      <script>
        // Get elements
        const photoTrigger = document.getElementById("photo-trigger");
        const photoModal = document.getElementById("photo-modal");
        const closeModal = document.getElementById("close-modal");

        // Show modal on click
        photoTrigger.addEventListener("click", (e) => {
          e.preventDefault();
          photoModal.style.display = "flex";
        });

        // Hide modal on close button
        closeModal.addEventListener("click", () => {
          photoModal.style.display = "none";
        });

        // Hide modal on outside click
        window.addEventListener("click", (e) => {
          if (e.target === photoModal) {
            photoModal.style.display = "none";
          }
        });
      </script>

      <script>
        document.addEventListener("DOMContentLoaded", function () {
          const searchInput = document.querySelector(".mil-sidebar-search input");
          const searchButton = document.querySelector(
            ".mil-sidebar-search button"
          );

          searchButton.addEventListener("click", function () {
            let query = searchInput.value.trim(); // Ambil teks input
            if (query) {
              alert("Mencari: " + query);
              // window.location.href = `search.html?q=${encodeURIComponent(query)}`;
            } else {
              alert("Masukkan kata kunci pencarian!");
            }
          });

          // Jika tekan Enter dalam input, pencarian juga bisa berjalan
          searchInput.addEventListener("keypress", function (event) {
            if (event.key === "Enter") {
              searchButton.click();
            }
          });
        });
      </script>

      <!-- js random images -->
      <script>
        document.addEventListener("DOMContentLoaded", function () {
          // Ambil semua elemen dengan kelas .mil-randomimage
          const randomImageElements =
            document.querySelectorAll(".mil-randomimage");

          randomImageElements.forEach((imgElement) => {
            // Mengambil gambar acak dari Picsum dengan ukuran 600x400 (sesuaikan ukuran sesuai kebutuhan)
            const randomImageUrl = `https://picsum.photos/600/400?random=${Math.floor(
              Math.random() * 1000
            )}`;

            // Ganti atribut src dengan URL gambar acak dari Picsum
            imgElement.src = randomImageUrl;
          });
        });
      </script>

      <script>
        document.addEventListener("DOMContentLoaded", function () {

          const buttons = document.querySelectorAll(".tab-btn");
          const contents = document.querySelectorAll(".tab-content");

          buttons.forEach((button) => {
            button.addEventListener("click", function () {
              buttons.forEach((btn) => btn.classList.remove("active"));
              contents.forEach((content) => content.classList.remove("active"));

              this.classList.add("active");
              document.getElementById(this.dataset.tab).classList.add("active");
            });
          });
        });
      </script>
       <script>
        document.addEventListener("DOMContentLoaded", function () {
          const toggleButtons = document.querySelectorAll(".toggleDropdown");
          const dropdownMenus = document.querySelectorAll(".dropdownMenu");

          toggleButtons.forEach((button, index) => {
            button.addEventListener("click", function (event) {
              event.stopPropagation(); // Mencegah event bubble

              // Tutup semua dropdown sebelum membuka yang baru
              dropdownMenus.forEach((menu, i) => {
                if (i !== index) {
                  menu.style.display = "none";
                }
              });

              // Toggle dropdown yang diklik
              const dropdownMenu = button.nextElementSibling;
              dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
            });
          });

          // Menutup dropdown saat klik di luar
          document.addEventListener("click", function () {
            dropdownMenus.forEach(menu => {
              menu.style.display = "none";
            });
          });
        });

        document.addEventListener("DOMContentLoaded", function () {
          const menuItems = document.querySelectorAll(".menu-item");
          const mostLikesSection = document.querySelector(".most-likes");
          const mostDownloadsSection = document.querySelector(".most-downloads");

          // Fungsi untuk menampilkan tab yang dipilih
          function showTab(tabName) {
            if (tabName === "most-likes") {
              mostLikesSection.classList.remove("d-none");
              mostDownloadsSection.classList.add("d-none");
            } else if (tabName === "most-downloads") {
              mostDownloadsSection.classList.remove("d-none");
              mostLikesSection.classList.add("d-none");
            }
          }

          // Event listener untuk setiap menu item
          menuItems.forEach((item) => {
            item.addEventListener("click", function () {
              // Hapus class 'active' dari semua menu item
              menuItems.forEach((menu) => menu.classList.remove("active"));

              // Tambahkan class 'active' ke item yang diklik
              this.classList.add("active");

              // Tampilkan tab sesuai dengan menu yang diklik
              showTab(this.textContent.trim());
            });
          });

          // Default tampilkan Password
          showTab("most-likes");
        });


      </script>
@endsection
<!-- @vite(['resources/js/leaderboard.js']) -->
