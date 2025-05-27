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

    .product-image {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 4px;
    }

    .description-waste {
        flex-grow: 1;
    }

    .waste-item p {
        color: #555;
        margin-bottom: 0.5rem;
        font-size: 20px;
    }

    .waste-item h3 {
        color: rgb(0, 0, 0);
        font-size: 24px;
        margin-bottom: 0.5rem;
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
        padding: 20px;
        border-radius: 40px;
        cursor: pointer;
        transition: background-color 0.3s;
        white-space: nowrap;
        font-size: 20px;
        font-weight: bold;
        margin-right: 20px;
        text-decoration: none;
    }

    .dispose-waste-btn {
        background-color: #8F5555;
        color: white;
        border: none;
        padding: 20px;
        border-radius: 40px;
        cursor: pointer;
        transition: background-color 0.3s;
        white-space: nowrap;
        font-size: 20px;
        font-weight: bold;
    }

    .delete-waste-btn {
        background-color: #C62828;
        color: white;
        border: none;
        padding: 20px;
        border-radius: 40px;
        cursor: pointer;
        transition: background-color 0.3s;
        white-space: nowrap;
        font-size: 20px;
        font-weight: bold;
    }

    .delete-waste-btn:hover {
        background-color: #FF0000;
    }

    .dispose-waste-btn:hover {
        background-color: #c0392b;
    }

    .edit-waste-btn:hover {
        background-color:rgb(90, 101, 37);
    }

    /* Status color classes */
    .status-expired {
        color: #F58F00;
        font-weight: bold;
    }

    .status-almost-expired {
        color: #B8B200;
        font-weight: bold;
    }
    
    .status-donated {
        color:rgb(20, 207, 3);
        font-weight: bold;
    }
    
    .status-damaged {
        color: #0C00B8;
        font-weight: bold;
    }

    .status-disposed {
        color: #686868;
        font-weight: bold;
    }
    
    .date-expired {
        color: red;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        padding: 1rem;
        border-radius: 4px;
        margin-bottom: 1rem;
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
        text-align: center;
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
    <h1>Product in Stock List</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="waste-list">
        @foreach($products as $product)
            @foreach($stocks->where('product_ID', $product->product_ID) as $stock)
                @if($product->product_inStock == 1)
                <div class="waste-item">
                    <div class="waste-item-content">
                        <div class="waste-image-1">
                            <img src="{{ asset('storage/' . $product->product_picture_path) }}" alt="{{ $product->product_name }}" class="product-image">
                        </div>
                        <div class="description-waste">
                            <h3>{{ $product->product_name }} <span style="font-weight: bold;">x{{ $stock->stock_quantity }}</span></h3>

                            <p class="product-description" >{{ $product->product_description }}</p>
                            <p class="product-price" ><span style="font-weight: bold;">Price: </span>RM{{ number_format($product->product_price, 2) }}</p>
                            <p class="product-discount" ><span style="font-weight: bold;">Discount: </span>{{ number_format($product->product_discount, 2) }}%</p>
                            <p class="product-description" ><span style="font-weight: bold;">Category: </span>{{ $product->product_category }}</p>
                            <p class="product-supplier" ><span style="font-weight: bold;">Supplier: </span>{{ $product->product_supplier }}</p>
                            <p class="product-date-expired"><span style="font-weight: bold;">Expired Date: </span>{{ \Carbon\Carbon::parse($product->product_expiryDate)->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="button-add-waste">
                        <a href="{{ route('manage_stock.editStock', ['product' => $product->product_ID, 'stock' => $stock->stock_ID]) }}" class="edit-waste-btn">Edit Stock</a>
                        <button onclick="showDeleteConfirmation('{{ $product->product_ID }}')" class="delete-waste-btn">Delete Product</button>
                    </div>
                </div>
                @endif
            @endforeach
        @endforeach

        @if($products->where('product_inStock', 1)->where('product_status', 'Good')->count() == 0)
            <div class="no-products">
                <p>No products currently in stock.</p>
            </div>
        @endif
    </div>
</div>

<!-- Dispose Confirmation Modal -->
<div id="disposeConfirmationModal" class="confirmation-modal">
    <div class="modal-content">
        <h3>Are you sure you want to dispose this product?</h3>
        <div class="modal-actions">
            <form id="disposeConfirmForm" method="POST" action="">
                @csrf
                @method('POST')
                <button type="submit" class="confirm-btn">Yes</button>
            </form>
            <button onclick="hideDisposeConfirmation()" class="cancel-btn">No</button>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteConfirmationModal" class="confirmation-modal">
    <div class="modal-content">
        <h3>Are you sure you want to permanently delete this product?</h3>
        <div class="modal-actions">
            <form id="deleteConfirmForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="confirm-btn">Yes</button>
            </form>
            <button onclick="hideDeleteConfirmation()" class="cancel-btn">No</button>
        </div>
    </div>
</div>

<script>
    function showDisposeConfirmation(productId) {
        const modal = document.getElementById('disposeConfirmationModal');
        const form = document.getElementById('disposeConfirmForm');
        form.action = `/waste/dispose/${productId}`;
        modal.style.display = 'flex';
    }

    function hideDisposeConfirmation() {
        document.getElementById('disposeConfirmationModal').style.display = 'none';
    }

    function showDeleteConfirmation(productId) {
        const modal = document.getElementById('deleteConfirmationModal');
        const form = document.getElementById('deleteConfirmForm');
        form.action = `/waste/delete/${productId}`;
        modal.style.display = 'flex';
    }

    function hideDeleteConfirmation() {
        document.getElementById('deleteConfirmationModal').style.display = 'none';
    }
</script>
@endsection