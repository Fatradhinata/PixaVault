document.addEventListener('DOMContentLoaded', function() {
    const formDelete = document.querySelector('#form-delete');

    $('.btn-delete').click(function() {
        formDelete.querySelector('input[name="id"]').value = $(this).data('id');

        Swal.fire({
            title: 'Warning!',
            html: 'Are you sure want to delete this content?<br><span class="text-danger">(This action cannot be undone)</span>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#ef4444",
            cancelButtonColor: "#000000",
            confirmButtonText: 'Confirm!'
        }).then((result) => {
            if (result.isConfirmed) {
                formDelete.submit();
            }
        });
    });

    $('.btn-resolve').on('click', function() {
        let url = $(this).data('url');

        Swal.fire({
            title: 'Caution',
            html: 'Are you sure want to resolve this report?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Confirm!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });

    $('.btn-detail').on('click', function() {
        let id = $(this).data('id');

        $('.card-container').removeClass('show');
        $('#reason').val('');
        $('#detail').val('');

        fetch('../../../admin/report/' + id)
            .then(res => {
                if (!res.ok) throw new Error('Network response was not ok ' + res.statusText);
                return res.json();
            })
            .then(res => {
                let data = res.data;
                // console.log(data);

                try {
                    if (!data.content && !data.comment) {
                        let user = data.user;
    
                        $('.card-user').html(`
                            <div class="photo-profile">
                                <img src="${user.photo ? "../../../storage/profile_photos/" + user.photo : "../../../img/icons/user-elipse.svg"}" alt="User Profile">
                            </div>
                            <div class="user-info">
                                <h3 class="fs-5">${user.name}</h3>
                                <p class="text-sm">${user.email}</p>
                                <span class="badge bg-gradient-dark"><b>10</b> followers</span>
                            </div>
                        `).addClass('show');
                    } else if (data.content && !data.comment) {
                        let content = data.content;
                        let user = content.user;
    
                        $('.card-content').html(`
                            <div class="photo-content">
                                <img src="../../../image/${content.photo}" alt="image">
                                <div class="info">
                                    <div class="photo-profile">
                                        <img src="${user.photo ? "../../../storage/profile_photos/" + user.photo : "../../../img/icons/user-elipse.svg"}" alt="User Profile">
                                    </div>
                                    <span>${user.name}</span>
                                </div>
                            </div>
                            <div>
                                <h3 class="mt-3 fs-4">${content.name}</h3>
                                <p class="mb-0 text-sm">${content.desc}</p>
                            </div>
                            <div class="insight d-flex align-items-center justify-content-start gap-3 py-3">
                                <div class="border-end pe-3">
                                    <h5 class="mb-0 text-sm">Likes</h5>
                                    <span>${content.likes}</span>
                                </div>
                                <div class="border-end pe-3">
                                    <h5 class="mb-0 text-sm">Views</h5>
                                    <span>${content.views}</span>
                                </div>
                                <div class="border-end pe-3">
                                    <h5 class="mb-0 text-sm">Download</h5>
                                    <span>${content.downloads}</span>
                                </div>
                            </div>
                        `).addClass('show');
                    } else {
                        let comment = data.comment;
                        let user = comment.user;
                        
                        $('.card-comment').html(`
                            <div class="d-flex align-items-center">
                                <div class="photo-profile">
                                    <img src="${comment.user.photo ? "../../../storage/profile_photos/" + comment.user.photo : "../../../img/icons/user-elipse.svg"}" alt="User Profile">
                                </div>
                                <div class="user-info">
                                    <h3 class="fs-5">${comment.user.name}</h3>
                                    <p class="text-sm">${comment.user.email}</p>
                                </div>
                            </div>
    
                            <div class="mt-3">
                                <textarea class="form-control" rows="3" disabled>${comment.comment}</textarea>
                            </div>
                        `).addClass('show');
                    }
                } catch (error) {
                    console.error(error);
                }

                $('#reason').val(data.reason);
                $('#detail').val(data.detail);
            });
    });
});