<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class GroceryController extends Controller
{
    // View all grocery items
    public function index()
    {
        $products = Product::all();
        return view('manage_grocery.viewGrocery', [
            'products' => $products
        ]);
    }

    // Show form to add a new grocery item
    public function create()
    {
        return view('manage_grocery.addGrocery');
    }

    // Store new grocery item
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_category' => 'required|string|max:255',
            'product_price' => 'required|numeric|min:0',
            'product_discount' => 'nullable|numeric|min:0|max:100',
        ]);

        Product::create($validatedData);

        return redirect()->route('manage_grocery.viewGrocery')
                         ->with('success', 'Product added successfully');
    }

    // Show form to edit existing grocery item
    public function edit(Product $product)
    {
        return view('manage_grocery.editGrocery', [
            'product' => $product
        ]);
    }

    // Update the grocery item
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_category' => 'required|string|max:255',
            'product_price' => 'required|numeric|min:0',
            'product_discount' => 'nullable|numeric|min:0|max:100',
        ]);

        $product->update($validatedData);

        return redirect()->route('manage_grocery.viewGrocery')
                         ->with('success', 'Product updated successfully');
    }

    // Delete a grocery item
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('manage_grocery.viewGrocery')
                         ->with('success', 'Product deleted successfully');
    }

    // Search grocery items
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $products = Product::where('product_name', 'like', "%$keyword%")
                           ->orWhere('product_category', 'like', "%$keyword%")
                           ->get();

        return view('manage_grocery.searchGrocery', [
            'products' => $products,
            'keyword' => $keyword
        ]);
    }
}
