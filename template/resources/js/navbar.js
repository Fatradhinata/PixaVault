document.addEventListener("DOMContentLoaded", () => {
    const BASEURL = document.querySelector('meta[name="baseurl"]').getAttribute("content");

    console.log(BASEURL);
    
    // JS dropdown menu //
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
            dropdownMenu.style.display =
                dropdownMenu.style.display === "block" ? "none" : "block";
        });
    });
    document.addEventListener("click", function () {
        dropdownMenus.forEach((menu) => {
            menu.style.display = "none";
        });
    });

    // JS Search For Images //
    const searchInput = document.querySelector("#search-input input");
    const searchButton = document.querySelector("#search-input button");

    searchButton.addEventListener("click", function () {
        let query = searchInput.value.trim(); // Ambil teks input
        if (query) {
            window.location.href = `${BASEURL}/explore?search=${query}`;
        } else {
            Swal.fire({
                icon: "warning",
                title: "Caution",
                text: "Please enter the search value!",
            });
        }
    });

    searchInput.addEventListener("keypress", function (e) {
        if (e.key === "Enter") searchButton.click();
    });
});
