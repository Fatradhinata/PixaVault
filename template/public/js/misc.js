window.refreshLikeEvent = function () {
    document.querySelectorAll('.like-btn').forEach((btn) => {
        btn.onclick = async function () {
            const id = btn.dataset.id;

            const response = await fetch(`${BASEURL}/content/like/${id}`);
            const { status, like } = await response.json();
            if (status === 'fail') return console.error('Server error');

            document.querySelectorAll(`.like-btn[data-id="${id}"]`).forEach((b) => {
                b.querySelector('i').setAttribute('class', like ? 'fas fa-heart' : 'far fa-heart');
            });
        };
    });
};


const Toast = Swal.mixin({
    toast: true,
    position: "bottom-end",
    showConfirmButton: false,
    timerProgressBar: true,
    didOpen: (toast) => {
        const container = toast.closest('.swal2-container');
        const title = toast.querySelector('.swal2-title');

        // title.style.paddingRight = '1rem';
        title.style.width = 'max-content';
        container.style.transform = "translate(-1.8rem, -1rem)";
    },
});

window.downloadImage = async function (url) {

    Toast.fire({
        timer: 3000,
        icon: "info",
        title: "Downloading Photo...",
    });

    try {
        const response = await fetch(url);

        if (!response.ok) {
            if (response.status === 404) {
                throw new Error('File not found');
            } else if (response.status === 301 || response.status === 302 || response.status === 307 || response.status === 308) {
                throw new Error(`HTTP redirecting: ${response.status}`);
            }
        }

        const contentType = response.headers.get('Content-Type');

        if (contentType && contentType.startsWith('application/octet-stream') ||
            contentType && contentType.includes('image/')) {

            const contentDisposition = response.headers.get('Content-Disposition');
            const filename = contentDisposition ? contentDisposition.match(/filename=([^;]*)/)[1].toLowerCase() : 'pixavault_download';
            const blob = await response.blob();
            const downloadLink = document.createElement('a');
            downloadLink.href = URL.createObjectURL(blob);
            downloadLink.download = filename;
            downloadLink.style.display = 'none';
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
            URL.revokeObjectURL(downloadLink.href);

            Toast.fire({
                timer: 6000,
                icon: "success",
                title: "File Downloaded Successfully!",
            });

            // Decrement limit UI
            $('#amount-limit').text(parseInt($('#amount-limit').text()) - 1);

        } else if (contentType && contentType.includes('text/html')) {
            Toast.fire({
                didClose: () => {
                    // let redirect = response.url + "#subscribe";
                    // window.open(redirect, '_blank');
                },
                timer: 5000,
                icon: "warning",
                title: "You've reached your free limit!",
            });
        } else {
            throw new Error('Unexpected response type: ' + contentType);
        }

    } catch (error) {
        console.error(error);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    refreshLikeEvent();

    $('.mil-download-btn').on('click', function () {
        downloadImage($(this).data('href'));
    });
});