@extends('layouts.headerFooter')

@section('content')
@if(isset($product))
<style>
        .grocery-detail-card {
        max-width: 900px;
        margin: 40px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        display: flex;
        gap: 40px;
    }

    .grocery-detail-card img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 12px;
    }

    .grocery-detail-card .grocery-info {
        flex: 1;
    }

    .grocery-detail-card label {
        font-weight: bold;
        display: block;
        margin-top: 10px;
    }

    .grocery-detail-card input {
        width: 100%;
        padding: 8px 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 6px;
        background-color: #f9f9f9;
    }

    .grocery-detail-card .form-row {
        display: flex;
        gap: 20px;
    }

    .grocery-detail-card .form-row > div {
        flex: 1;
    }

    .grocery-detail-card .button-row {
        margin-top: 20px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .btn-edit, .btn-delete {
        padding: 8px 16px;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .btn-edit {
        background-color: #99985B;
        color: white;
    }

    .btn-edit:hover {
        background-color: #7e7d4a;
    }

    .btn-delete {
        background-color: #e74c3c;
        color: white;
    }

    .btn-delete:hover {
        background-color: #c0392b;
    }
</style>

<div class="grocery-detail-card">
    <img src="{{ asset('storage/' . $product->product_picture_path) }}" alt="{{ $product->product_name }}">

    <div class="grocery-info">
        <form action="{{ route('manage_grocery.updateGrocery', $product->product_ID) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label>Product Name</label>
            <input type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}" required>

            <label>Description</label>
            <input type="text" name="product_description" value="{{ old('product_description', $product->product_description) }}" required>

            <div class="form-row">
                <div>
                    <label>Category</label>
                    <input type="text" value="{{ $product->product_category }}" disabled>
                </div>
                <div>
                    <label>Product ID</label>
                    <input type="text" value="{{ $product->product_code }}" disabled>
                </div>
                <div>
                    <label>Discount</label>
                    <input type="number" name="product_discount" value="{{ old('product_discount', $product->product_discount) }}" min="0" max="100" step="0.01">
                </div>
            </div>

            <label>Price</label>
            <input type="number" name="product_price" value="{{ old('product_price', $product->product_price) }}" min="0" step="0.01" required>

            <label>Supplier</label>
            <input type="text" value="{{ $product->product_supplier }}" disabled>

            <div class="button-row">
                <button type="submit" class="btn-edit">Save</button>
                <a href="{{ route('manage_grocery.viewGrocery', $product->product_ID) }}">
                    <button type="button" class="btn-delete">Cancel</button>
                </a>
            </div>
        </form>
    </div>
</div>
@endif

@if($errors->any())
    <script>
        window.onload = function() {
            alert("{{ implode('\n', $errors->all()) }}");
        }
    </script>
@endif
@endsection