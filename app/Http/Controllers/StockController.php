<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class StockController extends Controller
{
    public function create()
    {
        $products = Product::all(); // Get all products for dropdown
        return view('manage_stock.addStock', compact('products'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:product,product_ID',
            'expiration_date' => 'required|date',
            'category' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'supplier' => 'nullable|string',
        ]);

        // You can create a new Stock model here if it exists, or just handle the data
        $stocks = Stock::create([
            'product_id' => $validatedData['product_id'],
            'quantity' => $validatedData['quantity'],
            'quantity' => $validatedData['quantity'],
            'expiration_date' => $validatedData['expiration_date'],
            'category' => $validatedData['category'],
            'price' => $validatedData['price'],
            'supplier' => $validatedData['supplier'],
        ]);

        // Example without creating a Stock model yet:
        return back()->with('success', 'Stock saved!');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $stocks = \App\Models\Stock::with('product')
            ->when($search, function($query, $search) {
                return $query->whereHas('product', function($q) use ($search) {
                    $q->where('product_name', 'like', "%$search%");
                });
            })
            ->get();

        return view('manage_stock.viewStock', compact('stocks', 'search'));
    }

    public function show($id)
    {
        $stock = Stock::with('product')->findOrFail($id);
        return view('manage_stock.stockDetail', compact('stock'));
    }

    public function update(Request $request, $id)
    {
        $stock = Stock::findOrFail($id);

        // Update only stock table
        $stock->quantity = $request->quantity;
        $stock->save();

        // Optional: update price or expiry in product table
        $stock->product->product_price = $request->price;
        $stock->product->product_expiryDate = $request->expiration_date;
        $stock->product->save();

        return redirect()->route('manage_stock.viewStock')->with('success', 'Stock updated successfully.');
    }

    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();

        return redirect()->route('manage_stock.viewStock')->with('success', 'Stock has been deleted');
    }


}
