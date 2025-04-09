@extends('templates.user')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/edit-profile.css') }}">
@endsection

@section('navbar')
    @include('components.navbar')
    <style>
        .mil-top-panel {
            .mil-logo img {
                filter: invert(1);
            }

            .nav-min-sm {
                filter: invert(1);
                transition: filter 0.3s ease;
            }

            .mil-credit,
            .mil-explore {
                color: black
            }

            .nav-horizontal-dot {
                img {
                    filter: invert(1);
                }

                &:hover {
                    background-color: #000;

                    img {
                        filter: invert(0);
                    }
                }
            }

            &.mil-active {
                .nav-horizontal-dot {
                    img {
                        filter: invert(0) !important;
                    }

                    &:hover {
                        background-color: #fff;
                        img {
                            filter: invert(1) !important;
                        }
                    }
                }

                .nav-min-sm {
                    filter: invert(0) !important;
                }

                .mil-credit * {
                    color: white;
                }
            }
        }
    </style>
@endsection

@section('content')
    <!-- content -->
    <div class="container">
        <h2 class="section-title">Account Settings</h2>
        <div class="profile-settings">
            <ul class="settings-menu">
                <li class="menu-item active">Edit Profile</li>
                <li class="menu-item">Password</li>
            </ul>
            <div class="settings-content">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="edit-profile">
                        <h4 class="settings-title">Edit Profile</h4>
                        <div class="preview-image-container">
                            <img class="preview-image" src="{{ $user->photo ? asset('storage/profile_photos/' . $user->photo) : asset('img/icons/user-elipse.svg') }}" alt="User Profile">
                            <input type="file" id="photo" name="photo" accept=".jpg, .jpeg, .png" style="display: none;">
                        </div>
                        <div>
                            <label class="change-image-text">Change profile image</label>
                            <p class="image-requirements">
                                At least 800 x 800 px recommended. <br>
                                JPG or PNG is allowed.
                            </p>
                        </div>
                        <div class="input-group">
                            <label for="username" class="input-label">Username</label>
                            <input type="text" id="username" name="name" class="input-field" placeholder="Username" value="{{ $user->name }}" required>
                        </div>
                        <div class="input-group">
                            <label for="fullname" class="input-label">Fullname</label>
                            <input type="text" id="fullname" name="full_name" class="input-field" placeholder="Fullname" value="{{ $user->full_name }}">
                        </div>
                        <div class="input-group">
                            <label for="email" class="input-label">Phone Number</label>
                            <input type="tel" id="phone_number" name="phone_number" class="input-field" placeholder="08xx" value="{{ $user->phone_number }}">
                        </div>
                        <div class="input-group">
                            <label for="email" class="input-label">Email</label>
                            <input type="email" class="input-field" value="{{ $user->email }}" style="background-color: #4b4b4b15;" disabled>
                        </div>
                        <div class="bio-section">
                            <div class="bio-header">
                                <label for="bio" class="input-label">Bio</label>
                                <span class="bio-counter">{{ 500 - strlen($user->bio) }}</span>
                            </div>
                            <textarea id="bio" name="bio" class="bio-textarea" cols="30" rows="10" maxlength="500" placeholder="About yourself...">{{ $user->bio }}</textarea>
                            <button type="button" class="save-button">Save Changes</button>
                        </div>                   
                    </div>
                </form>
                <form action="{{ route('profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="change-password d-none">
                        <h4 class="settings-title">Password</h4>
    
                        <div class="input-group">
                            <p class="input-label">Old Password</p>
                            <input type="password" id="old-password" name="old-password" class="input-field" placeholder="Password">
                            <img src="{{ asset('img/icons/eye-close.svg') }}" alt="password close" width="28px">
                            <img src="{{ asset('img/icons/eye-open.svg') }}" alt="password open" width="28px" style="display: none">
                        </div>
    
                        <div class="input-group">
                            <p class="input-label">New password</p>
                            <input type="password" id="new-password" name="new-password" class="input-field" placeholder="New password">
                            <img src="{{ asset('img/icons/eye-close.svg') }}" alt="password close" width="28px">
                            <img src="{{ asset('img/icons/eye-open.svg') }}" alt="password open" width="28px" style="display: none">
                            <p class="password-hint">Minimum 8 Characters</p>
                        </div>
    
                        <div class="input-group">
                            <p class="input-label">Confirm new password</p>
                            <input type="password" id="confirm-password" name="confirm-password" class="input-field" placeholder="Confirm new password">
                            <img src="{{ asset('img/icons/eye-close.svg') }}" alt="password close" width="28px">
                            <img src="{{ asset('img/icons/eye-open.svg') }}" alt="password open" width="28px" style="display: none">
                            <p class="password-hint">Minimum 8 Characters</p>
                        </div>
    
                        <button type="button" class="save-button">Save Changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- content -->
@endsection

@section('scripts')
    <script src="{{ asset('js/editProfile.js') }}" type="module"></script>
@endsection
