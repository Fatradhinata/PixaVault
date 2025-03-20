document.addEventListener("DOMContentLoaded", function () {
  const uploadArea = document.querySelector(".upload-area");
  const fileInput = document.getElementById("imageInput");

  const fileDetailWrapper = document.querySelector(".file-detail-wrapper");
  const fileNameElement = document.querySelector(".filename");
  const fileSizeElement = document.querySelector(".file-size");

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

  window.onclick = () => {
    console.log(fileInput.files)
  }

  function handleFile(file) {
    if (file && file.type.startsWith("image/")) {
      const reader = new FileReader();
      reader.onload = (e) => {
        uploadArea.innerHTML = `<img src="${e.target.result}" alt="uploaded-image" style="max-width: -webkit-fill-available; max-height: inherit; object-fit: contain; border-radius: 8px;">`;

        uploadArea.classList.add("uploaded");

        // **Update filename & file size**
        fileNameElement.textContent = file.name;

        // **Filter size (KB atau MB)**
        let fileSize = file.size / 1024; // Convert to KB
        if (fileSize < 1024) {
          fileSizeElement.textContent = fileSize.toFixed(2) + " KB";
        } else {
          fileSizeElement.textContent = (fileSize / 1024).toFixed(2) + " MB";
        }

        // **Unhide file details**
        fileDetailWrapper.style.display = "flex";
      };
      reader.readAsDataURL(file);
    } else {
      alert("Please upload a valid image file.");
    }
  }
});

document.querySelector("form").addEventListener("submit", function (e) {
  e.preventDefault(); 

  const fileInput = document.getElementById("imageInput");
  console.log(fileInput)
  if (fileInput.files.length === 0) {
      alert("No file selected!");
  } else {
      this.submit(); 
  }
});
