document.addEventListener("DOMContentLoaded", function () {
    const uploadArea = document.querySelector(".upload-area");
    const fileInput = document.getElementById("imageInput");

    const fileDetailWrapper = document.querySelector(".file-detail-wrapper");
    const fileNameElement = document.querySelector(".filename");
    const fileSizeElement = document.querySelector(".file-size");
    const trashIcon = document.querySelector(".trash-icon");
    const fileIcon = document.querySelector(".file-detail img");

    uploadArea.addEventListener("click", () => fileInput.click());

    fileInput.addEventListener("change", (event) => {
        handleFile(event.target.files[0]);
    });

    uploadArea.addEventListener("dragover", (event) => {
        event.preventDefault();
        uploadArea.classList.add("drag-over");
    });

    uploadArea.addEventListener("dragleave", () => {
        uploadArea.classList.remove("drag-over");
    });

    uploadArea.addEventListener("drop", (event) => {
        event.preventDefault();
        uploadArea.classList.remove("drag-over");
        if (event.dataTransfer.files.length > 0) {
            fileInput.files = event.dataTransfer.files;
            handleFile(event.dataTransfer.files[0]);
        }
    });

    // window.onclick = () => {
    //   console.log(fileInput.files)
    // }

    function handleFile(file) {
        if (file && file.type.startsWith("image/")) {
            const reader = new FileReader();
            reader.onload = (e) => {
                uploadArea.innerHTML = `<img src="${e.target.result}" alt="uploaded-image" style="max-width: -webkit-fill-available; max-height: inherit; object-fit: contain; border-radius: 8px;">`;

                uploadArea.classList.add("uploaded");

                const iconJpg = fileIcon.dataset.iconJpg;
                const iconPng = fileIcon.dataset.iconPng;
                const iconDefault = fileIcon.dataset.iconDefault;

                const extension = file.name.split(".").pop().toLowerCase();
                if (extension === "jpg" || extension === "jpeg") {
                    fileIcon.src = iconJpg;
                } else if (extension === "png") {
                    fileIcon.src = iconPng;
                } else {
                    fileIcon.src = iconDefault;
                }

                fileNameElement.textContent = file.name;
                let fileSize = file.size / 1024;
                fileSizeElement.textContent =
                    fileSize < 1024
                        ? fileSize.toFixed(2) + " KB"
                        : (fileSize / 1024).toFixed(2) + " MB";

                fileDetailWrapper.style.display = "flex";
            };
            reader.readAsDataURL(file);
        } else {
            alert("Please upload a valid image file.");
        }
    }

    trashIcon.addEventListener("click", function () {
        fileInput.value = "";
        fileDetailWrapper.style.display = "none";
        fileIcon.src = fileIcon.dataset.iconDefault;

        uploadArea.innerHTML = `
            <img src="/img/icons/camera.svg" alt="icon-cam">
            <p>Drag & Drop<br>photo to Upload<br>or <span>browse</span></p>
        `;

        uploadArea.classList.remove("uploaded");
    });

    // Tagify //

    const input = document.querySelector("#tags");

    const tagify = new Tagify(input, {
        whitelist: [],
        maxTags: 5,
        dropdown: {
            maxItems: 15,
            classname: "tags-look",
            enabled: 0,
            closeOnSelect: false,
            duplicates: false,
        },
    });

    fetch("/api/tags")
        .then((res) => res.json())
        .then(function (tagList) {
            tagify.settings.whitelist = tagList;
        });

    tagify.on("input", function (e) {
        let value = e.detail.value;

        fetch(`/api/tags?q=${value}`)
            .then((res) => res.json())
            .then(function (suggestions) {
                tagify.settings.whitelist = suggestions;
                tagify.dropdown.show.call(tagify, value);
            });
    });

    // Submit handler

    const form = document.querySelector("form");
    const submitBtn = document.querySelector(".upload-button");

    submitBtn.addEventListener("click", function () {
        const fileInput = document.getElementById("imageInput");

        if (fileInput.files.length === 0) {
            Swal.fire({
                icon: "warning",
                title: "Warning!",
                text: "No file selected!",
            });
        } else {
            Swal.fire({
                icon: "info",
                title: "Caution",
                text: "Are you sure want to upload this content?",
                showCancelButton: true,
                confirmButtonText: `<span style="color: black;">Continue</span>`,
                cancelButtonText: "Cancel",
                confirmButtonColor: "#bcff00",
            }).then((result) => {
                if (result.isConfirmed) {
                    upload();
                }
            });
            // form.submit();
        }
    });

    function upload() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = `<div class="loader"></div><span>0%</span>`;

        const formData = new FormData(form);
        const xhr = new XMLHttpRequest();

        xhr.upload.addEventListener("progress", function (e) {
            if (e.lengthComputable) {
                let percent = Math.round((e.loaded / e.total) * 100);
                submitBtn.innerHTML = `<div class="loader"></div><span>${percent}%</span>`;
            }
        });

        xhr.addEventListener("load", function () {
            if ([200, 302].includes(xhr.status)) {
                Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: "File uploaded successfully!",
                    showCancelButton: true,
                    confirmButtonText: `<span style="color: black;">Back</span>`,
                    cancelButtonText: "Close",
                    confirmButtonColor: "#bcff00",
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.querySelector(".btn-back").click();
                    }
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Failed",
                    text: `Upload failed (${xhr.status})`,
                });
            }

            // reset tombol
            submitBtn.disabled = false;
            submitBtn.innerHTML = "Upload";
        });

        xhr.addEventListener("error", function () {
            Swal.fire({
                icon: "error",
                title: "Failed",
                text: "Something when wrong while uploading..",
            });

            submitBtn.disabled = false;
            submitBtn.innerHTML = "Upload";
        });

        xhr.open("POST", form.action);
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

        xhr.send(formData);
    }
});
