<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\WasteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/waste/add', [WasteController::class, 'index'])->name('manage_waste.addWaste');
Route::patch('/waste/mark-as-waste/{product}', [WasteController::class, 'markAsWaste'])->name('manage_waste.markAsWaste');
Route::get('/waste/view', [WasteController::class, 'viewWaste'])->name('manage_waste.viewWaste');
Route::post('/waste/dispose/{product}', [WasteController::class, 'dispose'])->name('manage_waste.disposeWaste');
Route::get('/waste/edit/{product}', [WasteController::class, 'edit'])->name('manage_waste.editWaste');
Route::put('/waste/update/{product}', [WasteController::class, 'update'])->name('manage_waste.updateWaste');
Route::delete('waste/delete/{product}', [WasteController::class, 'destroy'])->name('manage_waste.destroy');
Route::get('/waste-count', function() {
    return [
        'count' => \App\Models\Product::where('product_status', '!=', 'Good')
                    ->where('product_waste', 0)
                    ->count()
    ];
});

// Testing add product
Route::get('/product', [ProductController::class, 'index'])->name('manage_waste.viewProduct');
Route::get('/product/create', [ProductController::class, 'create'])->name('manage_waste.createProduct');
Route::post('/product', [ProductController::class, 'store'])->name('manage_waste.storeProduct');