@extends('layouts/headerFooter')

@section('content')

<style>
    .profile-container {
        max-width: 1000px;
        margin: 2rem auto;
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        align-items: flex-start;
    }

    .profile-card, .profile-info {
        background-color: #fff;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }

    .profile-card {
        flex: 1 1 250px;
        text-align: center;
    }

    .profile-info {
        flex: 2 1 600px;
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

    .icon-row {
        display: flex;
        align-items: center;
        margin: 10px 0;
    }

    .icon-row i {
        margin-right: 10px;
        font-size: 1.2rem;
    }
</style>

<div class="profile-container">
    <!-- Profile Card -->
    <div class="profile-card">
        <img src="{{ asset('uploads/grocerypic.png') }}" alt="Profile" class="profile-img">
        <form action="') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="photo" hidden id="uploadPhoto">
            <button type="button" class="edit-button" onclick="document.getElementById('uploadPhoto').click()">Change Photo</button>
        </form>
    </div>

    <!-- Profile Info -->
    <div class="profile-info">
        <button class="edit-button" onclick="window.location='{{ route('manage_reg_login.editProfile') }}'">Edit Profile</button>

        <div class="icon-row"><i class="fas fa-user"></i> <strong>Name: </strong> Limah Binti Daud</div>
        <div class="icon-row"><i class="fas fa-user-circle"></i> <strong>Username: </strong> limahdaud</div>
        <div class="icon-row"><i class="fas fa-envelope"></i> <strong>Email: </strong> limah@gmail.com</div>
        <div class="icon-row"><i class="fas fa-phone"></i> <strong>Phone: </strong> 0123456789</div>
        <div class="icon-row"><i class="fas fa-calendar"></i> <strong>Date of Birth: </strong> 6/8/1985</div>
        <div class="icon-row"><i class="fas fa-map-marker-alt"></i> <strong>Address: </strong> None</div>
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