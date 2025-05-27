@extends('layouts/headerFooter')

@section('content')

<style>
    .edit-container {
        max-width: 700px;
        margin: 2rem auto;
        background: #fff;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }

    .edit-container h2 {
        margin-bottom: 1.5rem;
        font-size: 1.8rem;
        font-weight: bold;
    }

    .form-group {
        margin-bottom: 1.2rem;
    }

    label {
        font-weight: bold;
        margin-bottom: 0.3rem;
        display: inline-block;
    }

    input[type="text"],
    input[type="email"],
    select,
    textarea {
        width: 100%;
        padding: 12px 18px;
        border: none;
        border-radius: 20px;
        background-color: #e9e9e9;
        font-size: 1rem;
    }

    .dob-selects {
        display: flex;
        gap: 1rem;
    }

    .dob-selects select {
        flex: 1;
    }

    .button-group {
        margin-top: 2rem;
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    .btn-cancel,
    .btn-save {
        border: none;
        padding: 10px 24px;
        border-radius: 20px;
        font-weight: bold;
        font-size: 1rem;
        cursor: pointer;
    }

    .btn-cancel {
        background: #999;
        color: #fff;
    }

    .btn-save {
        background: #4CAF50;
        color: #fff;
    }

    
</style>

<div class="edit-container">
    <h2>Edit Profile</h2>
    <form action="{{ route('manage_reg_login.updateProfile') }}" method="POST" onsubmit="return confirmProfileUpdate()">
        @csrf
        @method('PUT') 

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="{{ $user->name }}">
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" id="usernameInput" value="{{ $user->username }}">
            <span id="usernameFeedback" style="font-size: 0.9rem;"></span>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" id="emailInput" value="{{ $user->email }}">
            <span id="emailFeedback" style="font-size: 0.9rem;"></span>
        </div>

        <div class="form-group">
            <label>Phone Number</label>
            <input type="text" name="phone" value="{{ $user->phone }}">
        </div>

        <div class="form-group">
            <label>Date of Birth</label>
            <input type="date" name="dob" value="{{ $user->dob }}">
        </div>

        <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" value="{{ $user->address }}">
        </div>

        <div class="button-group">
            <a href="{{ route('manage_reg_login.profile') }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-save">Save</button>
        </div>
    </form>

</div>

<script>
    function confirmProfileUpdate() {
        return confirm("Are you sure you want to save these profile changes?");
    }

    document.getElementById('usernameInput').addEventListener('input', function () {
        const username = this.value;
        const feedback = document.getElementById('usernameFeedback');

        if (username.length < 3) {
            feedback.textContent = 'Username too short.';
            feedback.style.color = 'orange';
            return;
        }

        fetch('{{ route("check.username") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ username })
        })
        .then(response => response.json())
        .then(data => {
            if (data.available) {
                feedback.textContent = 'Username is available.';
                feedback.style.color = 'green';
            } else {
                feedback.textContent = 'Username is already taken.';
                feedback.style.color = 'red';
            }
        });
    });

let emailTimeout;

document.getElementById('emailInput').addEventListener('input', function () {
    clearTimeout(emailTimeout);
    
    const email = this.value.trim();
    const feedback = document.getElementById('emailFeedback');

    if (!email.includes('@') || email.length < 5) {
        feedback.textContent = '';
        return;
    }

    emailTimeout = setTimeout(() => {
        fetch('{{ route("check.email") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ email })
        })
        .then(response => response.json())
        .then(data => {
            if (data.available) {
                feedback.textContent = 'Email is available.';
                feedback.style.color = 'green';
            } else {
                feedback.textContent = 'Email is already registered.';
                feedback.style.color = 'red';
            }
        })
        .catch(() => {
            feedback.textContent = 'Error checking email.';
            feedback.style.color = 'red';
        });
    }, 500);
});

</script>


@endsection
