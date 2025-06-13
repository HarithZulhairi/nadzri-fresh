@extends('layouts.headerFooter')

@section('content')
<style>
    .grocery-container {
        max-width: 1000px;
        margin: 40px auto;
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .grocery-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 25px;
    }
    .grocery-form {
        display: flex;
        gap: 30px;
        flex-wrap: wrap;
    }
    .grocery-image {
        flex: 1;
        text-align: center;
    }
    .grocery-image img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 10px;
    }
    .grocery-fields {
        flex: 2;
    }
    .form-group {
        margin-bottom: 15px;
    }
    label {
        font-weight: 600;
        margin-bottom: 5px;
        display: block;
    }
    input, select, textarea {
        width: 100%;
        padding: 8px 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
    }
    .form-row {
        display: flex;
        gap: 20px;
    }
    .form-row .form-group {
        flex: 1;
    }
    .save-button {
        background-color: olive;
        color: white;
        padding: 10px 25px;
        border: none;
        border-radius: 6px;
        float: right;
        margin-top: 15px;
        cursor: pointer;
    }
</style>

<div class="grocery-container">
    <div class="grocery-title">Add Grocery</div>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('manage_grocery.storeGrocery') }}" enctype="multipart/form-data">

        @csrf

        <div class="grocery-form">
            <!-- Grocery Image Upload -->
            <div class="grocery-image">
                <img src="{{ asset('uploads/grocerypic.png') }}" alt="Grocery Image">
                <input type="file" name="product_picture" style="margin-top: 10px;" accept="image/*">
            </div>

            <!-- Grocery Input Fields -->
            <div class="grocery-fields">
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" name="product_name" id="product_name" required>
                </div>

                <div class="form-group">
                    <label for="product_description">Description</label>
                    <textarea name="product_description" id="product_description" required></textarea>
                </div>

                <div class="form-row">
                    <!-- inside .grocery-fields -->
                    <div class="form-row">
                        <div class="form-group" style="flex: 1;">
                            <label for="product_category">Category</label>
                            <select name="product_category" id="product_category" required>
                                <option value="">Select a category</option>
                                <option value="Vegetables">Vegetables</option>
                                <option value="Fruits">Fruits</option>
                                <option value="Dairy">Dairy</option>
                                <option value="Bakery">Bakery</option>
                                <option value="Meat">Meat</option>
                                <option value="Seafood">Seafood</option>
                                <option value="Beverages">Beverages</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <label for="product_price">Price per Unit/Kg</label>
                    <input type="number" id="product_price" name="product_price" step="0.01" min="0" required onblur="formatDecimal(this)" placeholder="0.00">
                </div>

                <div class="form-group">
                    <label for="product_discount">Discount (%)</label>
                    <input type="number" id="product_discount" name="product_discount" step="0.01" min="0" max="100" onblur="formatDecimal(this)" placeholder="0.00" value="0">
                </div>

                <div class="form-group">
                    <label for="product_expiryDate">Expiry Date</label>
                    <input type="date" id="product_expiryDate" name="product_expiryDate" required>
                </div>

                <div class="form-group">
                    <label for="product_supplier">Supplier</label>
                    <input type="text" id="product_supplier" name="product_supplier" required>
                </div>

                <div class="form-group">
                    <label for="product_status">Product Status</label>
                    <input id="product_status" name="product_status" value="Good" readonly>
                </div>

                <button type="submit" class="save-button">Save</button>
            </div>
        </div>
    </form>
</div>

<script>
    function formatDecimal(input) {
        let value = input.value.trim();
        if (value === '') {
            input.value = '0.00';
            return;
        }
        if (value.indexOf('.') === -1) {
            input.value = value + '.00';
            return;
        }
        const parts = value.split('.');
        if (parts[1].length === 1) {
            input.value = parts[0] + '.' + parts[1] + '0';
        }
    }
</script>
@endsection
