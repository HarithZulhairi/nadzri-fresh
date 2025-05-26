<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\WasteController;
use App\Http\Controllers\GroceryController;
use App\Http\Controllers\StockController;
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

//MUHAMAD SYARIFUDIN BIN MOHD AZON

Route::get('/grocery/add', [GroceryController::class, 'create'])->name('manage_grocery.addGrocery');
Route::post('/grocery/store', [GroceryController::class, 'store'])->name('manage_grocery.storeGrocery');

Route::get('/grocery/edit/{product}', [GroceryController::class, 'edit'])->name('manage_grocery.editGrocery');
Route::put('/grocery/update/{product}', [GroceryController::class, 'update'])->name('manage_grocery.updateGrocery');

Route::delete('/grocery/delete/{product}', [GroceryController::class, 'destroy'])->name('manage_grocery.deleteGrocery');

Route::get('/grocery/view', [GroceryController::class, 'index'])->name('manage_grocery.viewGrocery');
Route::get('/grocery/search', [GroceryController::class, 'search'])->name('manage_grocery.searchGrocery');

//MUHAMMAD IQMAL HAFIY BIN TAJUDIN 
Route::get('/stock/add', [StockController::class, 'create'])->name('manage_stock.addStock');
Route::post('/stocks', [StockController::class, 'store'])->name('stocks.store');
Route::get('/stock/view', [StockController::class, 'index'])->name('manage_stock.viewStock');
Route::get('/manage_stock/{id}', [StockController::class, 'show'])->name('manage_stock.stockDetail');
Route::put('/manage_stock/{id}', [StockController::class, 'update'])->name('manage_stock.update');
Route::delete('/manage_stock/{id}', [StockController::class, 'destroy'])->name('manage_stock.destroy');


// Testing add product
Route::get('/product', [ProductController::class, 'index'])->name('manage_waste.viewProduct');
Route::get('/product/create', [ProductController::class, 'create'])->name('manage_waste.createProduct');
Route::post('/product', [ProductController::class, 'store'])->name('manage_waste.storeProduct');


//Manage User Registration & Login
Route::get('/login-page', function () {
    return view('manage_reg_login.login');
})->name('manage_reg_login.login');

Route::get('/register', function () {
    return view('manage_reg_login.register');
})->name('manage_reg_login.register');

Route::get('/home-page', function () {
    return view('home');
})->name('home');

Route::get('/user-profile', function () {
    return view('manage_reg_login.profile');
})->name('manage_reg_login.profile');

Route::get('/edit-profile', function () {
    return view('manage_reg_login.editProfile');
})->name('manage_reg_login.editProfile');

Route::get('/change-password', function () {
    return view('manage_reg_login.changePassword');
})->name('manage_reg_login.changePassword');