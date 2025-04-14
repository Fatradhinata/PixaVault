// Get elements
const photoTrigger = document.getElementById("photo-trigger");
const photoModal = document.getElementById("photo-modal");
const closeModal = document.getElementById("close-modal");

// Show modal on click
photoTrigger.addEventListener("click", (e) => {
  e.preventDefault();
  photoModal.style.display = "flex";
});

// Hide modal on close 
closeModal.addEventListener("click", () => {
  photoModal.style.display = "none";
});

// Hide modal on outside click
window.addEventListener("click", (e) => {
  if (e.target === photoModal) {
    photoModal.style.display = "none";
  }
});
document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.querySelector(".mil-sidebar-search input");
  const searchButton = document.querySelector(
    ".mil-sidebar-search button"
  );

  searchButton.addEventListener("click", function () {
    let query = searchInput.value.trim(); // Ambil teks input
    if (query) {
      alert("Mencari: " + query); // Gantilah ini dengan fungsi pencarian yang sesuai
      // Misalnya, bisa diarahkan ke halaman pencarian
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