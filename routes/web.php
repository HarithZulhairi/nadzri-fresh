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

Route::get('/add-waste', [WasteController::class, 'index'])->name('manage_waste.addWaste');
Route::get('/view-waste', function () {
    return view('manage_waste.viewWaste');
})->name('manage_waste.viewWaste');

Route::get('/edit-waste', function () {
    return view('manage_waste.editWaste');
})->name('manage_waste.editWaste');

// Testing add product
Route::get('/product', [ProductController::class, 'index'])->name('manage_waste.viewProduct');
Route::get('/product/create', [ProductController::class, 'create'])->name('manage_waste.createProduct');
Route::post('/product', [ProductController::class, 'store'])->name('manage_waste.storeProduct');