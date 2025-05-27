@extends('layouts.headerFooter')

@section('content')

@if(isset($product))
<!-- SINGLE PRODUCT VIEW DESIGN FROM YOUR IMAGE -->
<div class="grocery-detail-container">
    <img src="{{ asset('storage/' . $product->product_picture_path) }}" alt="{{ $product->product_name }}">

    <div class="grocery-info">
        <label>Product Name</label>
        <input type="text" value="{{ $product->product_name }}" disabled>

        <label>Description</label>
        <input type="text" value="{{ $product->product_description }}" disabled>

        <label>Category</label>
        <input type="text" value="{{ $product->product_category }}" disabled>

        <label>Product ID</label>
        <input type="text" value="{{ $product->product_id }}" disabled>

        <label>Discount</label>
        <input type="text" value="{{ $product->product_discount }}" disabled>

        <label>Price</label>
        <input type="text" value="{{ $product->product_price }}" disabled>

        <label>Supplier</label>
        <input type="text" value="{{ $product->supplier_name }}" disabled>

        <div style="margin-top: 20px;">
            <form action="{{ route('manage_grocery.deleteGrocery', $product->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">Delete</button>
            </form>
            <a href="{{ route('manage_grocery.editGrocery', $product->id) }}">
                <button class="btn-edit">Edit</button>
            </a>
        </div>
    </div>
</div>
@endif

@endsection
