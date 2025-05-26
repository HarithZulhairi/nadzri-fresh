<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Stocks</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            padding: 40px;
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            width: 500px;
            margin: 0 auto;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #333;
        }

        select, input[type="text"], input[type="number"], input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        button {
            background-color: #556B2F;
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #6b8e23;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Add Stocks</h2>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

<form action="{{ route('stocks.store') }}" method="POST">
    @csrf

    <label>Product Name</label>
    <select name="product_id" required>
        <option value="">-- Select Product --</option>
        @foreach($products as $product)
            <option value="{{ $product->product_ID }}">{{ $product->product_name }}</option>
        @endforeach
    </select>

    <label>Expiration Date</label>
    <input type="date" name="expiration_date" required>

    <label>Category</label>
    <select name="category" required>
        <option value="Vegetable">Vegetable</option>
        <option value="Fruit">Fruit</option>
        <option value="Dairy">Dairy</option>
    </select>

    <label>Price</label>
    <input type="number" name="price" step="0.01" required>

    <label>Quantity</label>
    <input type="number" name="quantity" required>

    <label>Supplier</label>
    <input type="text" name="supplier">

    <button type="submit">Save</button>
</form>
    </div>
</body>
</html>
