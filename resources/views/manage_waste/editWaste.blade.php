@extends('layouts/headerFooter')

@section('content')
<style>
    /* Edit Waste Product Styles */
    .waste-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem;
    }

    .edit-form-container {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 2rem;
        margin-top: 1.5rem;
        display: flex;
        gap: 2rem;
    }

    .image-section {
        flex: 0 0 200px;
    }

    .form-content {
        flex: 1;
    }

    .product-image {
        width: 100%;
        height: 200px;
        background-color: #eee;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .form-section {
        margin-bottom: 2rem;
    }

    .form-section h2 {
        color: black;
        margin-bottom: 0.5rem;
        font-size: 1.2rem;
        font-weight: 600;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
    }

    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 1em;
    }
    
    .buttons {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
    }

    .edit-btn {
        background-color: #8D8F55;
        color: white;
        border: none;
        padding: 1rem 4rem;
        border-radius: 20px;
        font-size: 20px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s;
        flex: 1;
    }

    .back-btn {
        background-color: rgb(139, 7, 7);
        color: white;
        border: none;
        padding: 1rem 4rem;
        border-radius: 20px;
        font-size: 20px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.3s;
        flex: 1;
        text-align: center;
        text-decoration: none;
    }

    .edit-btn:hover {
        background-color: #6e703d;
    }

    .back-btn:hover {
        background-color: rgb(170, 9, 9);
    }

    .divider {
        border-top: 1px solid #ddd;
        margin: 2rem 0;
    }

    @media (max-width: 768px) {
        .edit-form-container {
            flex-direction: column;
        }
        
        .image-section {
            flex: 0 0 auto;
            margin-bottom: 1.5rem;
        }
        
        .buttons {
            flex-direction: column;
        }
    }
</style>

<div class="waste-container">
    <h1>Edit Status of Waste Product</h1>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form method="POST" action="{{ route('products.updateWaste', $product->product_ID) }}" class="edit-form-container">
        @csrf
        @method('PUT')
        
        <div class="image-section">
            <div class="product-image">
                @if($product->product_picture_path)
                    <img src="{{ asset('storage/' . $product->product_picture_path) }}" alt="{{ $product->product_name }}">
                @else
                    <span>No Image</span>
                @endif
            </div>
        </div>

        <div class="form-content">
            <div class="form-section">
                <h2>Product Name</h2>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{ $product->product_name }}" readonly>
                </div>
            </div>

            <div class="form-section">
                <h2>Current Status</h2>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{ $product->product_status }}" readonly>
                </div>
            </div>

            <div class="form-section">
                <h2>New Status</h2>
                <div class="form-group">
                    <select name="product_status" class="form-control" required>
                        <option value="Donated" {{ $product->product_status == 'Donated' ? 'selected' : '' }}>Donated</option>
                        <option value="Expired" {{ $product->product_status == 'Expired' ? 'selected' : '' }}>Expired</option>
                        <option value="Damaged" {{ $product->product_status == 'Damaged' ? 'selected' : '' }}>Damaged</option>
                    </select>
                </div>
            </div>

            <div class="form-section">
                <h2>Expiry Date</h2>
                <div class="form-group">
                    <input type="date" class="form-control" value="{{ \Carbon\Carbon::parse($product->product_expiryDate)->format('Y-m-d') }}" readonly>
                </div>
            </div>

            <div class="divider"></div>
            
            <div class="buttons">
                <button type="submit" class="edit-btn">Edit</button>
                <a href="{{ route('manage_waste.viewWaste') }}" class="back-btn">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection