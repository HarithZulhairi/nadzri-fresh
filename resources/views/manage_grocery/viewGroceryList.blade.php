@extends('layouts.headerFooter')

@section('content')
<style>
  .inventory-container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 2rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
  }

  h1 {
    color: #2e8b57;
    margin-bottom: 2rem;
  }

  .add-product-btn {
    display: inline-block;
    margin-bottom: 1rem;
    padding: 0.75rem 1.5rem;
    background-color: #2e8b57;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    transition: all 0.3s;
  }

  .add-product-btn:hover {
    background-color: #247348;
  }

  .products-table {
    width: 100%;
    border-collapse: collapse;
  }

  .products-table th, .products-table td {
    padding: 1rem;
    border-bottom: 1px solid #ddd;
    text-align: left;
  }

  .products-table th {
    background-color: #2e8b57;
    color: white;
  }

  .products-table tr:hover {
    background-color: #f5f5f5;
  }

  .product-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 4px;
  }

  .action-buttons {
    display: flex;
    gap: 8px;
  }

  .btn {
    padding: 0.4rem 0.8rem;
    font-size: 0.9rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: 0.2s;
    text-decoration: none;
    display: inline-block;
  }

  .btn-view {
    background-color: #3498db;
    color: white;
  }

  .btn-edit {
    background-color: #2e8b57;
    color: white;
  }

  .btn-delete {
    background-color: #e74c3c;
    color: white;
  }

  .btn:hover {
    opacity: 0.9;
  }

  .status-badge {
    padding: 0.3rem 0.7rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 500;
  }

  .status-Good {
    background-color: #d4edda;
    color: #155724;
  }

  .status-Expired {
    background-color: #fff3cd;
    color: #856404;
  }

  .status-Almost\ Expired {
    background-color: #ffe6cc;
    color: #b34700;
  }
</style>

<div class="inventory-container">
  <h1>Grocery Inventory</h1>

  <a href="{{ route('manage_grocery.addGrocery') }}" class="add-product-btn">
    <i class="fas fa-plus"></i> Add New Product
  </a>

  @if($products->count() > 0)
  <table class="products-table">
    <thead>
      <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Category</th>
        <th>Price (RM)</th>
        <th>Discount</th>
        <th>Expiry Date</th>
        <th>Supplier</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $product)
      <tr>
        <td>
          @if($product->product_picture_path)
            <img src="{{ asset('storage/' . $product->product_picture_path) }}" alt="{{ $product->product_name }}" class="product-image">
          @else
            <div>No Image</div>
          @endif
        </td>
        <td>{{ $product->product_name }}</td>
        <td>{{ $product->product_category }}</td>
        <td>{{ number_format($product->product_price, 2) }}</td>
        <td>{{ $product->product_discount }}%</td>
        <td>{{ \Carbon\Carbon::parse($product->product_expiryDate)->format('d M Y') }}</td>
        <td>{{ $product->product_supplier }}</td>
        <td>
          <span class="status-badge status-{{ str_replace(' ', '\ ', $product->product_status) }}">
            {{ $product->product_status }}
          </span>
        </td>
        <td class="action-buttons">
          <a href="{{ route('manage_grocery.viewGrocery', ['product' => $product->product_ID]) }}" class="btn btn-view">
            <i class="fas fa-eye"></i> View
          </a>
          <a href="{{ route('manage_grocery.editGrocery', ['product' => $product->product_ID]) }}" class="btn btn-edit">
            <i class="fas fa-edit"></i> Edit
          </a>
          <form action="{{ route('manage_grocery.deleteGrocery', ['product' => $product->product_ID]) }}" method="POST" ...>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-delete">
              <i class="fas fa-trash"></i> Delete
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @else
  <p>No grocery items found. Start by adding one!</p>
  @endif
</div>
@endsection
