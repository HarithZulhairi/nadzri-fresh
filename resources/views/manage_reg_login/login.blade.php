@extends('layouts/footer')

@section('content')

<style>
    body { 
        background-color: #fef9ed; 
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
    } 

    h1 {
        color: black;
    }
    
    .login-container { 
        display: flex; 
        justify-content: center; 
        align-items: center; 
        min-height: 90vh; 
        padding: 20px;
    } 
        
    .login-card { 
        display: flex; 
        background: #fff; 
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); 
        border-radius: 10px; 
        overflow: hidden; 
        max-width: 1100px; 
        width: 100%; 
    } 
        
    .login-left { 
        height: 500px;
        width: 600px; 
        background-color: #769d71; 
        color: white; 
        padding: 40px; 
        display: flex; 
        flex-direction: column; 
        justify-content: left;
        border-radius: 15px 0px 0px 15px;
    } 
        
    .login-left h1 { 
        font-size: 32px; 
        font-weight: bold; 
        margin-bottom: 10px; 
    } 
        
    .login-left h2 { 
        font-size: 20px; 
        margin-bottom: 20px; 
        font-weight: normal; 
    } 
            
    .login-left p { 
        font-size: 15px; 
        line-height: 1.6; 
    } 
        
    .login-right { 
        height: 500px;
        width: 400px;
        background-color:rgb(255, 255, 255); 
        padding: 40px; 
        display: flex; 
        flex-direction: column; 
        justify-content: center; 
        border: groove; 
        border-radius: 0px 15px 15px 0px;

    } 
    
    .login-logo { 
        text-align: center; 
        margin-bottom: 20px;
         
    } 
    
    .login-logo img { 
        width: 150px; 
    } 
    
    .login-form { 
        display: flex; 
        flex-direction: column; 
        gap: 15px; 
    } 
    
    .login-form input, .login-form select { 
        padding: 12px 14px; 
        font-size: 15px; 
        border: 1px solid #ccc; 
        border-radius: 30px; 
        outline: none; 
        background-color: #f0f0f0; 
        width: 100%; 
        box-sizing: border-box; 
    } 
    
    .login-form button { 
        margin: auto;
        width: 150px;
        background-color: #333; 
        color: white; 
        padding: 10px; 
        border: none; 
        border-radius: 30px; 
        font-size: 16px; 
        cursor: pointer; 
        transition: background-color 0.3s ease; 
    } 
    
    .login-form button:hover { 
        background-color: #555; 
    } 
    
    .login-links { 
        display: flex; 
        justify-content: space-between; 
        font-size: 14px; 
        margin-top: 10px; 
    } 
    
    .login-links a { 
        color: #888; 
        text-decoration: none; 
    } 
        
    .login-links a:hover { 
        text-decoration: underline; 
    } 
    
    .contact-footer { 
        text-align: center; 
        font-size: 14px; 
        margin-top: 30px; 
        color: #555; 
    }
    
    .grocery-pic img{
        width: 380px;
    }

    .grocery-pic {
        text-align: center; 

    }
</style>

<div class="login-container">
    <!-- Left Section -->
    <div class="login-left">
        <h1>Never Run Out of Stock Again</h1>
        <h2>Manage Your Groceries with Ease!</h2>
        <p>
            Managing your grocery stock has never been easier. Keep track of every item, reduce waste, and ensure your shelves are always stocked with fresh products. Whether you're running a supermarket, a convenience store, or a home pantry, our system helps you monitor inventory levels, track expiration dates, and streamline your supply chain. Log in now and take control of your grocery inventory with efficiency and ease!
        </p>
        <div class="grocery-pic">
            <img src="{{ asset('uploads/grocerypic.png') }}" alt="Grocery Pictures">
        </div>
    </div>

    <!-- Right Section -->
    <div class="login-right">
        <div class="login-logo">
            <img src="{{ asset('uploads/Nadzri-fresh-logo.png') }}" alt="Nadzri Fresh Logo">
        </div>
        <h3 style="text-align:center; margin-bottom:20px;">User Login</h3>
        <form class="login-form" method="POST" action="{{ route('manage_reg_login.login.submit') }}">
            @csrf
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>

            <select name="role" required>
                <option value="">Select User</option>
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
            </select>

            <button type="submit">Login</button>

            <div class="login-links">
                <a href="{{ route('manage_reg_login.register') }}">Create an account</a>
                <a href="">Forgot password?</a>
            </div>
        </form>

        @if ($errors->has('login_error'))
            <div style="color: red; text-align: center; margin-top: 10px;">
                {{ $errors->first('login_error') }}
            </div>
        @endif

    </div>
</div>

@endsection