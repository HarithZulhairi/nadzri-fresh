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
        return view('manage_waste.addWaste', ['products' => $products]);
    }
}
