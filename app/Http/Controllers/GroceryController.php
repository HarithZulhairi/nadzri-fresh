<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class GroceryController extends Controller
{
    // View all grocery items
    public function index()
    {
        $products = Product::all();
        return view('manage_grocery.viewGrocery', compact('products'));
    }

    // Show form to add a new grocery item
    public function create()
    {
        return view('manage_grocery.addGrocery');
    }

    // Store new grocery item
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'nullable|string',
            'product_category' => 'required|string|max:255',
            'product_price' => 'required|numeric|min:0',
            'product_discount' => 'nullable|numeric|min:0|max:100',
            'product_expiryDate' => 'nullable|date',
            'product_supplier' => 'nullable|string|max:255',
            'product_picture_path' => 'nullable|image|max:2048'
        ]);

        // If no discount is provided, set it to 0
        if (!isset($validated['product_discount'])) {
            $validated['product_discount'] = 0;
        }

        if (!isset($validated['product_expiryDate'])) {
            $validated['product_expiryDate'] = null;
        }

        // Auto-generate product code like G001, G002, ...
        $lastProduct = Product::orderBy('product_ID', 'desc')->first();
        $lastId = $lastProduct ? $lastProduct->product_ID : 0;
        $validated['product_code'] = 'G' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);

        // Handle image upload
        if ($request->hasFile('product_picture_path')) {
            $validated['product_picture_path'] = $request->file('product_picture_path')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('manage_grocery.viewGrocery')
                         ->with('success', 'Product added successfully');
    }

    // Show form to edit existing grocery item
    public function edit(Product $product)
    {
        return view('manage_grocery.editGrocery', compact('product'));
    }

    // Update the grocery item
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'nullable|string',
            'product_category' => 'required|string|max:255',
            'product_price' => 'required|numeric|min:0',
            'product_discount' => 'nullable|numeric|min:0|max:100',
            'product_supplier' => 'nullable|string|max:255',
            'product_picture_path' => 'nullable|image|max:2048'
        ]);

        // Handle optional image replacement
        if ($request->hasFile('product_picture_path')) {
            // Delete old one
            if ($product->product_picture_path) {
                Storage::disk('public')->delete($product->product_picture_path);
            }

            // Store new one
            $validated['product_picture_path'] = $request->file('product_picture_path')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('manage_grocery.viewGrocery')
                         ->with('success', 'Product updated successfully');
    }

    // Delete a grocery item
    public function destroy(Product $product)
    {
        if ($product->product_picture_path) {
            Storage::disk('public')->delete($product->product_picture_path);
        }

        $product->delete();

        return redirect()->route('manage_grocery.viewGrocery')
                         ->with('success', 'Product deleted successfully');
    }

    // Search grocery items
    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('product_name', 'like', "%$query%")->get();

        return view('manage_grocery.searchGrocery', compact('products'));
    }

    // Show individual grocery item detail (if needed)
    public function show(Product $product)
    {
        return view('manage_grocery.viewGrocery', compact('product'));
    }
}
