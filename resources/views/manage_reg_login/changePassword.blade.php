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

    .password-feedback {
        font-size: 0.9rem;
        margin-top: 4px;
        padding-left: 5px;
        color: #555;
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
    <form id="passwordForm" method="POST" action="{{ route('manage_reg_login.updatePassword') }}">
        @csrf

        @if(session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 8px; margin-bottom: 1rem;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 8px; margin-bottom: 1rem;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label>Current Password*</label>
            <input type="password" name="current_password" id="currentPassword" placeholder="Enter Current Password" required>
        </div>

        <div class="form-group">
            <label>New Password*</label>
            <input type="password" name="new_password" id="newPassword" placeholder="Enter New Password" required>
        </div>

        <div class="form-group">
            <label>Confirm New Password*</label>
            <input type="password" name="new_password_confirmation" id="confirmPassword" placeholder="Confirm New Password" required>
            <div id="passwordMatchFeedback" class="password-feedback"></div>
        </div>

        <button type="submit" class="btn-update">Update Password</button>
    </form>
</div>

<script>
    const newPassword = document.getElementById('newPassword');
    const confirmPassword = document.getElementById('confirmPassword');
    const feedback = document.getElementById('passwordMatchFeedback');

    function checkPasswordMatch() {
        if (confirmPassword.value === '') {
            feedback.textContent = '';
            return;
        }

        if (newPassword.value === confirmPassword.value) {
            feedback.textContent = 'Passwords match.';
            feedback.style.color = 'green';
        } else {
            feedback.textContent = 'Passwords do not match.';
            feedback.style.color = 'red';
        }
    }

    newPassword.addEventListener('input', checkPasswordMatch);
    confirmPassword.addEventListener('input', checkPasswordMatch);

    // Handle submit validations
    document.getElementById('passwordForm').addEventListener('submit', function (e) {
        const current = newPassword.value.trim();
        const confirm = confirmPassword.value.trim();
        const old = document.getElementById('currentPassword').value.trim();

        if (!old || !current || !confirm) return true;

        if (current.length < 8) {
            alert('New password must be at least 8 characters.');
            e.preventDefault();
            return false;
        }

        if (current !== confirm) {
            alert('New password and confirmation do not match.');
            e.preventDefault();
            return false;
        }

        if (!confirmPassword.checkValidity()) {
            e.preventDefault();
            return false;
        }

        const confirmed = confirm('Are you sure you want to change your password?');
        if (!confirmed) e.preventDefault();
    });
</script>

@endsection
