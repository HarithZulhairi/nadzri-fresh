<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class GroceryController extends Controller
{

    // index() — return all grocery items
    public function index()
    {
        $products = Product::all();
        return view('manage_grocery.viewGroceryList', compact('products'));
    }

    // show() — return single grocery item
    public function show(Product $product)
    {
        return view('manage_grocery.viewGrocery', compact('product'));
    }


    // Show form to add a new grocery item
    public function create()
    {
        return view('manage_grocery.addGrocery');
    }


    // Store new grocery item
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_category' => 'required|string|max:255',
            'product_price' => 'required|numeric|min:0',
            'product_discount' => 'nullable|numeric|min:0|max:100',
            'product_expiryDate' => 'required|date',
            'product_supplier' => 'required|string|max:255',
            'product_status' => 'required|string|max:255',
            'product_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle image upload
        if ($request->hasFile('product_picture')) {
            $file = $request->file('product_picture');
            $fileContents = file_get_contents($file->getRealPath());
            $hashedName = hash('sha256', $fileContents . now()) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('products', $hashedName, 'public');
            $validated['product_picture_path'] = $filePath;
        }

        // Set default discount if empty
        $validated['product_discount'] = $validated['product_discount'] ?? 0.00;

        // Determine product status based on expiry
        $expiryDate = \Carbon\Carbon::parse($validated['product_expiryDate']);
        $today = \Carbon\Carbon::today();
        $threeDaysFromNow = $today->copy()->addDays(3);

        if ($validated['product_status'] === 'Good') {
            if ($expiryDate->isSameDay($today) || $expiryDate->isPast()) {
                $validated['product_status'] = 'Expired';
            } elseif ($expiryDate->isBetween($today, $threeDaysFromNow)) {
                $validated['product_status'] = 'Almost Expired';
            }
        }

        // Auto-generate product code like G001, G002
        $lastProduct = Product::orderBy('product_ID', 'desc')->first();
        $lastId = $lastProduct ? $lastProduct->product_ID : 0;
        $validated['product_code'] = 'G' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);

        // Save to DB
        Product::create([
            'product_name' => $validated['product_name'],
            'product_description' => $validated['product_description'],
            'product_category' => $validated['product_category'],
            'product_price' => $validated['product_price'],
            'product_discount' => $validated['product_discount'],
            'product_expiryDate' => $validated['product_expiryDate'],
            'product_supplier' => $validated['product_supplier'],
            'product_status' => $validated['product_status'],
            'product_code' => $validated['product_code'],
            'product_picture_path' => $validated['product_picture_path'] ?? null,
        ]);

        return redirect()->route('manage_grocery.viewGroceryList')
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
            'product_description' => 'required|string',
            'product_discount' => 'nullable|numeric|min:0|max:100',
            'product_price' => 'required|numeric|min:0',
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

        return redirect()
            ->route('manage_grocery.viewGrocery', $product->product_ID)
            ->with('success', 'Product updated successfully!');
    }

    // Delete a grocery item
    public function destroy(Product $product)
    {
        if ($product->product_picture_path) {
            Storage::disk('public')->delete($product->product_picture_path);
        }

        $product->delete();

        // Redirect to the grocery list after deletion
        return redirect()->route('manage_grocery.viewGroceryList')
                        ->with('success', 'Product deleted successfully');
    }

    // Search grocery items
    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('product_name', 'like', "%$query%")->get();

        return view('manage_grocery.searchGrocery', compact('products'));
    }

}
