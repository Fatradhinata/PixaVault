@extends('templates.user')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/edit-profile.css') }}">
@endsection

@section('navbar')
    @include('components.navbar-black')
@endsection

@section('content')
    <!-- content -->
    <div class="container">
        <h5 class="section-title">Account Settings</h5>
        <div class="profile-settings">
            <ul class="settings-menu">
                <li class="menu-item active">Edit Profile</li>
                <li class="menu-item">Password</li>
            </ul>
            <div class="settings-content">
                <div class="edit-profile">
                    <h4 class="settings-title">Edit Profile</h4>
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="profile-image-container">
                            @php
                                $cloudName = env('CLOUDINARY_CLOUD_NAME');
                                $publicId = $user->photo;
                                $photoUrl = $publicId
                                    ? "https://res.cloudinary.com/{$cloudName}/image/upload/f_auto/{$publicId}"
                                    : asset('img/icons/user-elipse.svg');
                            @endphp

                            <img id="profileImage" class="profile-image" src="{{ $photoUrl }}" alt="User Profile">


                            <p class="change-image-text" onclick="document.getElementById('fileInput').click();">
                                Change profile image
                            </p>

                            <p class="image-requirements">
                                At least 800 x 800 px recommended. <br>
                                JPG, PNG, or WEBP is allowed.
                            </p>

                            <input type="file" id="fileInput" name="photo" class="hidden-file-input"
                                accept="image/png, image/jpeg, image/webp" onchange="previewImage(event)">
                        </div>

                        <div class="input-group">
                            <label for="username" class="input-label">Username</label>
                            <input type="text" id="username" name="name" class="input-field" placeholder="Username"
                                value="{{ $user->name }}">
                        </div>

                        <div class="input-group">
                            <label for="fullname" class="input-label">Fullname</label>
                            <input type="text" id="fullname" name="full_name" class="input-field" placeholder="Fullname"
                                value="{{ $user->full_name }}">
                        </div>

                        <div class="input-group">
                            <label for="email" class="input-label">Email</label>
                            <input type="text" id="email" name="email" class="input-field" placeholder="Email"
                                value="{{ $user->email }}">
                        </div>

                        <div class="bio-section">
                            <div class="bio-header">
                                <label for="bio" class="input-label">Bio</label>
                                <span class="bio-counter">500</span>
                            </div>
                            <textarea name="bio" id="bio" class="bio-textarea" cols="30" rows="10" maxlength="500">{{ $user->bio }}</textarea>
                        </div>

                        <button type="submit" class="save-button">Save Changes</button>
                    </form>
                </div>
                <form action="{{ route('profile.password.update') }}" method="POST">
                    @csrf
                
                    <div class="change-password d-none">
                        <h4 class="settings-title">Password</h4>
                
                        <div class="password-group">
                            <p class="password-label">Old Password</p>
                            <input type="password" name="old_password" class="password-input" placeholder="Old password" required>
                        </div>
                
                        <div class="password-group">
                            <p class="password-label">New password</p>
                            <input type="password" name="new_password" class="password-input" placeholder="New password" required>
                            <p class="password-hint">Minimum 8 Characters</p>
                        </div>
                
                        <div class="password-group">
                            <p class="password-label">Confirm new password</p>
                            <input type="password" name="new_password_confirmation" class="password-input" placeholder="Confirm new password" required>
                            <p class="password-hint">Minimum 8 Characters</p>
                        </div>
                
                        <button type="submit" class="save-button">Save Changes</button>
                    </div>
                </form>                
            </div>
        </div>
    </div>
    <!-- content -->
@endsection

@section('scripts')
    <script src="{{ asset('js/editProfile.js') }}"></script>
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const imageURL = URL.createObjectURL(file);
                document.getElementById('profileImage').src = imageURL;
            }
        }
    </script>
@endsection
