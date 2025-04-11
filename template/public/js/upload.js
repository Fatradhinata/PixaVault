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

  window.onclick = () => {
    console.log(fileInput.files)
  }

  function handleFile(file) {
    if (file && file.type.startsWith("image/")) {
      const reader = new FileReader();
      reader.onload = (e) => {
        uploadArea.innerHTML = `<img src="${e.target.result}" alt="uploaded-image" style="max-width: -webkit-fill-available; max-height: inherit; object-fit: contain; border-radius: 8px;">`;
  
        uploadArea.classList.add("uploaded");
  
        const iconJpg = fileIcon.dataset.iconJpg;
        const iconPng = fileIcon.dataset.iconPng;
        const iconDefault = fileIcon.dataset.iconDefault;
  
        const extension = file.name.split('.').pop().toLowerCase();
        if (extension === 'jpg' || extension === 'jpeg') {
          fileIcon.src = iconJpg;
        } else if (extension === 'png') {
          fileIcon.src = iconPng;
        } else {
          fileIcon.src = iconDefault;
        }
  
        fileNameElement.textContent = file.name;
        let fileSize = file.size / 1024;
        fileSizeElement.textContent = fileSize < 1024
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
