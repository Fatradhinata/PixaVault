@extends('templates.blank')

@section('title', 'Upload')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/upload.css') }}">
    <!-- Tagify CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">

    <style>
        /* Container dropdown */
        .ui-autocomplete {
            max-height: 200px;
            overflow-y: auto;
            overflow-x: hidden;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            border-radius: 8px;
            padding: 4px 0;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            z-index: 99999;
        }

        .ui-menu-item {
            padding: 6px 12px;
            cursor: pointer;
        }

        .tagify {
            width: 100%;
            border: 2px solid #D9D9D9;
            border-radius: 5px;
            color: black;
            font-weight: 600;
            font-family: 'Figtree', sans-serif;
            font-size: 14px;
            background-color: #fff;
            transition: border 0.2s ease-in-out;
            align-items: center
        }


        .tagify:focus-within {
            border-color: #6366f1;
            outline: none;
        }

        .tagify__tag {
            background: #f3f4f6;
            color: #111827;
            border-radius: 9999px;
            font-family: 'Poppins', sans-serif;
            padding: 4px 8px;
        }

        .loader {
            display: inline-block;
            position: relative;
            top: 3px;
            width: 20px;
            margin-right: 8px;
            aspect-ratio: 1;
            border-radius: 50%;
            border: 4px solid;
            border-color: #000 #0000;
            animation: l1 1s infinite;
        }

        @keyframes l1 {
            to {
                transform: rotate(.5turn);
            }
        }

    </style>
@endsection

@section('content')

    <!-- Flash Message -->
    @include('components.flasher')

    <!-- Content -->
    <div id="content">
        <div class="upload-content">
            <div class="header">
                <h5>Upload Photo</h5>
                <a href="{{ route('profile') }}" class="btn-back">
                    <img src="{{ asset('img/icons/back.svg') }}" width="35px" height="35px" alt="back">
                </a>
            </div>
            <hr>
            <div class="core">
                <form class="form" action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <!-- Upload Area -->
                    <div class="upload">
                        <div class="upload-area">
                            <img src="{{ asset('img/icons/camera.svg') }}" alt="icon-cam">
                            <p>Drag & Drop<br>photo to Upload<br>or <span>browse</span></p>
                        </div>
                        <input type="file" name="image" id="imageInput" accept="image/*" required hidden>
                        <div class="file-detail-wrapper" style="display: none;">
                            <div class="file-detail">
                                <img src="{{ asset('img/icons/document-jpg.svg') }}" width="46px" height="46px" alt="doc-jpg" data-icon-jpg="{{ asset('img/icons/document-jpg.svg') }}"
                                    data-icon-png="{{ asset('img/icons/document-png.svg') }}" data-icon-default="{{ asset('img/icons/document-img.svg') }}">
                                <div class="filename-wrapper">
                                    <p class="filename">filename.jpg</p>
                                    <p class="file-size">3MB</p>
                                </div>
                            </div>
                            <img class="trash-icon" src="{{ asset('img/icons/trash.svg') }}" alt="delete">
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

                        <div class="input-wrapper ">
                            <div class="input-group">
                                <p>Category Tag</p>
                                <input name="tags" id="tags" placeholder="Nature, City, Sunset" required>

                            </div>
                        </div>
                        <div class="input-wrapper ">
                            <div class="input-group">
                                <p>Shoot by</p>
                                <input type="text" name="shoot_by" placeholder="Iphone 16 pro">
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="upload-submit-wrapper">
                            <button type="button" class="upload-button">
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

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="{{ asset('js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('js/plugins/swal.min.js') }}"></script>
    <script src="{{ asset('js/upload.js') }}"></script>
@endsection
