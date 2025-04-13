<!-- Modal -->
<div class="modal" id="modal-content">
    <div class="modal-content">
        <img class="close" src="{{ asset('img/icons/cancel.svg') }}" alt="close">
        <hr class="line">

        <!-- Modal Header -->
        <div class="modal-header">
            <div class="user-info">
                <img src="" class="profile" alt="User Avatar" />
                <div>
                    <p class="username">storyset</p>
                    <a class="follow">View Profile</a>
                </div>
            </div>
            <div class="actions">
                @auth
                    <div class="actions-btn">
                        <!-- Button untuk dropdown -->
                        <div class="relative">
                            <button class="option-btn dropdown-toggle">
                                <img src="{{ asset('img/icons/horiz-dots-variant-2.svg') }}" alt="">
                            </button>

                            <!-- Dropdown menu -->
<<<<<<< HEAD
                            <div
                                class="dropdown-report hidden absolute right-0 mt-2 w-40 bg-white border border-gray-300 rounded shadow-md">
                                <p class="block px-4 py-2 text-gray-800 hover:bg-gray-200 report-btn report-content"
                                    data-modal-target="modal-report">
=======
                            <div class="dropdown-report hidden absolute right-0 mt-2 w-40 bg-white border border-gray-300 rounded shadow-md">
                                <p class="block px-4 py-2 text-gray-800 hover:bg-gray-200 report-btn" data-modal-target="modal-report">
>>>>>>> ce2107dff90b399d3dcf5608e6a26207cebde147
                                    Report Content
                                </p>
                            </div>

                        </div>
                    </div>
                @endauth
                <button class="like-btn" data-id=""><i class="far fa-heart"></i></button>
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
        </div>

        <!-- Deskripsi -->
        <p class="mil-up mil-mb-30 content-description">
            Photo Descriptions...
        </p>

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
                    <p id="commentCount">0</p> <!-- Akan di-update oleh JavaScript -->
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


        <!-- More Image -->
        <section class="more-images">
            <div class="mt-5">
                <div class="header">
                    <h4>More Like This</h4>
                </div>
                <div class="row">

                    <div class="col-lg-4 col-md-12 mb-4 mb-lg-0 column-1">
                    </div>

                    <div class="col-lg-4 mb-4 mb-lg-0 column-2">
                    </div>

                    <div class="col-lg-4 mb-4 mb-lg-0 column-3">
                    </div>

                </div>
            </div>
        </section>
    </div>
</div>

@include('components.modal-report')

