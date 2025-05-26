<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stock Details</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f2f4f6;
            padding: 30px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin: 6px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
        }

        .actions {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-edit {
            background-color: #6B8E23;
            color: white;
        }

        .btn-delete {
            background-color: #d9534f;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Stock Details</h2>

    <img src="{{ asset($stock->product->product_picture_path ?? 'images/default.png') }}" alt="Product Image">

    <form method="POST" action="{{ route('manage_stock.update', $stock->id) }}">
        @csrf
        @method('PUT')

        <label>Product Name</label>
        <input type="text" name="product_name" value="{{ $stock->product->product_name }}" readonly>

        <label>Expiration Date</label>
        <input type="date" name="expiration_date" value="{{ $stock->product->product_expiryDate }}">

        <label>Category</label>
        <input type="text" name="category" value="{{ $stock->product->product_category }}" readonly>

        <label>Price</label>
        <input type="text" name="price" value="{{ $stock->product->product_price }}">

        <label>Quantity</label>
        <input type="number" name="quantity" value="{{ $stock->quantity }}">

        <label>Supplier</label>
        <input type="text" name="supplier" value="{{ $stock->product->product_supplier }}">

        <div class="actions">
            <button type="submit" class="btn btn-edit">Save</button>
        </div>
    </form>

    <form method="POST" action="{{ route('manage_stock.destroy', $stock->id) }}" style="margin-top: 10px;" onsubmit="return confirmDelete();">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-delete">Delete</button>
    </form>
</div>
<script>
    function confirmDelete() {
        if (confirm("Are you sure you want to delete this stock?")) {
            document.querySelector('.btn-delete').disabled = true;
            return true;
        }
        return false;
    }
</script>

</body>
</html>
