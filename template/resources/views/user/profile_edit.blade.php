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
                    <div class="profile-image-container">
                        <img class="profile-image" src="{{ asset('img/icons/user-elipse.svg') }}" alt="User Profile">
                        <p class="change-image-text">Change profile image</p>
                        <p class="image-requirements">
                            At least 800 x 800 px recommended. <br>
                            JPG or PNG is allowed.
                        </p>
                    </div>
                    <div class="input-group">
                        <label for="username" class="input-label">Username</label>
                        <input type="text" id="username" class="input-field" placeholder="Username">
                    </div>
                    <div class="bio-section">
                        <div class="bio-header">
                            <label for="bio" class="input-label">Bio</label>
                            <span class="bio-counter">500</span>
                        </div>
                        <textarea name="bio" id="bio" class="bio-textarea" cols="30" rows="10" maxlength="500"></textarea>
                        <button class="save-button">Save Changes</button>
                    </div>
                    <div class="email-section">
                        <p class="email-label">Email address</p>
                        <div class="email-content">
                            <p class="email-text">Your email address is <strong>{{ $user->email }}</strong></p>
                            <span class="change-email-link">Change</span>
                        </div>
                    </div>
                </div>
                <div class="change-password d-none">
                    <h4 class="settings-title">Password</h4>

                    <div class="password-group">
                        <p class="password-label">Old Password</p>
                        <input type="password" class="password-input" placeholder="Password">
                    </div>

                    <div class="password-group">
                        <p class="password-label">New password</p>
                        <input type="password" class="password-input" placeholder="New password">
                        <p class="password-hint">Minimum 8 Characters</p>
                    </div>

                    <div class="password-group">
                        <p class="password-label">Confirm new password</p>
                        <input type="password" class="password-input" placeholder="Confirm new password">
                        <p class="password-hint">Minimum 8 Characters</p>
                    </div>

                    <button class="save-button">Save Changes</button>
                </div>

            </div>
        </div>
    </div>
    <!-- content -->
@endsection

@section('scripts')
    <script src="{{ asset('js/editProfile.js') }}"></script>
@endsection
