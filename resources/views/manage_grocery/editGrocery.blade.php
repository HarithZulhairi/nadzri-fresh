@extends('layouts.app') {{-- Assuming you use a layout --}}

@section('content')

<style>
.grocery-edit-container {
    padding: 20px;
    max-width: 600px;
    margin: auto;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.grocery-edit-container label {
    display: block;
    margin-top: 10px;
}

.grocery-edit-container input {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.btn-save {
    background-color: #99975a;
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 6px;
    cursor: pointer;
}
</style>


<div class="grocery-edit-container">
    <h2>Edit Grocery</h2>

    <form action="{{ route('manage_grocery.updateGrocery', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="image-section">
            <img src="{{ asset('storage/' . $product->product_picture_path) }}" alt="{{ $product->product_name }}" style="width: 150px;">
        </div>

        <label>Product Name</label>
        <input type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}" required>

        <label>Description</label>
        <input type="text" name="product_description" value="{{ old('product_description', $product->product_description) }}" required>

        <label>Category</label>
        <input type="text" name="product_category" value="{{ old('product_category', $product->product_category) }}" required>

        <label>Product ID</label>
        <input type="text" value="{{ $product->product_id }}" disabled>

        <label>Discount</label>
        <input type="number" name="product_discount" step="0.01" min="0" max="100" value="{{ old('product_discount', $product->product_discount) }}">

        <label>Price</label>
        <input type="text" name="product_price" value="{{ old('product_price', $product->product_price) }}" required>

        <label>Supplier</label>
        <input type="text" name="product_supplier" value="{{ old('product_supplier', $product->product_supplier) }}" required>

        <button type="submit" class="btn-save">Save</button>
    </form>
</div>
@endsection
