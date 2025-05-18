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

    .waste-item h3 {
        color: rgb(0, 0, 0);
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

    .add-waste-btn {
        background-color: #558F55;
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

    .add-waste-btn:hover {
        background-color:rgb(112, 201, 112);
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
    
    .status-damaged {
        color: #0C00B8;
        font-weight: bold;
    }
    
    .date-expired {
        color: red;
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
    <h1>Add Waste Product</h1>
    
    <div class="waste-list">
        @foreach($products as $product)
            @if($product->product_status !== 'Good' && !$product->product_waste)
            <div class="waste-item">
                <div class="waste-item-content">
                    <div class="waste-image-1">
                        <img src="{{ asset('storage/' . $product->product_picture_path) }}" alt="{{ $product->product_name }}" class="product-image">
                    </div>
                    <div class="description-waste">
                        <h3>{{ $product->product_name }} 
                            <span style="color: orange;"><i class="fa-solid fa-triangle-exclamation"></i></span>
                        </h3>
                        <p>Status: 
                            <span class="
                                @if($product->product_status == 'Expired') status-expired
                                @elseif($product->product_status == 'Almost Expired') status-almost-expired
                                @elseif($product->product_status == 'Damaged') status-damaged
                                @endif
                            ">
                                {{ $product->product_status }}
                            </span>
                        </p>
                        <p class="date-expired" style="color: red;">
                            {{ \Carbon\Carbon::parse($product->product_expiryDate)->format('d M Y') }}
                        </p>
                    </div>
                </div>
                <div class="button-add-waste">
                    <button onclick="showConfirmationModal('{{ $product->product_ID }}')" class="add-waste-btn">Add to waste</button>
                </div>
            </div>
            @endif
        @endforeach
        
        @if($products->whereIn('product_status', ['Almost Expired', 'Expired', 'Damaged'])->where('product_waste', false)->count() == 0)
            <div class="no-products">
                <p>No waste products found.</p>
            </div>
        @endif
    </div>
</div>

<!-- Confirmation Modal -->
<div id="confirmationModal" class="confirmation-modal">
    <div class="modal-content">
        <h3 style="text-align: center;">Are you sure you want to add this product to waste list?</h3>
        <div class="modal-actions">
            <form id="confirmForm" method="POST" action="">
                @csrf
                @method('PATCH')
                <button type="submit" class="confirm-btn">Yes</button>
            </form>
            <button onclick="hideConfirmationModal()" class="cancel-btn">No</button>
        </div>
    </div>
</div>

<script>
    function showConfirmationModal(productId) {
        const modal = document.getElementById('confirmationModal');
        const form = document.getElementById('confirmForm');
        
        // Set the form action with the product ID
        form.action = `/waste/mark-as-waste/${productId}`;
        
        // Show the modal
        modal.style.display = 'flex';
    }

    function hideConfirmationModal() {
        const modal = document.getElementById('confirmationModal');
        modal.style.display = 'none';
    }
</script>
@endsection