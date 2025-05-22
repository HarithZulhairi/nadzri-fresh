@extends('layouts/headerFooter')

@section('content')

<style>
    .password-container {
        max-width: 500px;
        margin: 2rem auto;
        padding: 2rem;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        text-align: center;
    }

    .password-container h2 {
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
    }

    .form-group {
        position: relative;
        margin-bottom: 1.5rem;
        text-align: left;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 0.3rem;
    }

    input[type="password"] {
        width: 100%;
        padding: 12px 40px 12px 16px;
        border: none;
        border-radius: 20px;
        background-color: #e9e9e9;
        font-size: 1rem;
    }

    .btn-update {
        background-color: #4CAF50;
        color: white;
        padding: 10px 24px;
        border: none;
        border-radius: 25px;
        font-weight: bold;
        font-size: 1rem;
        cursor: pointer;
    }
</style>

<div class="password-container">
    <h2>Change Password</h2>
    <form>
        <div class="form-group">
            <label>Current Password*</label>
            <input type="password" placeholder="Enter Current Password" id="currentPassword">
        </div>

        <div class="form-group">
            <label>New Password*</label>
            <input type="password" placeholder="Enter New Password" id="newPassword">
        </div>

        <div class="form-group">
            <label>Confirm New Password*</label>
            <input type="password" placeholder="Enter Confirm New Password" id="confirmPassword">
        </div>

        <button type="submit" class="btn-update">Update Password</button>
    </form>
</div>

<script>
    function togglePassword(fieldId) {
        const input = document.getElementById(fieldId);
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
</script>

@endsection
