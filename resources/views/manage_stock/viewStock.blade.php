<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Stocks</title>
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

        .search-form {
            display: flex;
            margin-bottom: 20px;
        }

        .search-form input[type="text"] {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-top-left-radius: 6px;
            border-bottom-left-radius: 6px;
        }

        .search-form button {
            padding: 10px 20px;
            background-color: #6B8E23;
            color: white;
            border: none;
            border-top-right-radius: 6px;
            border-bottom-right-radius: 6px;
            cursor: pointer;
        }

        .stock-card {
            display: flex;
            align-items: center;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 15px;
            transition: box-shadow 0.3s ease;
        }

        .stock-card:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .stock-card img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 15px;
        }

        .stock-name {
            flex-grow: 1;
            font-weight: bold;
            font-size: 16px;
        }

        .stock-qty {
            font-size: 14px;
            color: #555;
        }

        .no-results {
            text-align: center;
            color: #888;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <form class="search-form" method="GET" action="{{ route('manage_stock.viewStock') }}">
        <input type="text" name="search" placeholder="Product Name" value="{{ $search ?? '' }}">
        <button type="submit">Search</button>
    </form>

    @forelse ($stocks as $stock)
        <div class="stock-card">
            <img src="{{ asset($stock->product->product_picture_path ?? 'images/default.png') }}" alt="Product Image">
            <a href="{{ route('manage_stock.stockDetail', $stock->id)}}" class="stock-name" style="text-decoration: none; color:black;">
                {{ $stock->product->product_name}}
            <div class="stock-qty">{{ $stock->quantity }}/{{ $stock->max_quantity }}</div>
        </div>
    @empty
        <div class="no-results">No stock items found.</div>
    @endforelse
</div>

</body>
</html>
