<!-- Modal -->
<div class="modal" id="modal-detail">
    <div class="modal-content">
        <img class="close" src="{{ Vite::asset('resources/img/icons/cancel.svg') }}" alt="close">
        <hr class="line">

        <!-- Modal Header -->
        <div class="modal-header">
            <div class="user-info">
                <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="User Avatar" />
                <div>
                    <p class="username">Author</p>
                    <a href="#" class="follow">View Profile</a>
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

            // Fetch Data //
            const modal = $("#modal-detail");

            let cache = {};

            function setField(data) {
                $('#modal-detail .image-content').attr('src', `${BASEURL}/image/${data.photo}`);
                $('#modal-detail .follow').attr('href', `${BASEURL}/profile/${data.user.id}`);
                $('#modal-detail .profile').attr('href', `${BASEURL}/profile/${data.user.photo}`);
                $('#modal-detail .username').text(data.user.name);
                $('#modal-detail .downloads').text(data.downloads);
                $('#modal-detail .views').text(data.views);
                $('#modal-detail .title').text(data.name);
                $('#modal-detail .content-description').text(data.desc);
                $('#modal-detail .shoot-by').text(data.shoot_by);
                $('#modal-detail .created-at').text(data.created_at);
                
                $('#modal-detail .tag-row').html('');
                for (let tag of data.tags)
                    $('#modal-detail .tag-row').append(`<button>${tag}</button>`);
            }

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
