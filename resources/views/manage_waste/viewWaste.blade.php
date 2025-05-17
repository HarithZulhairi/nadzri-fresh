@extends('layouts/headerFooter')

@section('content')

<style>
    /* Waste Management Styles */
    .waste-container {
        max-width: 80%;
        margin: 0 auto;
    }

    .waste-list {
        margin-top: 2rem;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .waste-item {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        background-color: #f9f9f9;
        border: 1px solid black;
        padding: 1rem;
        border-radius: 4px;
    }

    .waste-item-content {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-grow: 1;
    }

    .waste-image-1 {
        width: 60px;
        height: 60px;
        background-color: #ddd; /* Placeholder color */
        border-radius: 4px;
    }

    .description-waste {
        flex-grow: 1;
    }

    .waste-item h3 {
        color:rgb(0, 0, 0);
        font-size: 24px;
        margin-bottom: 0.5rem;
    }

    .waste-item p {
        color: #555;
        margin-bottom: 0.5rem;
        font-size: 20px;
    }

    .button-add-waste {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-left: 1rem;
        
    }

    .edit-waste-btn {
        background-color: #8D8F55;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 40px;
        cursor: pointer;
        transition: background-color 0.3s;
        white-space: nowrap;
        font-size: 20px;
        font-weight: bold;
        padding: 20px;
        margin-right: 20px;
    }

    .dispose-waste-btn {
        background-color: #8F5555;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 40px;
        cursor: pointer;
        transition: background-color 0.3s;
        white-space: nowrap;
        font-size: 20px;
        font-weight: bold;
        padding: 20px;
    }

    .dispose-waste-btn:hover {
        background-color: #c0392b;
    }

    .edit-waste-btn:hover {
        background-color:rgb(90, 101, 37);
    }
</style>

<div class="waste-container">
    <h1>Waste Product List</h1>
    
    <div class="waste-list">

        <div class="waste-item">
            <div class="waste-item-content">
                <div class="waste-image-1"><img></div>
                <div class="description-waste">
                    <h3>Red Spinach</h3>
                    <p>Status: <span style="color: #F58F00; font-weight: bold;">Expired</span></p>
                    <p style="color: red">2 March 2025</p>
                </div>
            </div>
            <div class="button-add-waste">
                <button class="edit-waste-btn">Edit Product</button>
                <button class="dispose-waste-btn">Dispose</button>
            </div>
        </div>
        
        <div class="waste-item">
            <div class="waste-item-content">
                <div class="waste-image-1"><img></div>
                <div class="description-waste">
                    <h3>Gardenia Bread</h3>
                    <p>Status: <span style="color: #0C00B8; font-weight: bold;">Damaged</span></p>
                    <p style="color: red">19 March 2025</p>
                </div>
            </div>
            <div class="button-add-waste">
                <button class="edit-waste-btn">Edit Product</button>
                <button class="dispose-waste-btn">Dispose</button>
            </div>
        </div>
        
        <div class="waste-item">
            <div class="waste-item-content">
                <div class="waste-image-1"><img></div>
                <div class="description-waste">
                    <h3>Carrots</h3>
                    <p>Status: <span style="color: #B8B200; font-weight: bold;">Almost Expired</span></p>
                    <p style="color: red">25 March 2025</p>
                </div>
            </div>
            <div class="button-add-waste">
                <button class="edit-waste-btn">Edit Product</button>
                <button class="dispose-waste-btn">Dispose</button>
            </div>
        </div>

        <div class="waste-item">
            <div class="waste-item-content">
                <div class="waste-image-1"><img></div>
                <div class="description-waste">
                    <h3>Dutch Lady Milk - Full cream</h3>
                    <p>Status: <span style="color: #686868; font-weight: bold;">Disposing</span></p>
                    <p style="color: green">Requesting dispose on 25 March 2025</p>
                </div>
            </div>
            <div class="button-add-waste">
                <button class="edit-waste-btn">Edit Product</button>
                <button class="dispose-waste-btn">Dispose</button>
            </div>
        </div>

                <div class="waste-item">
            <div class="waste-item-content">
                <div class="waste-image-1"><img></div>
                <div class="description-waste">
                    <h3>Carrots</h3>
                    <p>Status: <span style="color: #686868; font-weight: bold;">Disposing</span></p>
                    <p style="color: green">Requesting dispose on 25 March 2025</p>
                </div>
            </div>
            <div class="button-add-waste">
                <button class="edit-waste-btn">Edit Product</button>
                <button class="dispose-waste-btn">Dispose</button>
            </div>
        </div>

    </div>
</div>
@endsection