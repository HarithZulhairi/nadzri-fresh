<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class StockController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $stocks = Stock::all();

        return view('manage_stock.viewStock', [
            'products' => $products,
            'stocks' => $stocks
        ]);
    }
    
    public function create()
    {
        $products = Product::all(); // Get all products for dropdown
        $stockCount = Product::where('product_status', '==', 'Good')
                       ->where('product_inStock', 0)
                       ->count();

        return view('manage_stock.addStock', [
            'products' => $products,
            'stockCount' => $stockCount
        ]);
    }


    public function update(Request $request, Product $product)
    {
        if ($product->product_inStock) {
            return back()->with('error', 'This product is already in stock');
        }

        $validatedData = $request->validate([
            'stock_quantity' => 'required|integer'
        ]);

        $product->update(['product_inStock' => true]);

        $stock = new Stock($validatedData);
        $stock->product_ID = $product->product_ID;
        $stock->stock_quantity = $request->stock_quantity;

        $stock->save();

        return redirect()->route('manage_stock.viewStock')
                        ->with('success', 'Stock added successfully and product is now in stock');
    }

    public function addForm(Product $product)
    {
        return view('manage_stock.addStockForm', ['product' => $product]);
    }

    public function edit(Product $product, Stock $stock)
    {
        return view('manage_stock.editStock', ['product' => $product, 'stock' => $stock]);
    }

    public function updateStock(Request $request, Product $product, Stock $stock)
    {
        // Validate the request
        $validatedData = $request->validate([
            'stock_quantity' => 'required|integer|min:1'
        ]);

        // Update the stock
        $stock->update([
            'stock_quantity' => $validatedData['stock_quantity']
        ]);

        return redirect()->route('manage_stock.viewStock')
                        ->with('success', 'Stock quantity updated successfully');
    }

    public function destroy(Product $product)
    {
        // Delete the associated stock record first
        $product->stock()->delete();
        
        // Option 1: Just remove from stock (keep product)
        $product->update(['product_inStock' => false]);
        
        // Option 2: Completely delete the product (uncomment if you want this)
        // $product->delete();
        
        return redirect()->route('manage_stock.viewStock')
                        ->with('success', 'Product removed from stock successfully');
    }

}
