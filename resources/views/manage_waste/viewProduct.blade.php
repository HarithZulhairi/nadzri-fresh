<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Products</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem;
      line-height: 1.6;
    }
    h1 {
      color: #2e8b57;
      margin-bottom: 2rem;
    }
    .products-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .products-table th, .products-table td {
      padding: 1rem;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    .products-table th {
      background-color: #2e8b57;
      color: white;
      font-weight: 600;
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
      gap: 0.5rem;
    }
    .btn {
      padding: 0.5rem 1rem;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 0.9rem;
      transition: all 0.3s;
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
      transform: translateY(-1px);
    }
    .status-badge {
      padding: 0.25rem 0.5rem;
      border-radius: 12px;
      font-size: 0.8rem;
      font-weight: 500;
    }
    .status-active {
      background-color: #d4edda;
      color: #155724;
    }
    .status-expired {
      background-color: #fff3cd;
      color: #856404;
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
  </style>
</head>
<body>
    <h1>Product Inventory</h1>
    
    <a href="{{ route('manage_waste.createProduct') }}" class="add-product-btn">
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
              <div class="no-image">No Image</div>
            @endif
          </td>
          <td>{{ $product->product_name }}</td>
          <td>{{ $product->product_category }}</td>
          <td>{{ number_format($product->product_price, 2) }}</td>
          <td>{{ $product->product_discount }}%</td>
          <td>{{ \Carbon\Carbon::parse($product->product_expiryDate)->format('d M Y') }}</td>
          <td>{{ $product->product_supplier }}</td>
          <td class="status-active">{{ $product->product_status }}</td>
          <td class="action-buttons">
            <a href="" class="btn btn-edit">
              <i class="fas fa-edit"></i> Edit
            </a>
            <form action="" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure?')">
                <i class="fas fa-trash"></i> Delete
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @else
    <div class="no-products">
      <p>No products found. Add your first product!</p>
    </div>
    @endif
</body>
</html>