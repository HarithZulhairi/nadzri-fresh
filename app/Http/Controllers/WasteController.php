<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class WasteController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $wasteCount = Product::where('product_status', '!=', 'Good')
                       ->where('product_waste', 0)
                       ->count();

        return view('manage_waste.addWaste', [
            'products' => $products,
            'wasteCount' => $wasteCount
        ]);
    }

    public function viewWaste()
    {
        $products = Product::all();
        $wasteCount = Product::where('product_status', '!=', 'Good')
                       ->where('product_waste', 0)
                       ->count();

        return view('manage_waste.viewWaste', [
            'products' => $products,
            'wasteCount' => $wasteCount
        ]);
    }

    // ... rest of your controller methods remain the same ...
    public function edit(Product $product)
    {
        $wasteCount = Product::where('product_status', '!=', 'Good')
                       ->where('product_waste', 0)
                       ->count();

        return view('manage_waste.editWaste', [
            'product' => $product,
            'wasteCount' => $wasteCount
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'product_status' => 'required|in:Donated,Expired,Damaged'
        ]);

        $product->update($validatedData);

        return redirect()->route('manage_waste.viewWaste')
                        ->with('success', 'Product status updated successfully');
    }

    public function markAsWaste(Product $product)
    {
        $product->update(['product_waste' => true]);
        
        return redirect()->route('manage_waste.viewWaste')
            ->with('success', 'Product marked as waste successfully');
    }

    public function dispose(Product $product)
    {
        $product->update([
            'product_status' => 'Disposed',
            'disposed_at' => now()
        ]);

        return redirect()->route('manage_waste.viewWaste')
            ->with('success', 'Product has been marked as disposed');
    }

    public function destroy(Product $product)
    {
        // Delete the product image if it exists
        if ($product->product_picture_path) {
            Storage::disk('public')->delete($product->product_picture_path);
        }
        
        $product->delete();
        
        return redirect()->route('manage_waste.viewWaste')
                        ->with('success', 'Product permanently deleted');
    }
}
