@extends('layouts/headerFooter')

@section('content')

@php
    $user = Auth::user();
@endphp

<style>
    .profile-container {
        max-width: 80%;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        gap: 3rem;
        align-items: flex-start;
        justify-content: flex-start;
    }

    .profile-card, .profile-info {
        background-color: #fff;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }

    .profile-card {
        flex: 1 1 300px;
        text-align: center;
    }

    .profile-info {
        flex: 2 1 600px;
        margin-left: 2rem;
        padding-left: 2rem;
    }

    .profile-img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
    }

    .edit-button {
        float: right;
        background-color: #4CAF50;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 20px;
        cursor: pointer;
    }

    .dropdown-menu {
        position: absolute;
        top: 60px;
        right: 30px;
        background: #fff;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-radius: 5px;
        display: none;
        flex-direction: column;
    }

    .dropdown-menu a {
        padding: 10px 15px;
        text-decoration: none;
        color: black;
        transition: background 0.3s;
    }

    .dropdown-menu a:hover {
        background-color: #f0f0f0;
    }

    .profile-icon {
        cursor: pointer;
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    .form-row {
        margin-bottom: 15px;
    }

    .form-row label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        font-size: 14px;
        color: #000; 
    }

    .form-row i {
        color: #000; 
        font-size: 20px; 
        margin-right: 8px;
        vertical-align: middle;
    }

    .form-value {
        font-size: 15px;
        color: #444;
        padding-left: 28px;
    }


</style>

<div class="profile-container">
    <!-- Profile Card -->
    <div class="profile-card">

        <img src="{{ $user->photo && \Storage::disk('public')->exists($user->photo) ? asset('storage/' . $user->photo) : asset('uploads/default.jpg') }}" alt="Profile" class="profile-img">
        <div style="display: flex; flex-direction: column; gap: 10px; margin-top: 1rem; align-items: center;">

            <!-- Change Photo Form -->
            <form action="{{ route('manage_reg_login.updatePhoto') }}" method="POST" enctype="multipart/form-data" style="width: 100%; text-align: center;">
                @csrf
                <input type="file" name="photo" hidden id="uploadPhoto" onchange="this.form.submit()">
                <button type="button" class="edit-button" onclick="document.getElementById('uploadPhoto').click()">Change Photo</button>
            </form>

            <!-- Remove Photo Form -->
            <form action="{{ route('manage_reg_login.removePhoto') }}" method="POST" style="width: 100%; text-align: center;">
                @csrf
                <button type="submit" class="edit-button" style="background-color: #c62828;">Remove Photo</button>
            </form>
            
        </div>
    </div>

    <!-- Profile Info -->
    <div class="profile-info">
        <button class="edit-button" onclick="window.location='{{ route('manage_reg_login.editProfile') }}'">Edit Profile</button>

        <div class="form-row">
            <label><i class="fas fa-user"></i> Name</label>
            <div class="form-value">{{ $user->name }}</div>
        </div>

        <div class="form-row">
            <label><i class="fas fa-user-circle"></i> Username</label>
            <div class="form-value">{{ $user->username }}</div>
        </div>

        <div class="form-row">
            <label><i class="fas fa-envelope"></i> Email</label>
            <div class="form-value">{{ $user->email }}</div>
        </div>

        <div class="form-row">
            <label><i class="fas fa-phone"></i> Phone Number</label>
            <div class="form-value">{{ $user->phone }}</div>
        </div>

        <div class="form-row">
            <label><i class="fas fa-calendar"></i> Date of Birth</label>
            <div class="form-value">{{ \Carbon\Carbon::parse($user->dob)->format('d/m/Y') }}</div>
        </div>

        <div class="form-row">
            <label><i class="fas fa-map-marker-alt"></i> Address</label>
            <div class="form-value">{{ $user->address ?? 'None' }}</div>
        </div>
    </div>

</div>

<!-- Dropdown Menu Script -->
<script>
    const profileIcon = document.querySelector('.profile-icon');
    const dropdownMenu = document.querySelector('.dropdown-menu');

    profileIcon?.addEventListener('click', () => {
        dropdownMenu.style.display = dropdownMenu.style.display === 'flex' ? 'none' : 'flex';
    });
</script>

@endsection