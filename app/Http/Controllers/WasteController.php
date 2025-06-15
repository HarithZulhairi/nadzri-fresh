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

    public function viewWaste(Request $request)
    {
        $query = Product::where('product_waste', 1);
        
        // Search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('product_name', 'like', "%{$search}%")
                ->orWhere('product_description', 'like', "%{$search}%")
                ->orWhere('product_category', 'like', "%{$search}%");
            });
        }
        
        // Filter by status
        if ($request->has('status') && $request->input('status') != 'all') {
            $query->where('product_status', $request->input('status'));
        }
        
        // Filter by date range
        if ($request->has('date_from')) {
            $query->whereDate('product_expiryDate', '>=', $request->input('date_from'));
        }
        if ($request->has('date_to')) {
            $query->whereDate('product_expiryDate', '<=', $request->input('date_to'));
        }
        
        $products = $query->get();
        
        $wasteCount = Product::where('product_status', '!=', 'Good')
                    ->where('product_waste', 0)
                    ->count();

        return view('manage_waste.viewWaste', [
            'products' => $products,
            'wasteCount' => $wasteCount,
            'searchTerm' => $request->input('search', ''),
            'selectedStatus' => $request->input('status', 'all'),
            'dateFrom' => $request->input('date_from', ''),
            'dateTo' => $request->input('date_to', '')
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
