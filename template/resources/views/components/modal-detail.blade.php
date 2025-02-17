<!-- Modal -->
<div class="modal" id="photo-modal">
    <div class="modal-content">
        <img class="close" src="{{ Vite::asset('resources/img/icons/cancel.svg') }}" alt="close">
        <hr class="line">

        <!-- Modal Header -->
        <div class="modal-header">
            <div class="user-info">
                <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="User Avatar" />
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
    </div>
</div>

@section('scripts')
    @parent
    <script>
        const BASEURL = `{{ url('/') }}`;

        // JS Modal //
        document.addEventListener('DOMContentLoaded', () => {
            const photoModal = $("#photo-modal");
            const closeModal = $("#photo-modal .close");

            let cache = {};
            const setField = (data) => {
                $('#photo-modal .image-content').attr('src', data.photo);
                $('#photo-modal .follow').attr('href', `${BASEURL}/profile/` + data.user.id);
                $('#photo-modal .username').text(data.user.name);
                $('#photo-modal .download').text(data.views);
                $('#photo-modal .views').text(data.downloads);
                $('#photo-modal .title').text(data.name);
                $('#photo-modal .content-description').text(data.desc);
                $('#photo-modal .shoot-by').text(data.shoot_by);
                $('#photo-modal .created-at').text(data.created_at);
                
                $('#photo-modal .tag-row').html('');
                for (let tag of data.tags)
                    $('#photo-modal .tag-row').append(`<button>${tag}</button>`);
            }
    
            $('div[data-modal-target="modal-content"]').on('click', async function() {
                const id = $(this).data('id');

                // Check if data is cached before making a new request
                if (id in cache) {
                    setField(cache[id])
                } else {
                    await fetch(`${BASEURL}/content/${id}`)
                    .then(res => {if (res.ok) return res.json()})
                    .then(({ data }) => {
                        console.log(data);
                        data.tags = JSON.parse(data.tags);
                        cache[id] = data;
                        setField(data);
                    })
                    .catch(e => {console.log(e)});
                }

                // Show the modal
                photoModal.fadeIn(300);
            });
    
            // Hide modal on close button
            $("#photo-modal .close").on("click", () => {
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
