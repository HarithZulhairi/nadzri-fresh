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
    <form>
        <div class="form-group">
            <label>Name</label>
            <input type="text" value="Limah Binti Daud" readonly>
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" value="limahdaud" readonly>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" value="limah@gmail.com" readonly>
        </div>

        <div class="form-group">
            <label>Phone Number</label>
            <input type="text" value="0123456789" readonly>
        </div>

        <div class="form-group">
            <label>Date of Birth</label>
            <div class="dob-selects">
                <select disabled>
                    <option selected>6</option>
                </select>
                <select disabled>
                    <option selected>8</option>
                </select>
                <select disabled>
                    <option selected>1985</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Address</label>
            <input type="text" value="No. 123, Jalan Jalan, Taman Indah" readonly>
        </div>

        <div class="button-group">
            <button type="button" class="btn-cancel">Cancel</button>
            <button type="submit" class="btn-save">Save</button>
        </div>
    </form>
</div>

@endsection
