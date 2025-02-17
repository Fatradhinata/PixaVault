<!-- Modal -->
<div class="modal" id="modal-content">
    <div class="modal-content">
        <img class="close" src="{{ Vite::asset('resources/img/icons/cancel.svg') }}" alt="close">
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
                <button class="like-btn">
                    <i class="far fa-heart"></i>
                </button>
                <button class="download-btn">
                    <div>
                        <img src="{{ Vite::asset('resources/img/icons/download.svg') }}" alt="Download Icon">
                        <p>Download</p>
                    </div>
                </button>
            </div>
        </div>
        <img src="" class="image-content" alt="Photo Detail" />
        <div class="d-flex my-4">
            <!-- Bagian Views -->
            <div class="mil-up">
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
                <img src="{{ Vite::asset('resources/img/icons/share.svg') }}" alt="share">
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
            <img src="{{ Vite::asset('resources/img/icons/camera-variant-1.svg') }}" width="28px" height="28px" alt="cam-1">
            <p class="mb-0 shoot-by" style="color: #6c757d">-</p>
        </div>

        <!-- Tags -->
        <div class="tag-row">
            <button>example</button>
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

@section('scripts')
    @parent
    <script>
        const BASEURL = `{{ url('/') }}`;
        const tmp_user = `{{ Vite::asset('resources/img/icons/user-elipse.svg') }}`;

        // JS Modal //
        document.addEventListener('DOMContentLoaded', () => {
            const photoModal = $("#modal-content");
            let cache = {};

            function setField(data) {
                $('#modal-content .image-content').attr('src', `${BASEURL}/image/${data.photo}`);
                $('#modal-content .follow').attr('href', `${BASEURL}/profile/${data.user.id}`);
                $('#modal-content .profile').attr('href', `${BASEURL}/profile/${data.user.photo}`);
                $('#modal-content .username').text(data.user.name);
                $('#modal-content .downloads').text(data.downloads);
                $('#modal-content .views').text(data.views);
                $('#modal-content .title').text(data.name);
                $('#modal-content .content-description').text(data.desc);
                $('#modal-content .shoot-by').text(data.shoot_by);
                $('#modal-content .created-at').text(data.created_at);
                
                $('#modal-content .tag-row').html('');
                for (let tag of data.tags)
                    $('#modal-content .tag-row').append(`<button>${tag}</button>`);
            }

            async function fetchData(url) {
                const res = await fetch(url)
                if (res.ok) {
                    const data = await res.json();
                    return data;
                }
                return {status: 'fail', message: 'No internet connection!'};
            }

            async function refreshContent() {
                const { status, data, message } = await fetchData(`${BASEURL}/content/get/20`);

                if (status !== 'fail') {
                    let addCard = function(data) {
                        return `
                        <div class="content-item mil-up position-relative" data-id="${data.id}">
                            <div class="mil-buttons">
                                <button class="mil-love-btn"><i class="fas fa-heart"></i></button>
                                <button class="mil-download-btn"><i class="fas fa-download"></i></button>
                            </div>
                            <img src="${data.photo}" class="w-100 shadow-1-strong rounded" alt="Photo" />
                            <div class="image-profile">
                                <img src="${data.user.photo}" alt="Profile Picture" class="mil-profile-img" />
                                <p class="mil-username">${data.user.name}</p>
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
                if (id in cache) {
                    setField(cache[id])
                } else {
                    const { status, data, message } = await fetchData(`${BASEURL}/content/${id}`);
                    
                    if (status !== 'fail') {
                        data.tags = JSON.parse(data.tags);
                        setField(data);
                        cache[id] = data;
                    } else {
                        console.error('Error while fetching data: ' + message);
                    } 
                }
            };

            function refreshEvents() {
                $('#modal-content .more-images .content-item').each(function(i, content) {
                    content.onclick = async function() {
                        const id = $(this).data('id');
                        await displayData(id);
                        refreshContent();
                    }
                });
            }
    
            $('[data-modal-target="modal-content"]').on('click', async function() {
                const id = $(this).data('id');

                await displayData(id);
                refreshContent();

                photoModal.fadeIn(300);
            });
    
            // Hide modal on close button
            $("#modal-content .close").on("click", () => {
                photoModal.fadeOut(300);
            });
    
            // Hide modal on outside click
            window.addEventListener("click", (e) => {
                if (e.target === photoModal[0]) {
                    photoModal.fadeOut(300);
                }
            });
        });
    </script>
@endsection

