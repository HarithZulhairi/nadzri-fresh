@extends('layouts/headerFooter')

@section('content')

<style>
    /* Waste Management Styles */
    .waste-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .waste-list {
        margin-top: 2rem;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .waste-item {
        background-color: #f9f9f9;
        border-left: 4px solid #e74c3c;
        padding: 1rem;
        border-radius: 4px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .waste-item h3 {
        color: #2e8b57;
        margin-bottom: 0.5rem;
    }

    .waste-item p {
        color: #555;
        margin-bottom: 0.5rem;
    }

    .add-waste-btn {
        background-color: #e74c3c;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .add-waste-btn:hover {
        background-color: #c0392b;
    }
</style>

<div class="waste-container">
    <h1>Add Waste Product</h1>
    
    <div class="waste-list">
        <div class="waste-item">
            <h3>Red Spinach</h3>
            <p>Status: Expired</p>
            <p>2 March 2025</p>
            <button class="add-waste-btn">Add to waste</button>
        </div>
        
        <div class="waste-item">
            <h3>Gardenia Bread</h3>
            <p>Status: Damaged</p>
            <p>19 March 2025</p>
            <button class="add-waste-btn">Add to waste</button>
        </div>
        
        <div class="waste-item">
            <h3>Carrots</h3>
            <p>Status: Almost Expired</p>
            <p>25 March 2025</p>
            <button class="add-waste-btn">Add to waste</button>
        </div>
    </div>
</div>
@endsection