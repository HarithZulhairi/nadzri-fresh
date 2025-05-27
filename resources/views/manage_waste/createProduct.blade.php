<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Product</title>
    <style>
        body {
          font-family: 'Inter', sans-serif;
          max-width: 800px;
          margin: 0 auto;
          padding: 2rem;
          line-height: 1.6;
        }
        
        h1 {
          color: #2e8b57;
          margin-bottom: 2rem;
        }

        .form-group {
          margin-bottom: 1.5rem;
        }

        label {
          display: block;
          margin-bottom: 0.5rem;
          font-weight: 500;
        }

        input, select, textarea {
          width: 100%;
          padding: 0.75rem;
          border: 1px solid #ddd;
          border-radius: 4px;
          font-size: 1rem;
        }

        textarea {
          min-height: 100px;
        }

        button {
          background-color: #2e8b57;
          color: white;
          border: none;
          padding: 0.75rem 1.5rem;
          border-radius: 4px;
          font-size: 1rem;
          cursor: pointer;
          transition: background-color 0.3s;
        }

        button:hover {
          background-color: #247348;
        }

    </style>
  </head>
  <body>
      <h1>Create a Product</h1>
      @if($errors->any())
      <div class="alert alert-danger">
              <ul>
                  @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      <form method="POST" action="{{ route('manage_waste.storeProduct') }}" enctype="multipart/form-data">
        @csrf
        @method('post')
        <div class="form-group">
          <label for="product_name">Product Name</label>
          <input type="text" id="product_name" name="product_name" required>
        </div>

        <div class="form-group">
          <label for="product_description">Description</label>
          <textarea id="product_description" name="product_description" required></textarea>
        </div>

        <div class="form-group">
          <label for="product_category">Category</label>
          <select id="product_category" name="product_category" required>
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

        <div class="form-group">
            <label for="product_price">Price per Unit/Kg</label>
            <input type="number" id="product_price" name="product_price" step="0.01" min="0" required 
                  onblur="formatDecimal(this)" placeholder="0.00">
        </div>

        <div class="form-group">
            <label for="product_discount">Discount (%)</label>
            <input type="number" id="product_discount" name="product_discount" step="0.01" min="0" max="100" 
                  onblur="formatDecimal(this)" placeholder="0.00" value="0">
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
            <input id="product_status" name="product_status" class="form-control" value="Good" readonly>
        </div>

        <div class="form-group">
          <label for="product_picture">Product Image</label>
          <input type="file" id="product_picture" name="product_picture" accept="image/*">
        </div>

        <button type="submit">Create Product</button>
      </form>

      <script>
        function formatDecimal(input) {
            // Get the current value
            let value = input.value.trim();
            
            // If empty, set to 0.00
            if (value === '') {
                input.value = '0.00';
                return;
            }
            
            // If it doesn't contain a decimal point, add .00
            if (value.indexOf('.') === -1) {
                input.value = value + '.00';
                return;
            }
            
            // Split into whole and decimal parts
            const parts = value.split('.');
            
            // If decimal part has only 1 digit, add a 0
            if (parts[1].length === 1) {
                input.value = parts[0] + '.' + parts[1] + '0';
                return;
            }
            
            // If no decimal places, ensure we have two
            if (parts.length === 1) {
                input.value = value + '.00';
            }
        }
      </script>
  </body>
</html>