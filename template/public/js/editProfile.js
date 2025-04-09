document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll(".menu-item");
    const editProfileSection = document.querySelector(".edit-profile");
    const changePasswordSection = document.querySelector(".change-password");

    // Fungsi untuk menampilkan tab yang dipilih
    function showTab(tabName) {
        if (tabName === "Edit Profile") {
            editProfileSection.classList.remove("d-none");
            changePasswordSection.classList.add("d-none");
        } else if (tabName === "Password") {
            changePasswordSection.classList.remove("d-none");
            editProfileSection.classList.add("d-none");
        }
    }

    // Event listener untuk setiap menu item
    menuItems.forEach((item) => {
        console.log(menuItems);
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
    showTab("Edit Profile");

    // Event listener untuk update foto
    const preview = document.querySelector('img.preview-image');
    const fileHandler = document.querySelector('input#photo');
    const button = document.querySelector('label.change-image-text');
    const allowedTypes = [
        'image/jpeg',
        'image/png',
        'image/heic',
        'image/tiff',
        'image/x-tiff',
        'image/arw'
    ];

    button.addEventListener('click', function() {
        fileHandler.click();
    });

    fileHandler.addEventListener('change', function () {
        const file = this.files[0];

        if (file) {
            if (!allowedTypes.includes(file.type)) {
                alert('File harus berupa JPG atau PNG.');
                return;
            }
    
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            };

            reader.readAsDataURL(file);
        }
    });
    
    // Counter max character bio
    const bio = document.getElementById('bio');
    const counter = document.querySelector('span.bio-counter');
    
    bio.addEventListener('input', function() {
        let maximumChars = 500 - bio.value.length;
    
        if (maximumChars <= 0) {
            Swal.fire({
                icon: "warning",
                title: "Caution",
                text: "Maximum message length exceeded!",
            });
        }
    
        counter.innerText = maximumChars;
    });


    // Show password
    $('.change-password .input-group img').on('click', function() {
        $(this).hide();
        $(this).siblings('img').show();
    
        const input = $(this).siblings('input');
        let showPassword = (input.prop('type') === "password");
        
        input.prop('type', (showPassword) ? "text" : "password"); 
    });


    // Submit handler
    const buttons = document.querySelectorAll('.save-button');
    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            Swal.fire({
                icon: "warning",
                title: "Caution",
                text: "Are you sure want to change your user data?",
                showCancelButton: true,
                confirmButtonColor: "#bcff00",
                cancelButtonColor: "#000000",
                confirmButtonText: `<span style="color: black; font-weight: bold;">Submit</span>`,
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = btn.closest('form');

                    if (!form.checkValidity()) {
                        return Swal.fire({
                            icon: 'info',
                            title: 'Warning',
                            text: "The username field cannot be empty!"
                        });
                    }

                    form.submit();
                }
            });
        })
    })
});

