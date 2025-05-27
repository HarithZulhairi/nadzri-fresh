@extends('layouts/headerFooter')

@section('content')
<style>
    /* Edit Waste Product Styles */
    .waste-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem;
    }

    .edit-form-container {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 2rem;
        margin-top: 1.5rem;
    }

    .image-section {
        margin: auto;
        text-align: center;
        width: fit-content;
    }

    .form-content {
        flex: 1;
        margin-top: 20px;
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

    textarea {
        width: 100%;
        min-height: 100px;
    }

    /* Confirmation Modal Styles */
    .confirmation-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: white;
        padding: 2rem;
        border-radius: 8px;
        width: 500px;
        max-width: 90%;
        font-size: 32px;
    }

    .modal-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 1.5rem;
    }

    .confirm-btn {
        background-color: #24B529;
        color: white;
        border: none;
        padding: 1rem 3rem;
        margin-left: 2rem;
        border-radius: 40px;
        cursor: pointer;
        transition: background-color 0.3s;
        white-space: nowrap;
        font-size: 28px;
        font-weight: bold;
    }

    .confirm-btn:hover {
        background-color:rgb(63, 218, 68);
    }

    .cancel-btn {
        background-color: #C62828;
        color: white;
        border: none;
        padding: 1rem 3rem;
        margin-right: 2rem;
        border-radius: 40px;
        cursor: pointer;
        transition: background-color 0.3s;
        white-space: nowrap;
        font-size: 28px;
        font-weight: bold;
    }

    .cancel-btn:hover {
        background-color: red;
    }
</style>

<div class="waste-container">
    <h1 style="text-align: center;">Add Product To Stock Form</h1>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form id="stockForm" method="POST" action="{{ route('manage_stock.addStockUpdate', $product->product_ID) }}" class="edit-form-container">
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
                <h2>Product Description</h2>
                <div class="form-group">
                    <textarea id="product_description" name="product_description" class="form-control" readonly>{{ $product->product_description }}</textarea>
                </div>
            </div>

            <div class="form-section">
                <h2>Product Category</h2>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{ $product->product_category }}" readonly>
                </div>
            </div>

            <div class="form-section">
                <h2>Product Price</h2>
                <div class="form-group">
                    <input type="number" class="form-control" value="{{ $product->product_price }}" readonly>
                </div>
            </div>

            <div class="form-section">
                <h2>Product Discount</h2>
                <div class="form-group">
                    <input type="number" class="form-control" value="{{ $product->product_discount }}" readonly>
                </div>
            </div>

            <div class="form-section">
                <h2>Current Status</h2>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{ $product->product_status }}" readonly>
                </div>
            </div>

            <div class="form-section">
                <h2>Product Supplier</h2>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{ $product->product_supplier }}" readonly>
                </div>
            </div>

            <div class="form-section">
                <h2>Expiry Date</h2>
                <div class="form-group">
                    <input type="date" class="form-control" value="{{ \Carbon\Carbon::parse($product->product_expiryDate)->format('Y-m-d') }}" readonly>
                </div>
            </div>

            <div class="form-section">
                <h2>Quantity</h2>
                <div class="form-group">
                    <input type="number" id="stock_quantity" name="stock_quantity" class="form-control" placeholder="Enter Quantity to be added to stocks" required>
                </div>
            </div>

            <div class="divider"></div>
            
            <div class="buttons">
                <button type="button" onclick="showConfirmationModal()" class="edit-btn">Add</button>
                <a href="{{ route('manage_stock.addStock') }}" class="back-btn">Cancel</a>
            </div>
        </div>
    </form>
</div>

<!-- Confirmation Modal -->
<div id="confirmationModal" class="confirmation-modal">
    <div class="modal-content">
        <h3 style="text-align: center;">Are you sure you want to add this product to stock?</h3>
        <p style="text-align: center; font-size: 18px; margin-top: 20px;">Quantity: <span id="confirmQuantity"></span></p>
        <div class="modal-actions">
            <button type="button" onclick="submitForm()" class="confirm-btn">Yes</button>
            <button type="button" onclick="hideConfirmationModal()" class="cancel-btn">No</button>
        </div>
    </div>
</div>

<script>
    function showConfirmationModal() {
        const quantity = document.getElementById('stock_quantity').value;
        
        if (!quantity || quantity <= 0) {
            alert('Please enter a valid quantity');
            return;
        }
        
        document.getElementById('confirmQuantity').textContent = quantity;
        document.getElementById('confirmationModal').style.display = 'flex';
    }

    function hideConfirmationModal() {
        document.getElementById('confirmationModal').style.display = 'none';
    }

    function submitForm() {
        document.getElementById('stockForm').submit();
    }
</script>
@endsection
