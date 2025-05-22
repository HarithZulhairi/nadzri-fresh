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
</style>

<div class="register-container">
    <div class="register-card">
        <div class="register-logo">
            <img src="{{ asset('uploads/Nadzri-fresh-logo.png') }}" alt="Nadzri Fresh Logo">
        </div>

        <h2>Sign Up</h2>

        <form class="register-form" method="POST" action="">
            @csrf

            <input type="text" name="name" placeholder="Name*" required>
            <input type="text" name="username" placeholder="Username*" required>
            <input type="email" name="email" placeholder="Email*" required>

            <div class="form-row">
                <select name="country_code" required>
                    <option value="+60">+60</option>
                </select>
                <input type="text" name="phone" placeholder="Mobile Phone*" required>
            </div>

            <input type="date" name="dob" placeholder="Date Of Birth">
            <input type="password" name="password" placeholder="Password*" required>

            <select name="role" required>
                <option value="">Select User</option>
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
            </select>

            <button type="submit">Register</button>
        </form>
    </div>
</div>

@endsection