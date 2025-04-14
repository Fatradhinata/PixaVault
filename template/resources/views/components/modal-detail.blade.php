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
                @auth
                    <div class="actions-btn">
                        <div class="relative">
                            <button class="option-btn dropdown-toggle">
                                <img src="{{ asset('img/icons/horiz-dots-variant-2.svg') }}" alt="">
                            </button>

                            <div
                                class="dropdown-report hidden absolute right-0 mt-2 w-40 bg-white border border-gray-300 rounded shadow-md">
                                <p class="block px-4 py-2 text-gray-800 hover:bg-gray-200 report-btn report-content"
                                    data-modal-target="modal-report">
                                    Report Content
                                </p>
                            </div>

                        </div>
                    </div>
                    <button class="like-btn" data-id=""><i class="far fa-heart"></i></button>
                    <button class="delete-btn">
                        <div>
                            <img src="{{ asset('img/icons/trash.svg') }}" alt="Edit">
                            <p>Delete</p>
                        </div>
                    </button>
                    <button class="edit-btn">
                        <div>
                            <img src="{{ asset('img/icons/edit-pen.svg') }}" alt="Edit">
                            <p>Edit</p>
                        </div>
                    </button>
                @endauth
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

        <div id="comment-assets" data-user-image="{{ asset('img/icons/user-elipse.svg') }}"
            data-love-icon="{{ asset('img/icons/love-black.svg') }}"
            data-options-icon="{{ asset('img/icons/horiz-dots-variant-2.svg') }}">
        </div>

        <!-- Comment Wrapper -->
        <div class="comment-wrapper" data-user-image="{{ asset('img/icons/user-elipse.svg') }}"
            data-love-icon="{{ asset('img/icons/love-black.svg') }}"
            data-options-icon="{{ asset('img/icons/horiz-dots-variant-2.svg') }}">
            <div class="comment-header">
                <h3>Comment</h3>
                <div>
                    <p id="commentCount">0</p>
                </div>
            </div>
            @auth
                <form class="comment-input" id="commentForm">
                    @csrf
                    <div class="comment-profile">
                        <img src="{{ asset('img/faces/user.jpg') }}" alt="User Profile">
                        <p id="commentUserName">{{ auth()->user()->name }}</p>

                    </div>
                    <input type="hidden" id="idContent" name="id_content" value="">
                    <input type="text" name="comment" class="comment-input-area" placeholder="Write a comment..."
                        autocomplete="off">
                    <hr>
                    <div class="btn comment-send-btn">
                        <button type="submit">Send</button>
                    </div>
                </form>
            @endauth
            <div class="comment-list" id="commentList">
                <p id="noCommentsText" class="text-center text-muted">No comments yet.</p>
            </div>
            <button class="btn comment-load-btn">Load More</button>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script>
        const ICON_EDIT = "{{ asset('img/icons/edit-pen.svg') }}";
        const ICON_CHECK = "{{ asset('img/icons/checklist.svg') }}";
        // const PROFILE_BASE_URL = `{{ asset('storage/profile_photos') }}`;
        if (typeof BASEURL === 'undefined') {
            window.BASEURL = `{{ url('/') }}`;
            window.tmp_user = `{{ asset('img/icons/user-elipse.svg') }}`;
        }
        
        const commentCount = document.getElementById("commentCount");

        // JS Modal //
        document.addEventListener('DOMContentLoaded', () => {

            // Fetch Data //
            const modal = $("#modal-detail");

            const currentUser = @json(auth()->user());

            var commentPage = 1;
            var contentId;

            let loadMoreButton = document.querySelector(".comment-load-btn");
            let commentList = document.getElementById("commentList");

            let commentAssets = document.getElementById("comment-assets");

            let userImage = commentAssets.dataset.userImage;
            let loveIcon = commentAssets.dataset.loveIcon;
            let optionsIcon = commentAssets.dataset.optionsIcon;

            let cache = {};

            function setField(data) {
                console.log(data, currentUser.photo)
                $('#modal-detail').data('id', data.id);
                $('#idContent').val(data.id);
                contentId = data.id

                $('#modal-detail .image-content').attr('src', `${BASEURL}/image/${data.photo}`);

                $('#modal-detail .profile').attr(
                    'src', data.user?.photo ? `${PROFILE_BASE_URL}/${data.user.photo}` : tmp_user
                );

                $('#modal-detail .comment-profile img').attr(
                    'src', currentUser?.photo ? `${PROFILE_BASE_URL}/${currentUser.photo}` : tmp_user
                );


                $('#modal-detail .follow').attr('href', `${BASEURL}/profile/${data.id_user}`);
                $('#modal-detail .username').text(data.user?.name ?? 'anonymous');

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

                if (currentUser.id !== data.id_user) {
                    $('#modal-detail .edit-btn').hide();
                    $('#modal-detail .actions-btn .relative').show();
                } else {
                    $('#modal-detail .edit-btn').show();
                    $('#modal-detail .actions-btn .relative').hide();
                }
            }

            // Delete Content when user click delete button
            $(document).on("click", ".delete-btn", function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This content will be permanently deleted.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#D94D4C',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: `<span style="color: white; font-weight: bold;">Yes, Delete</span>`
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `${BASEURL}/content/${contentId}`,
                            type: 'DELETE',
                            method: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function(res) {
                                if (res.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted!',
                                        text: res.message,
                                        timer: 2000,
                                        showConfirmButton: false,
                                    }).then(() => {
                                        location.reload();
                                    });


                                    $(`.content-item:has(.delete-btn[data-id="${contentId}"])`)
                                        .remove();
                                }
                            },
                            error: function(err) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Failed',
                                    text: err.responseJSON?.message ??
                                        'Failed to delete content',
                                });
                            }
                        });
                    }
                });
            });


            // Edit Content when user click Edit Button
            $('.edit-btn').on('click', function() {
                const modal = $('#modal-detail');
                const isEditing = modal.hasClass('editing');
                const btn = $(this);

                if (!isEditing) {
                    // MASUK MODE EDIT
                    modal.addClass('editing');
                    btn.find('p').text('Save Changes');
                    btn.find('img').attr('src', ICON_CHECK);
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
                    // KONFIRMASI 
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

            function setCommentField(comments) {
                const commentList = document.getElementById("commentList");
                const commentCount = document.getElementById("commentCount");
                const noCommentsText = document.getElementById("noCommentsText");

                commentList.innerHTML = "";

                if (comments.length === 0) {
                    commentList.innerHTML =
                        `<p id="noCommentsText" class="text-center text-muted">No comments yet.</p>`;
                } else {
                    comments.forEach(comment => {
                        const commentItem = document.createElement("div");
                        commentItem.classList.add("comment-item");

                        commentItem.innerHTML = `
                <div class="comment-profile">
                    <div class="comment-identity">
                        <img src="${comment.user_image ?? userImage}" alt="User Profile">
                        <p>${comment.user_name}</p>
                    </div>
                    <div class="relative">
                                        <button class="option-btn dropdown-toggle">
                                            <img src="${optionsIcon}" alt="">
                                        </button>

                                        <div
                                            class="dropdown-report hidden absolute right-0 mt-2 w-40 bg-white border border-gray-300 rounded shadow-md">
                                            <p class="block px-4 py-2 text-gray-800 hover:bg-gray-200 report-btn comment-report"
                                                data-modal-target="modal-report"
                                                data-id-comment="${comment.id}">
                                                Report Comment
                                            </p>
                                        </div>
                                    </div>
                </div>
                <div class="d-flex gap-1 comment-content">
                    <p class="comment-text">${comment.comment}</p>
                    <div class="comment-action d-flex flex-column align-items-center justify-content-center">
                        <img class="cursor-pointer like-comment-btn ${comment.is_liked ? 'alr-liked liked' : ''}" data-comment-id="${comment.id}" src="${loveIcon}" alt="love-icon">
                        <p class="font-weight-bold" id="like-count-${comment.id}">${comment.likes}</p>
                    </div>
                </div>
                <p class="comment-time-duration">${comment.created_at}</p>
            `;

                        commentList.appendChild(commentItem);
                    });
                }
            }


            async function fetchData(url) {
                const res = await fetch(url)
                if (res.ok) {
                    const data = await res.json();
                    return data;
                }
                return false;
            };

            async function fetchComment(id, page, loadMore) {
                try {
                    console.log(id)
                    const response = await fetch(`${BASEURL}/comments/${id}?page=${page}`);

                    const responseText = await response.text();

                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}: ${responseText}`);
                    }

                    const jsonData = JSON.parse(responseText);

                    if (jsonData.status === 'success') {
                        commentCount.innerHTML = jsonData.totalComment

                        if (!jsonData.hasMore) {
                            loadMoreButton.style.display = "none";
                        } else {
                            loadMoreButton.style.display = "block";
                        }

                        if (loadMore) {
                            setLoadMoreComment(jsonData.data, jsonData);
                        } else {
                            setCommentField(jsonData.data);
                        }
                    } else {
                        if (jsonData.status == 'fail' && loadMore == false) {
                            loadMoreButton.style.display = "none";

                            commentList.innerHTML =
                                `<p id="noCommentsText" class="text-center text-muted">No comments yet.</p>`;
                            commentCount.innerHTML = 0
                        }
                        console.error(`Server Error: ${jsonData.message || 'Unknown error'}`);
                    }
                } catch (error) {
                    console.error("Fetch failed:", error.message);
                }
            }

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

            // OPEN MODAL
            $('[data-modal-target="modal-detail"]').on('click', async function() {
                const id = $(this).data('id');

                await displayData(id);
                await fetchComment(id, commentPage, false);

                modal.fadeIn(300);
            });

            // document.querySelector(".comment-wrapper")?.addEventListener("click", function(event) {

            //     if (event.target.classList.contains("like-comment-btn")) {
            //         let commentId = event.target.getAttribute("data-comment-id");
            //         let isLiked = event.target.classList.contains("liked");

            //         if (!window.isAuthenticated) {
            //             window.location.href = "/login";
            //             return;
            //         }

            //         let url = isLiked ? `/comment/${commentId}/unlike` : `/comment/${commentId}/like`;
            //         let method = isLiked ? "DELETE" : "POST";

            //         console.log(commentId, "Clicked");

            //         fetch(url, {
            //                 method: method,
            //                 headers: {
            //                     "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
            //                         .getAttribute("content"),
            //                     "Content-Type": "application/json"
            //                 }
            //             })
            //             .then(response => response.json())
            //             .then(data => {
            //                 if (data.message.includes("successfully")) {
            //                     let likeCountElement = document.getElementById(
            //                         `like-count-${commentId}`);
            //                     let currentLikes = parseInt(likeCountElement.textContent);

            //                     if (isLiked) {
            //                         likeCountElement.textContent = currentLikes - 1;
            //                         event.target.classList.remove("liked", "alr-liked");
            //                     } else {
            //                         likeCountElement.textContent = currentLikes + 1;
            //                         event.target.classList.add("liked", "alr-liked");
            //                     }
            //                 }
            //             })
            //             .catch(error => console.error("Error:", error));
            //     }
            // });

            // document.getElementById("commentForm")?.addEventListener("submit", function(event) {
            //     event.preventDefault();

            //     let form = this;
            //     let formData = new FormData(form);
            //     formData.forEach((value, key) => {
            //         console.log(`${key}:`, value);
            //     });

            //     fetch("{{ route('comments.store') }}", {
            //             method: "POST",
            //             headers: {
            //                 "X-CSRF-TOKEN": "{{ csrf_token() }}"
            //             },
            //             body: formData
            //         })
            //         .then(response => {
            //             if (!response.ok) {
            //                 throw new Error(
            //                     `HTTP Error! Status: ${response.status} ${response.statusText}`);
            //             }
            //             return response.json();
            //         })
            //         .then(data => {
            //             if (data.success) {
            //                 commentCount.innerHTML = data.comment.total_comment
            //                 let commentList = document.getElementById("commentList");
            //                 document.getElementById("commentUserName").textContent = data.comment
            //                     .user_name;

            //                 let newComment = document.createElement("div");
            //                 newComment.classList.add("comment-item");
            //                 newComment.innerHTML = `
            //                     <div class="comment-profile">
            //                         <div class="comment-identity">
            //                             <img src="${data.comment.user_image ?? userImage}" alt="User Profile">
            //                             <p>${data.comment.user_name}</p>
            //                         </div>
            //                         <div class="relative">
            //                             <button class="option-btn dropdown-toggle">
            //                                 <img src="${optionsIcon}" alt="">
            //                             </button>

            //                             <div
            //                                 class="dropdown-report hidden absolute right-0 mt-2 w-40 bg-white border border-gray-300 rounded shadow-md">
            //                                 <p class="block px-4 py-2 text-gray-800 hover:bg-gray-200 report-btn comment-report"
            //                                     data-modal-target="modal-report"
            //                                     data-id-comment="${data.comment.id}">
            //                                     Report Comment
            //                                 </p>
            //                             </div>
            //                         </div>
            //                     </div>
            //                     <div class="d-flex gap-1 comment-content">
            //                         <p class="comment-text">${data.comment.comment}</p>
            //                         <div class="comment-action d-flex flex-column align-items-center justify-content-center">
            //                             <img class="cursor-pointer like-comment-btn ${data.comment.is_liked ? 'alr-liked liked' : ''}"  data-comment-id="${data.comment.id}" src="${loveIcon}" alt="love-icon">
            //                             <p class="font-weight-bold" id="like-count-${data.comment.id}">${data.comment.likes}</p>
            //                         </div>
            //                     </div>
            //                     <p class="comment-time-duration">Just now</p>
            //                 `;

            //                 commentList.prepend(newComment);

            //                 form.reset();
            //             } else {
            //                 console.error(data)
            //                 console.error(data.success)
            //             }
            //         })
            //         .catch(error => console.error("Error:", error));
            // });

            // // loadMore Function
            // loadMoreButton.addEventListener("click", function() {
            //     commentPage++;
            //     console.log(contentId, commentPage)
            //     fetchComment(contentId, commentPage, true);
            // });

            // function setLoadMoreComment(data, jsonData) {
            //     console.log(data)
            //     if (data.status === "fail") {
            //         loadMoreButton.style.display = "none";
            //         return;
            //     }

            //     if (data.length > 0 && document.getElementById("noCommentsText") != null) {
            //         document.getElementById("noCommentsText").style.display = "none";
            //     }

            //     data.forEach(comment => {
            //         console.log(comment)
            //         let newComment = document.createElement("div");
            //         newComment.classList.add("comment-item");
            //         newComment.innerHTML = `
            //                 <div class="comment-profile">
            //                     <div class="comment-identity">
            //                         <img src="${comment.user_image ?? userImage}" alt="User Profile">
            //                         <p>${comment.user_name}</p>
            //                     </div>
            //                     <div class="relative">
            //                             <button class="option-btn dropdown-toggle">
            //                                 <img src="${optionsIcon}" alt="">
            //                             </button>

            //                             <div
            //                                 class="dropdown-report hidden absolute right-0 mt-2 w-40 bg-white border border-gray-300 rounded shadow-md">
            //                                 <p class="block px-4 py-2 text-gray-800 hover:bg-gray-200 report-btn comment-report"
            //                                     data-modal-target="modal-report"
            //                                     data-id-comment="${comment.id}">
            //                                     Report Comment
            //                                 </p>
            //                             </div>
            //                     </div>
            //                 </div>
            //                 <div class="d-flex gap-1 comment-content">
            //                     <p class="comment-text">${comment.comment}</p>
            //                     <div class="comment-action d-flex flex-column align-items-center justify-content-center">
            //                         <img class="cursor-pointer like-comment-btn ${comment.is_liked ? 'alr-liked liked' : ''}"  data-comment-id="${comment.id}" src="${loveIcon}" alt="love-icon">
            //                         <p class="font-weight-bold" id="like-count-${comment.id}">${comment.likes}</p>
            //                     </div>
            //                 </div>
            //                 <p class="comment-time-duration">${comment.created_at}</p>
            //             `;

            //         commentList.appendChild(newComment);
            //     });

            //     if (!jsonData.hasMore) {
            //         loadMoreButton.style.display = "none";
            //     }
            // }



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

            // Dropdown Reports Events

            // Show/hide dropdown report
            $(document).on("click", ".dropdown-toggle", function(event) {
                event.stopPropagation();
                let dropdown = $(this).next(".dropdown-report");
                $(".dropdown-report").not(dropdown).addClass("hidden");
                dropdown.toggleClass("hidden");
            });

            // Hide dropdown if clicked outside
            $(document).on("click", function() {
                $(".dropdown-report").addClass("hidden");
            });

        });
    </script>
@endsection
@include('components.modal-report')
