@extends('templates.blank')
@section('title', 'Upload Content | PixaVault')

@section('styles')
    @vite('resources/css/upload.css')
@endsection

@section('content')

    <!-- Flash Message -->
    @include('components.flasher')

    <!-- Content -->
    <div id="content">
        <div class="upload-content">
            <div class="header">
                <h5>Upload Photo</h5>
                <img src="{{ Vite::asset('resources/img/icons/cancel.svg') }}" width="35px" height="35px" alt="cancel">
            </div>
            <hr>
            <div class="core">
              <form class="form" action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Upload Area -->
                    <div class="upload">
                        <div class="upload-area">
                            <img src="{{ Vite::asset('resources/img/icons/camera.svg') }}" alt="icon-cam">
                            <p>Drag & Drop<br>photo to Upload<br>or <span>browse</span></p>
                          </div>
                          <input type="file" name="image" id="imageInput" accept="image/*" required hidden>
                        <div class="file-detail-wrapper" style="display: none;">
                            <div class="file-detail">
                                <img src="{{ Vite::asset('resources/img/icons/document-jpg.svg') }}" width="46px" height="46px" alt="doc-jpg">
                                <div class="filename-wrapper">
                                    <p class="filename">filename.jpg</p>
                                    <p class="file-size">3MB</p>
                                </div>
                            </div>
                            <img class="trash-icon" src="{{ Vite::asset('resources/img/icons/trash.svg') }}" alt="delete">
                        </div>
                    </div>

                    <!-- Upload Detail -->
                    <div class="upload-detail">
                        <div class="input-wrapper">
                            <p>Title</p>
                            <input type="text" name="name" placeholder="Breathtaking Nature's Beauty" required>
                        </div>

                        <div class="input-wrapper">
                            <p>Description</p>
                            <input type="text" name="desc" placeholder="Immerse yourself in the serene beauty of nature , where..." required>
                        </div>

                        <div class="input-wrapper input-wrapper-row">
                            <div class="input-group">
                                <p>Category Tag</p>
                                <input type="text" name="tags" placeholder="Nature, Landscape" required>
                            </div>
                            <div class="input-group">
                                <p>Shoot by</p>
                                <input type="text" name="shoot_by" placeholder="Iphone 16 pro">
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="upload-submit-wrapper">
                            <button type="submit" class="upload-button">
                                Upload Photo
                            </button>
                            <button type="reset" class="upload-cancel-button">
                                Cancel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