@section('scripts')
    @parent
    <script>
        if (typeof BASEURL === 'undefined') {
            window.BASEURL = `{{ url('/') }}`;
            window.tmp_user = `{{ asset('img/icons/user-elipse.svg') }}`;
        }
        const PROFILE_BASE_URL = `{{ asset('storage/profile_photos') }}`;

        document.addEventListener('DOMContentLoaded', () => {
            let commentAssets = document.getElementById("comment-assets");

            const currentUser = @json(auth()->user());

            let userImage = commentAssets.dataset.userImage;
            let loveIcon = commentAssets.dataset.loveIcon;
            let optionsIcon = commentAssets.dataset.optionsIcon;

            var commentPage = 1;
            var contentId;

            if (document.getElementById("idContent") != null) {
                contentId = document.getElementById("idContent")
            }

            let loadMoreButton = document.querySelector(".comment-load-btn");
            let commentList = document.getElementById("commentList");


            const photoModal = $("#modal-content");
            console.log('jansjdasd')

            function setField(data) {
                console.log(data)
                $('#modal-content').data('id', data.id);
                $('#modal-content .like-btn')[0].dataset.id = data.id;
                $('#modal-content .like-btn i').attr('class', ((data.is_liked) ? `fas fa-heart` : `far fa-heart`));
                $('#modal-content .image-content').attr('src', `${BASEURL}/image/${data.photo}`);

                $('#idContent').val(data.id);
                contentId = data.id

                $('#modal-content .profile').attr(
                    'src', data.user?.photo ? `${PROFILE_BASE_URL}/${data.user.photo}` : tmp_user
                );

                $('#modal-content .comment-profile img').attr(
                    'src', currentUser?.photo ? `${PROFILE_BASE_URL}/${currentUser.photo}` : tmp_user
                );

                $('#modal-content .follow').attr('href', `${BASEURL}/profile/${data.id_user}`);
                $('#modal-content .username').text((data.user) ? data.user.name : 'anonymous');
                $('#modal-content .downloads').text(data.downloads);
                $('#modal-content .views').text(data.views);
                $('#modal-content .likes').text(data.likes);
                $('#modal-content .title').text(data.name);
                $('#modal-content .content-description').text(data.desc);
                $('#modal-content .shoot-by').text(data.shoot_by);
                $('#modal-content .created-at').text(data.created_at);

                $('#modal-content .report-btn').attr('data-id-user', data.id_user);
                $('#modal-content .report-btn').attr('data-id-content', data.id);

                if ($('#idContent').length) {
                    $('#idContent').val(data.id);
                }

                $('#modal-content .tag-row').html('');
                for (let tag of data.tags)
                    $('#modal-content .tag-row').append(`<button>${tag}</button>`);

                contentId = data.id
            }


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

                        <div class="dropdown-report hidden absolute right-0 mt-2 w-40 bg-white border border-gray-300 rounded shadow-md">
                            <p class="block px-4 py-2 text-gray-800 hover:bg-gray-200 report-btn comment-report"
                                data-modal-target="modal-report" data-id-comment="${comment.id}">
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
                return {
                    status: 'fail',
                    message: 'No internet connection!'
                };
            }

            async function refreshContent() {
                const {
                    status,
                    data,
                    message
                } = await fetchData(`${BASEURL}/content/get/20`);

                if (status !== 'fail') {
                    console.log(data)
                    let addCard = function(data) {
                        return `
                        <div class="content-item mil-up position-relative">
                            <div class="mil-buttons">
                                <button class="mil-love-btn like-btn" data-id="${data.id}">
                                    ${data.is_liked ? `<i class="fas fa-heart"></i>` : `<i class="far fa-heart"></i>`}
                                </button>
                                <button class="mil-download-btn"><i class="fas fa-download"></i></button>
                            </div>
                            <img src="${BASEURL}/image/${data.photo}" class="w-100 shadow-1-strong rounded" alt="Photo" data-id="${data.id}" />
                            <div class="image-profile">
                                <img src="${(data.user) ? data.user.photo : tmp_user}" alt="Profile Picture" class="mil-profile-img" />
                                <p class="mil-username">${(data.user) ? data.user.name : 'anonymous'}</p>
                            </div>
                        </div>`;
                    };

                    $('#modal-content .more-images .col-lg-4').html('');

                    for (let content of data[0])
                        $('#modal-content .column-1').append(addCard(content));

                    for (let content of data[1])
                        $('#modal-content .column-2').append(addCard(content));

                    for (let content of data[2])
                        $('#modal-content .column-3').append(addCard(content));

                    refreshEvents();
                } else {
                    console.error('Error while fetching data: ' + message);
                }
            };

            async function displayData(id) {
                const {
                    status,
                    data,
                    message
                } = await fetchData(`${BASEURL}/content/${id}`);

                if (status !== 'fail') {
                    data.tags = JSON.parse(data.tags);
                    setField(data);
                } else {
                    console.error('Error while fetching data: ' + message);
                }
            };

            async function fetchComment(id, page, loadMore) {
                try {
                    console.log(`Fetching comments for ID: ${id}, Page: ${page}, LoadMore: ${loadMore}`);

                    const response = await fetch(`${BASEURL}/comments/${id}?page=${page}`);

                    const responseText = await response.text();
                    console.log("Raw Response:", responseText);

                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}: ${responseText}`);
                    }

                    const jsonData = JSON.parse(responseText);
                    console.log("API Response:", jsonData);

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
                        console.log(jsonData.status, loadMore, 'asdsadsad')
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




            // async function fetchComment(id) {
            //     const {
            //         status,
            //         data,
            //         message
            //     } = await fetchData(`${BASEURL}/comments/${id}?page=1}`);

            //     if(loadMore) {
            //         setLoadMoreComment(data)
            //     } else if (loadMore == false) {
            //         setCommentField(data);
            //         console.log(data)
            //     }  else {
            //         console.error('Error while fetching data: ' + message);
            //     }
            // }

            document.querySelector(".comment-wrapper")?.addEventListener("click", function(event) {

                if (event.target.classList.contains("like-comment-btn")) {
                    let commentId = event.target.getAttribute("data-comment-id");
                    let isLiked = event.target.classList.contains("liked");

                    if (!window.isAuthenticated) {
                        window.location.href = "/login";
                        return;
                    }

                    let url = isLiked ? `/comment/${commentId}/unlike` : `/comment/${commentId}/like`;
                    let method = isLiked ? "DELETE" : "POST";

                    console.log(commentId, "Clicked");

                    fetch(url, {
                            method: method,
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute("content"),
                                "Content-Type": "application/json"
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.message.includes("successfully")) {
                                let likeCountElement = document.getElementById(
                                    `like-count-${commentId}`);
                                let currentLikes = parseInt(likeCountElement.textContent);

                                if (isLiked) {
                                    likeCountElement.textContent = currentLikes - 1;
                                    event.target.classList.remove("liked", "alr-liked");
                                } else {
                                    likeCountElement.textContent = currentLikes + 1;
                                    event.target.classList.add("liked", "alr-liked");
                                }
                            }
                        })
                        .catch(error => console.error("Error:", error));
                }
            });

            function refreshEvents() {
                $('#modal-content .more-images .content-item img').each(function(i, content) {
                    content.onclick = async function() {

                        const id = $(this).data('id');
                        await displayData(id);
                        if (commentPage == null) {
                            commentPage = 1
                        }

                        await fetchComment(id, 1, false);
                        refreshContent();
                    }
                });

                $('.download-btn')[0].onclick = function() {
                    let id = $('#modal-content').data('id');
                    window.downloadImage(`${BASEURL}/content/download/${id}`);
                };

                // window.refreshLikeEvent();
            }

            document.getElementById("commentForm")?.addEventListener("submit", function(event) {
                event.preventDefault();

                let form = this;
                let formData = new FormData(form);
                formData.forEach((value, key) => {
                    console.log(`${key}:`, value);
                });

                console.log('Fetch Comments')
                fetch("{{ route('comments.store') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(
                                `HTTP Error! Status: ${response.status} ${response.statusText}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            commentCount.innerHTML = data.comment.total_comment
                            let commentList = document.getElementById("commentList");
                            document.getElementById("commentUserName").textContent = data.comment
                                .user_name;

                            // Buat elemen komentar baru
                            let newComment = document.createElement("div");
                            newComment.classList.add("comment-item");
                            newComment.innerHTML = `
                                <div class="comment-profile">
                                     <div class="comment-identity">
                                    <img src="${data.comment.user_image ?? userImage}" alt="User Profile">
                                    <p>${data.comment.user_name}</p>
                            </div>
                            <div class="relative">
                                <button class="option-btn dropdown-toggle">
                                    <img src="${optionsIcon}" alt="">
                                </button>

                                <div class="dropdown-report hidden absolute right-0 mt-2 w-40 bg-white border border-gray-300 rounded shadow-md">
                                    <p class="block px-4 py-2 text-gray-800 hover:bg-gray-200 report-btn comment-report"
                                        data-modal-target="modal-report" data-id-comment="${data.comment.id}">
                                        Report Comment
                                    </p>
                                </div>
                            </div>
                                </div>
                                <div class="d-flex gap-1 comment-content">
                                    <p class="comment-text">${data.comment.comment}</p>
                                    <div class="comment-action d-flex flex-column align-items-center justify-content-center">
                                        <img class="cursor-pointer like-comment-btn ${data.comment.is_liked ? 'alr-liked liked' : ''}"  data-comment-id="${data.comment.id}" src="${loveIcon}" alt="love-icon">
                                        <p class="font-weight-bold" id="like-count-${data.comment.id}">${data.comment.likes}</p>
                                    </div>
                                </div>
                                <p class="comment-time-duration">Just now</p>
                            `;

                            // Masukkan ke atas daftar komentar
                            commentList.prepend(newComment);

                            // Reset form
                            form.reset();
                        } else {
                            console.error(data)
                            console.error(data.success)
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });

            // loadMore Function
            loadMoreButton.addEventListener("click", function() {
                commentPage++;
                console.log(contentId, 'pasdpsaldpasda')
                fetchComment(contentId, commentPage, true);
            });

            function setLoadMoreComment(data, jsonData) {
                console.log(jsonData)
                if (data.status === "fail") {
                    loadMoreButton.style.display = "none";
                    return;
                }

                if (data.length > 0 && document.getElementById("noCommentsText") != null) {
                    document.getElementById("noCommentsText").style.display = "none";
                }

                data.forEach(comment => {
                    console.log(comment)
                    let newComment = document.createElement("div");
                    newComment.classList.add("comment-item");
                    newComment.innerHTML = `
                            <div class="comment-profile">
                                <div class="comment-identity">
                                <img src="${comment.user_image ?? userImage}" alt="User Profile">
                                <p>${comment.user_name}</p>
                            </div>
                            <div class="relative">
                                <button class="option-btn dropdown-toggle">
                                    <img src="${optionsIcon}" alt="">
                                </button>

                                <div class="dropdown-report hidden absolute right-0 mt-2 w-40 bg-white border border-gray-300 rounded shadow-md">
                                    <p class="block px-4 py-2 text-gray-800 hover:bg-gray-200 report-btn comment-report"
                                        data-modal-target="modal-report" data-id-comment="${comment.id}">
                                        Report Comment
                                    </p>
                                </div>
                            </div>
                            </div>
                            <div class="d-flex gap-1 comment-content">
                                <p class="comment-text">${comment.comment}</p>
                                <div class="comment-action d-flex flex-column align-items-center justify-content-center">
                                    <img class="cursor-pointer like-comment-btn ${comment.is_liked ? 'alr-liked liked' : ''}"  data-comment-id="${comment.id}" src="${loveIcon}" alt="love-icon">
                                    <p class="font-weight-bold" id="like-count-${comment.id}">${comment.likes}</p>
                                </div>
                            </div>
                            <p class="comment-time-duration">${comment.created_at}</p>
                        `;

                    commentList.appendChild(newComment);
                });

                if (!jsonData.hasMore) {
                    loadMoreButton.style.display = "none";
                }
            }

            // Open Modal
            $('[data-modal-target="modal-content"]').on('click', async function() {
                const id = $(this).data('id');

                await displayData(id);
                await fetchComment(id, commentPage, false);
                refreshContent();

                photoModal.fadeIn(300);
            });


            // Hide modal on close button
            $("#modal-content .close").on("click", () => {
                photoModal.fadeOut(300);
            });

            // Hide modal on outside click
            window.addEventListener("click", (e) => {
                if (e.target === photoModal[0])
                    photoModal.fadeOut(300);
            });


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
