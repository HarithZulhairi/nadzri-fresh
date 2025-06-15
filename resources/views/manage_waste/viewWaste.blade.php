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

    .search-filter-container {
        background-color: #f5f5f5;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .search-filter-container input[type="text"],
    .search-filter-container input[type="date"],
    .search-filter-container select {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }

    .search-btn, .filter-btn, .reset-btn {
        transition: background-color 0.3s;
    }

    .search-btn:hover {
        background-color: #6e703d !important;
    }

    .filter-btn:hover {
        background-color: #6e3d3d !important;
    }

    .reset-btn:hover {
        background-color: #4d4d4d !important;
    }
</style>

<div class="waste-container">
    <h1>Waste Product List</h1>
    <div class="search-filter-container" style="margin: 20px 0; display: flex; flex-wrap: wrap; gap: 15px; align-items: center; justify-content: center;">
        <!-- Search Form -->
        <form method="GET" action="{{ route('manage_waste.viewWaste') }}" style="display: flex; gap: 10px;">
            <input type="text" name="search" placeholder="Search products..." 
                value="{{ $searchTerm }}" class="form-control" style="padding: 10px; border-radius: 4px; width: 500px;">
            <button type="submit" class="search-btn" style="background-color: #8D8F55; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">
                Search
            </button>
        </form>

        <!-- Filter Button (Triggers Modal) -->
        <button onclick="showFilterModal()" class="filter-btn" style="background-color: #8F5555; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">
            Filter
        </button>

        <!-- Reset Button -->
        <a href="{{ route('manage_waste.viewWaste') }}" class="reset-btn" style="background-color: #686868; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; text-decoration: none;">
            Reset
        </a>
    </div>

    <!-- Filter Modal -->
    <div id="filterModal" class="confirmation-modal">
        <div class="modal-content" style="width: 600px;">
            <h3>Filter Waste Products</h3>
            
            <form method="GET" action="{{ route('manage_waste.viewWaste') }}" id="filterForm">
                <!-- Status Filter -->
                <div style="margin: 20px 0;">
                    <label style="display: block; margin-bottom: 8px; font-size: 18px;">Status:</label>
                    <select name="status" class="form-control" style="padding: 10px; width: 100%;">
                        <option value="all" {{ $selectedStatus == 'all' ? 'selected' : '' }}>All Statuses</option>
                        <option value="Expired" {{ $selectedStatus == 'Expired' ? 'selected' : '' }}>Expired</option>
                        <option value="Donated" {{ $selectedStatus == 'Donated' ? 'selected' : '' }}>Donated</option>
                        <option value="Damaged" {{ $selectedStatus == 'Damaged' ? 'selected' : '' }}>Damaged</option>
                        <option value="Disposed" {{ $selectedStatus == 'Disposed' ? 'selected' : '' }}>Disposed</option>
                        <option value="Almost Expired" {{ $selectedStatus == 'Almost Expired' ? 'selected' : '' }}>Almost Expired</option>
                    </select>
                </div>
                
                <!-- Date Range Filter -->
                <div style="margin: 20px 0;">
                    <label style="display: block; margin-bottom: 8px; font-size: 18px;">Expiry Date Range:</label>
                    <div style="display: flex; gap: 10px; justify-content: center;">
                        <input type="date" name="date_from" value="{{ $dateFrom }}" class="form-control" style="padding: 10px;">
                        <span style="align-self: center;">to</span>
                        <input type="date" name="date_to" value="{{ $dateTo }}" class="form-control" style="padding: 10px;">
                    </div>
                </div>
                
                <!-- Hidden search field to maintain search term -->
                <input type="hidden" name="search" value="{{ $searchTerm }}">
                
                <div class="modal-actions">
                    <button type="submit" class="confirm-btn">Apply Filters</button>
                    <button type="button" onclick="hideFilterModal()" class="cancel-btn">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="waste-list">
        @foreach($products as $product)
            @if($product->product_waste == 1)
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
                                @elseif($product->product_status == 'Donated') status-donated
                                @elseif($product->product_status == 'Damaged') status-damaged
                                @elseif($product->product_status == 'Almost Expired') status-almost-expired
                                @elseif($product->product_status == 'Disposed') status-disposed
                                @endif
                            ">
                                {{ $product->product_status }}
                            </span>
                        </p>
                        @if($product->product_status == 'Disposed')
                            <p style="color: green">Disposed on {{ \Carbon\Carbon::parse($product->disposed_at)->format('d M Y') }}</p>
                        @else
                            <p class="date-expired" style="color: red;">
                                {{ \Carbon\Carbon::parse($product->product_expiryDate)->format('d M Y') }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="button-add-waste">
                    <a href="{{ route('manage_waste.editWaste', $product->product_ID) }}" class="edit-waste-btn">Edit Status</a>
                    @if($product->product_status == 'Disposed')
                        <button onclick="showDeleteConfirmation('{{ $product->product_ID }}')" class="delete-waste-btn">Delete</button>
                    @else
                        <button onclick="showDisposeConfirmation('{{ $product->product_ID }}')" class="dispose-waste-btn">Dispose</button>
                    @endif
                </div>
            </div>
            @endif
        @endforeach

        @if($products->where('product_waste', 1)->count() == 0)
            <div class="no-products">
                <p>No waste products found.</p>
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

    function showFilterModal() {
        document.getElementById('filterModal').style.display = 'flex';
    }

    function hideFilterModal() {
        document.getElementById('filterModal').style.display = 'none';
    }

</script>
@endsection