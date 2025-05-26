@extends('layouts.headerFooter')

@section('content')
<style>
    .search-container {
        max-width: 900px;
        margin: 40px auto;
        background-color: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .search-bar {
        display: flex;
        gap: 10px;
        margin-bottom: 30px;
    }
    .search-bar input[type="text"] {
        flex: 1;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }
    .search-bar button {
        background-color: olive;
        color: white;
        padding: 8px 18px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }
    .grocery-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    .grocery-card {
        display: flex;
        align-items: center;
        border: 1px solid #ccc;
        padding: 10px 20px;
        border-radius: 8px;
        justify-content: space-between;
    }
    .grocery-info {
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .grocery-info img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 6px;
    }
    .grocery-info span {
        font-size: 18px;
        font-weight: 500;
    }
    .go-btn {
        background-color: olive;
        color: white;
        padding: 6px 20px;
        border-radius: 20px;
        border: none;
        cursor: pointer;
    }
</style>

<div class="search-container">
    <h2 style="margin-bottom: 20px;">Search Grocery</h2>

    <!-- Search Form -->
    <form class="search-bar" action="{{ route('manage_grocery.searchGrocery') }}" method="GET">
        <input type="text" name="query" placeholder="Product Name" value="{{ request('query') }}">
        <button type="submit">Search</button>
    </form>

    <!-- Grocery List -->
    <div class="grocery-list">
        @forelse ($products as $product)
        <div class="grocery-card">
            <div class="grocery-info">
                <img src="{{ asset('storage/' . $product->product_picture_path) }}" alt="{{ $product->product_name }}">
                <span>{{ $product->product_name }}</span>
            </div>
            <a href="{{ route('manage_grocery.showGrocery', ['product' => $product->id]) }}">
                <button class="go-btn">Go</button>
            </a>
        </div>
        @empty
        <p>No products found.</p>
        @endforelse
    </div>
</div>
@endsection
