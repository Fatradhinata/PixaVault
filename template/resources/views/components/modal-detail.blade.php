<!-- Modal -->
<div class="modal" id="modal-detail">
    <div class="modal-content">
        <img class="close" src="{{ asset('img/icons/cancel.svg') }}" alt="close">
        <hr class="line">

        <!-- Modal Header -->
        <div class="modal-header">
            <div class="user-info">
                <img class="profile profile-modal-detail" src="https://randomuser.me/api/portraits/men/1.jpg"
                    alt="User Avatar" />
                <div>
                    <p class="username">Author</p>
                    {{-- <a href="#" class="follow">View Profile</a> --}}
                </div>
            </div>
            <div class="actions">
                <button class="edit-btn">
                    <div>
                        <img src="{{ asset('img/icons/edit-pen.svg') }}" alt="Edit">
                        <p>Edit</p>
                    </div>
                </button>
                <button class="download-btn">
                    <div>
                        <img src="{{ asset('img/icons/download.svg') }}" alt="Download Icon">
                        <p>Download</p>
                    </div>
                </button>
            </div>
        </div>
        <img src="" class="image-content" alt="Photo Detail" />
        <div class="d-flex my-4">
            <!-- Bagian Likes -->
            <div class="mil-up">
                <p style="margin: 0; font-size: 14px; color: #6c757d">
                    Likes
                </p>
                <p style="margin: 0; font-size: 18px; font-weight: bold" class="likes">
                    0
                </p>
            </div>

            <!-- Bagian Views -->
            <div class="ms-5 mil-up">
                <p style="margin: 0; font-size: 14px; color: #6c757d">
                    Views
                </p>
                <p style="margin: 0; font-size: 18px; font-weight: bold" class="views">
                    0
                </p>
            </div>

            <!-- Bagian Download -->
            <div class="ms-5 mil-up">
                <p style="margin: 0; font-size: 14px; color: #6c757d">
                    Downloads
                </p>
                <p style="margin: 0; font-size: 18px; font-weight: bold" class="downloads">
                    0
                </p>
            </div>

            <button class="share-btn">
                <img src="{{ asset('img/icons/share.svg') }}" alt="share">
                <p>Share</p>
            </button>
        </div>


        <!-- Judul -->
        <div class="details">
            <div class="mb-1">
                <h4 class="mil-up title">Background Furniture</h4>
            </div>
            <!-- Deskripsi -->
            <p class="mil-up mil-mb-30 content-description">
                Photo Descriptions...
            </p>
        </div>


        <!-- Tanggal -->
        <div class="d-flex align-items-center my-1 mil-up created-date">
            <i class="fas fa-upload" style="margin-right: 10px; color: #6c757d"></i>
            <p class="mb-0 created-at" style="color: #6c757d">-</p>
        </div>

        <!-- Shoot By -->
        <div class="d-flex align-items-center my-1 mil-up publish-cam">
            <img src="{{ asset('img/icons/camera-variant-1.svg') }}" width="28px" height="28px" alt="cam-1">
            <p class="mb-0 shoot-by" style="color: #6c757d">-</p>
        </div>

        <!-- Tags -->
        <div class="tag-row">
            <button>example</button>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script>
        const ICON_EDIT = "{{ asset('img/icons/edit-pen.svg') }}";
        const ICON_CHECK = "{{ asset('img/icons/checklist.svg') }}";
        if (typeof BASEURL === 'undefined') {
            window.BASEURL = `{{ url('/') }}`;
            window.tmp_user = `{{ asset('img/icons/user-elipse.svg') }}`;
        }

        // JS Modal //
        document.addEventListener('DOMContentLoaded', () => {

            // Fetch Data //
            const modal = $("#modal-detail");

            const currentUser = @json(auth()->user());

            let cache = {};

            function setField(data) {
                console.log(data, currentUser)
                $('#modal-detail').data('id', data.id);
                $('#modal-detail .image-content').attr('src', `${BASEURL}/image/${data.photo}`);
                // src="{{ $user->photo ? asset('storage/profile_photos/' . $user->photo) : asset('img/icons/user-elipse.svg') }}" alt="User Profile">
                $('#modal-detail .profile').attr('src', currentUser.photo ?
                    `storage/profile_photos/${currentUser.photo}` : tmp_user);
                $('#modal-detail .follow').attr('href', `${BASEURL}/profile/${data.id_user}`);
                $('#modal-detail .username').text((currentUser) ? currentUser.name : 'anonymous');
                $('#modal-detail .downloads').text(data.downloads);
                $('#modal-detail .views').text(data.views);
                $('#modal-detail .likes').text(data.likes);
                $('#modal-detail .title').text(data.name);
                $('#modal-detail .content-description').text(data.desc);
                $('#modal-detail .shoot-by').text(data.shoot_by);
                $('#modal-detail .created-at').text(data.created_at);

                $('#modal-detail .tag-row').html('');
                for (let tag of data.tags)
                    $('#modal-detail .tag-row').append(`<button>${tag}</button>`);
            }

            $('.edit-btn').on('click', function() {
                const modal = $('#modal-detail');
                const isEditing = modal.hasClass('editing');
                const btn = $(this);

                if (!isEditing) {
                    // MASUK MODE EDIT
                    modal.addClass('editing');
                    btn.find('p').text('Save Changes');
                    btn.find('img').attr('src', ICON_CHECK); // <- opsional icon checklist
                    const titleText = modal.find('.title').text();
                    const descText = modal.find('.content-description').text();
                    const shootBy = modal.find('.shoot-by').text();

                    modal.find('.title').replaceWith(
                        `<input class="edit-title input-edit" value="${titleText}">`);
                    modal.find('.content-description').replaceWith(
                        `<textarea class="edit-desc input-edit">${descText}</textarea>`);
                    modal.find('.shoot-by').replaceWith(
                        `<input class="edit-shootby input-edit" value="${shootBy}">`);
                } else {
                    // KONFIRMASI DULU
                    Swal.fire({
                        icon: "warning",
                        title: "Caution",
                        text: "Are you sure want to change this content?",
                        showCancelButton: true,
                        confirmButtonColor: "#bcff00",
                        cancelButtonColor: "#000000",
                        confirmButtonText: `<span style="color: black; font-weight: bold;">Submit</span>`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // AMBIL NILAI
                            const titleVal = modal.find('.edit-title').val();
                            const descVal = modal.find('.edit-desc').val();
                            const shootByVal = modal.find('.edit-shootby').val();
                            const id = modal.data('id');

                            // VALIDASI LENGKAP
                            if (!titleVal.trim() || !descVal.trim()) {
                                return Swal.fire({
                                    icon: 'info',
                                    title: 'Validation Warning',
                                    text: "Title and description can't be empty."
                                });
                            }

                            if (titleVal.length > 100) {
                                return Swal.fire({
                                    icon: 'info',
                                    title: 'Validation Warning',
                                    text: "Title is too long. Max 100 characters."
                                });
                            }

                            if (descVal.length > 500) {
                                return Swal.fire({
                                    icon: 'info',
                                    title: 'Validation Warning',
                                    text: "Description is too long. Max 500 characters."
                                });
                            }

                            if (shootByVal.length > 50) {
                                return Swal.fire({
                                    icon: 'info',
                                    title: 'Validation Warning',
                                    text: "Shoot By is too long. Max 50 characters."
                                });
                            }


                            // SUBMIT AJAX
                            $.ajax({
                                url: `${BASEURL}/content/${id}`,
                                method: 'POST',
                                data: {
                                    _token: `{{ csrf_token() }}`,
                                    name: titleVal,
                                    desc: descVal,
                                    shoot_by: shootByVal,
                                },
                                success: res => {
                                    // KELUAR DARI MODE EDIT
                                    modal.removeClass('editing');
                                    btn.find('p').text('Edit');
                                    btn.find('img').attr('src', ICON_EDIT);

                                    modal.find('.edit-title').replaceWith(
                                        `<h4 class="mil-up title">${titleVal}</h4>`);
                                    modal.find('.edit-desc').replaceWith(
                                        `<p class="mil-up mil-mb-30 content-description">${descVal}</p>`
                                    );
                                    modal.find('.edit-shootby').replaceWith(
                                        `<p class="mb-0 shoot-by" style="color: #6c757d">${shootByVal}</p>`
                                    );

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Update Successful',
                                        text: 'Content has been updated.',
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                },
                                error: err => {
                                    let msg = 'An unexpected error occurred.';
                                    if (err.responseJSON && err.responseJSON.message) {
                                        msg = err.responseJSON.message;
                                    }

                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Update Failed',
                                        text: msg,
                                        timer: 2500,
                                        showConfirmButton: false
                                    });
                                }
                            });
                        }
                    });
                }
            });


            async function fetchData(url) {
                const res = await fetch(url)
                if (res.ok) {
                    const data = await res.json();
                    return data;
                }
                return false;
            };

            async function displayData(id) {
                if (id in cache) {
                    setField(cache[id])
                } else {
                    const {
                        status,
                        data,
                        message
                    } = await fetchData(`${BASEURL}/content/${id}`);

                    if (status !== 'fail') {
                        data.tags = JSON.parse(data.tags);
                        setField(data);
                        cache[id] = data;
                    } else {
                        console.error('Error while fetching data: ' + message);
                    }
                }
            };

            $('[data-modal-target="modal-detail"]').on('click', async function() {
                const id = $(this).data('id');

                await displayData(id);

                modal.fadeIn(300);
            });




            // Hide modal on close button
            $("#modal-detail .close").on("click", () => {
                modal.fadeOut(300);
            });

            // Hide modal on outside click
            window.addEventListener("click", (e) => {
                if (e.target === modal[0]) {
                    modal.fadeOut(300);
                }
            });

            // Like Button //

        });
    </script>
@endsection
