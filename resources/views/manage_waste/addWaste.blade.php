@extends('layouts/headerFooter')

@section('content')
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