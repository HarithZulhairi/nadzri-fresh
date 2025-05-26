@extends('layouts/footer')

@section('content')

<style>
    body { 
        background-color: #fef9ed; 
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
    } 
    
    .register-container { 
        display: flex; 
        justify-content: center; 
        align-items: center; 
        padding: 40px 20px; 
    } 
    
    .register-card { 
        background: #fff; 
        border-radius: 15px; 
        box-shadow: 0 4px 10px rgba(0,0,0,0.1); 
        padding: 40px; 
        max-width: 450px; 
        width: 100%; 
        text-align: center; 
    } 
    
    .register-logo img { 
        width: 150px; 
        margin-bottom: 20px; 
    } 
    
    .register-card h2 { 
        font-size: 24px; 
        margin-bottom: 25px; 
        font-weight: bold; 
    } 
    
    .register-form { 
        display: flex; 
        flex-direction: column; 
        gap: 15px; 
    } 
    
    .register-form input, .register-form select { 
        padding: 12px 14px; 
        font-size: 15px; 
        border: 1px solid #ccc; 
        border-radius: 30px; 
        outline: none; 
        background-color: #f0f0f0; 
        width: 100%; 
        box-sizing: border-box; 
    } 
    
    .form-row { 
        display: flex; 
        gap: 10px; 
    } 
        
    .form-row select { 
        flex: 0 0 30%; 
    } 
    
    .form-row input[type="text"] { 
        flex: 1; 
    }
    
    .register-form button { 
        margin: auto;
        width: 150px;
        background-color: #333; 
        color: white; 
        padding: 12px; 
        font-size: 16px; 
        border: none; 
        border-radius: 30px; 
        cursor: pointer; 
        margin-top: 10px; 
        transition: background-color 0.3s; 
    } 
    
    .register-form button:hover { 
        background-color: #555; 
    }

    #usernameFeedback {
        text-align: left;
        color: #666;
        margin-top: -1px;
        margin-bottom: 1px;
        padding-left: 10px;
        font-size: 0.85rem;
        height: 5px; /* reserve space */
    }

    #passwordMatchFeedback {
        text-align: left;
        color: #666;
        margin-top: -7px;
        margin-bottom: 7px;
        padding-left: 10px;
        font-size: 0.85rem;
        height: 5px;
    }

</style>

<div class="register-container">
    <div class="register-card">
        <div class="register-logo">
            <img src="{{ asset('uploads/Nadzri-fresh-logo.png') }}" alt="Nadzri Fresh Logo">
        </div>

        <h2>Sign Up</h2>

        @if ($errors->any())
                <div style="color: red;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <form class="register-form" method="POST" action="register/store">
            @csrf

            <input type="text" name="name" placeholder="Name*" required>
            <div style="display: flex; flex-direction: column; align-items: flex-start;">
                <input type="text" name="username" id="usernameInput" placeholder="Username*" required>
                <span id="usernameFeedback"></span>
            </div>
            <input type="email" name="email" placeholder="Email*" required>

            <div class="form-row">
                <select name="country_code" required>
                    <option value="+60">+60</option>
                </select>
                <input type="text" name="phone" placeholder="Mobile Phone*" required>
            </div>

            <input type="date" name="dob" placeholder="Date Of Birth">
            <input type="password" name="password" placeholder="Password*" required>
            <input type="password" name="password_confirmation" id="confirmPasswordInput" placeholder="Confirm Password*" required>
            <span id="passwordMatchFeedback"></span>

            <select name="role" required>
                <option value="">Select User</option>
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
            </select>

            <button type="submit">Register</button>

            

        </form>
    </div>
</div>

<script>
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

    const passwordInput = document.querySelector('input[name="password"]');
    const confirmPasswordInput = document.getElementById('confirmPasswordInput');
    const passwordMatchFeedback = document.getElementById('passwordMatchFeedback');

    function checkPasswordMatch() {
        if (confirmPasswordInput.value === '') {
            passwordMatchFeedback.textContent = '';
            return;
        }

        if (passwordInput.value === confirmPasswordInput.value) {
            passwordMatchFeedback.textContent = 'Passwords match.';
            passwordMatchFeedback.style.color = 'green';
        } else {
            passwordMatchFeedback.textContent = 'Passwords do not match.';
            passwordMatchFeedback.style.color = 'red';
        }
    }

    passwordInput.addEventListener('input', checkPasswordMatch);
    confirmPasswordInput.addEventListener('input', checkPasswordMatch);


</script>

@if(session('register_success'))
<script>
    setTimeout(() => {
        if (confirm("{{ session('register_success') }}")) {
            window.location.href = "{{ route('manage_reg_login.login') }}";
        }
    }, 100);
</script>
@endif

@endsection