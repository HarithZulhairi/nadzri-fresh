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

    .btn-edit, .btn-delete , .btn-back {
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

    .btn-back {
        background-color:rgb(42, 104, 55);
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

    .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    .popup-content {
        background: white;
        padding: 30px 40px;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .popup-text {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .popup-button {
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-confirm {
        background-color: #e74c3c;
    }

    .btn-cancel {
        background-color: #999;
    }

    .btn-confirm:hover {
        background-color: #c0392b;
    }

    .btn-cancel:hover {
        background-color: #7d7d7d;
    }
</style>

<div class="grocery-detail-card">
    <img src="{{ asset('storage/' . $product->product_picture_path) }}" alt="{{ $product->product_name }}">

    <div class="grocery-info">
        <label>Product Name</label>
        <input type="text" value="{{ $product->product_name }}" disabled>

        <label>Description</label>
        <input type="text" value="{{ $product->product_description }}" disabled>

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
                <input type="text" value="{{ $product->product_discount }}" disabled>
            </div>
        </div>

        <label>Price</label>
        <input type="text" value="RM {{ $product->product_price }}" disabled>

        <label>Supplier</label>
        <input type="text" value="{{ $product->product_supplier }}" disabled>

        <div class="button-row">

            <a href="{{ route('manage_grocery.viewGroceryList') }}">
                <button class="btn-back">Back</button>
            </a>
        
            <form id="deleteForm" action="{{ route('manage_grocery.deleteGrocery', $product->product_ID) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="btn-delete" onclick="showDeleteModal()">Delete</button>
            </form>

            <a href="{{ route('manage_grocery.editGrocery', $product->product_ID) }}">
                <button class="btn-edit">Edit</button>
            </a>
        </div>
    </div>
</div>

<div id="deleteModal" class="popup-overlay" style="display:none;">
    <div class="popup-content">
        <p class="popup-text">⚠️ Are you sure you want to delete <strong>{{ $product->product_name }}</strong>?</p>
        <button onclick="submitDelete()" class="popup-button btn-confirm">Yes</button>
        <button onclick="closeDeleteModal()" class="popup-button btn-cancel">No</button>
    </div>
</div>

<script>
    function showDeleteModal() {
        document.getElementById('deleteModal').style.display = 'flex';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }

    function submitDelete() {
        document.getElementById('deleteForm').submit();
    }
</script>
@endif

@if(session('success'))
<div id="successPopup" class="popup-overlay">
    <div class="popup-content">
        <p class="popup-text">🎉 Congrats, your grocery has been updated!</p>
        <button onclick="closePopup()" class="popup-button" style="background-color:#5cb85c;">OK</button>
    </div>
</div>

<script>
    function closePopup() {
        document.getElementById('successPopup').style.display = 'none';
    }
</script>
@endif
@endsection
