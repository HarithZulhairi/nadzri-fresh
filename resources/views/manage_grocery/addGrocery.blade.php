@extends('layouts.headerFooter')

@section('content')
<style>
    .container-box {
        max-width: 1000px;
        margin: 40px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .form-section {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }
    .form-left, .form-right {
        flex: 1;
        min-width: 300px;
    }
    .form-group {
        margin-bottom: 15px;
    }
    label {
        display: block;
        font-weight: 600;
        margin-bottom: 5px;
    }
    input[type="text"],
    input[type="number"],
    textarea,
    select {
        width: 100%;
        padding: 8px 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
    }
    .save-btn {
        background-color: olive;
        color: white;
        padding: 10px 25px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        float: right;
    }
    .product-image {
        text-align: center;
    }
    .product-image img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 10px;
    }
</style>

<div class="container-box">
    <h2 style="margin-bottom: 20px;">Add Grocery</h2>

    <form action="{{ route('manage_grocery.storeGrocery') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-section">
            <!-- Image upload section -->
            <div class="form-left product-image">
                <img src="{{ asset('images/default-onion.png') }}" alt="Grocery Image">
                <input type="file" name="product_picture_path">
            </div>

            <!-- Form input section -->
            <div class="form-right">
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" name="product_name" required>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="product_description" rows="2"></textarea>
                </div>

                <div class="form-group" style="display: flex; gap: 15px;">
                    <div style="flex: 1;">
                        <label>Category</label>
                        <select name="product_category" required>
                            <option value="Vegetable">Vegetable</option>
                            <option value="Fruit">Fruit</option>
                            <option value="Dairy">Dairy</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input type="number" step="0.01" name="product_price" required>
                </div>

                <div class="form-group">
                    <label>Supplier</label>
                    <input type="text" name="product_supplier">
                </div>

                <div style="margin-top: 20px;">
                    <button type="submit" class="save-btn">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
