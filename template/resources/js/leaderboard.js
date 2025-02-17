document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll(".menu-item");
    const mostLikesSection = document.querySelector("#most-likes");
    const mostDownloadsSection = document.querySelector("#most-downloads");

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
        console.log(item);
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