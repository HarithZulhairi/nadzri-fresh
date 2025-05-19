<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('manage_waste.viewProduct', ['products' => $products]);
    }

    public function create()
    {
        return view('manage_waste.createProduct');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_category' => 'required|string|max:255',
            'product_price' => 'required|decimal:2|min:0',
            'product_discount' => 'nullable|decimal:2|min:0|max:100',
            'product_expiryDate' => 'required|date',
            'product_supplier' => 'required|string|max:255',
            'product_status' => 'required|string|max:255',
            'product_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20048'
        ]);
        // Handle file upload
        if ($request->hasFile('product_picture')) {
            $file = $request->file('product_picture');
            $fileContents = file_get_contents($file->getRealPath());
            $hashedName = hash('sha256', $fileContents . now()) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('products', $hashedName, 'public');
            $validatedData['product_picture_path'] = $filePath;
        }

        // Set default discount if not provided
        $validatedData['product_discount'] = $validatedData['product_discount'] ?? 0.00;
        
        
        $expiryDate = Carbon::parse($validatedData['product_expiryDate']);
        $today = Carbon::today();
        $threeDaysFromNow = $today->copy()->addDays(3);

        if ($validatedData['product_status'] === 'Good') {
            if ($expiryDate->isSameDay($today) || $expiryDate->isPast()) {
                $validatedData['product_status'] = 'Expired';
            } elseif ($expiryDate->isBetween($today, $threeDaysFromNow)) {
                $validatedData['product_status'] = 'Almost Expired';
            }
        }

        // Create the product
        $product = Product::create([
            'product_name' => $validatedData['product_name'],
            'product_description' => $validatedData['product_description'],
            'product_category' => $validatedData['product_category'],
            'product_price' => $validatedData['product_price'],
            'product_discount' => $validatedData['product_discount'],
            'product_expiryDate' => $validatedData['product_expiryDate'],
            'product_supplier' => $validatedData['product_supplier'],
            'product_status' => $validatedData['product_status'],
            'product_picture_path' => $validatedData['product_picture_path'] ?? null
        ]);


        // Redirect with success message
        return redirect()->route('manage_waste.viewProduct');
                        //  ->with('success', 'Product created successfully!');
    }
}