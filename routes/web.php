<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\WasteController;
use App\Http\Controllers\GroceryController;
use App\Http\Controllers\RegLoginController;
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

Route::get('/', function () {
    return view('home');
})->name('home');

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



// Testing add product
Route::get('/product', [ProductController::class, 'index'])->name('manage_waste.viewProduct');
Route::get('/product/create', [ProductController::class, 'create'])->name('manage_waste.createProduct');
Route::post('/product', [ProductController::class, 'store'])->name('manage_waste.storeProduct');


//Manage User Registration & Login
// Registration
Route::get('/register', [RegLoginController::class, 'showRegisterForm'])->name('manage_reg_login.register');
Route::post('/register/store', [RegLoginController::class, 'register'])->name('manage_reg_login.register.store');

// Login
Route::get('/login', [RegLoginController::class, 'showLoginForm'])->name('manage_reg_login.login');
Route::post('/login', [RegLoginController::class, 'login'])->name('manage_reg_login.login.submit');
Route::get('/logout', [RegLoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // Profile
    Route::get('/profile', [RegLoginController::class, 'profile'])->name('manage_reg_login.profile');
    Route::get('/profile/edit', [RegLoginController::class, 'editProfile'])->name('manage_reg_login.editProfile');
    Route::put('/profile/update', [RegLoginController::class, 'updateProfile'])->name('manage_reg_login.updateProfile');
    Route::post('/profile/update-photo', [RegLoginController::class, 'updatePhoto'])->name('manage_reg_login.updatePhoto');
    Route::post('/remove-photo', [RegLoginController::class, 'removePhoto'])->name('manage_reg_login.removePhoto');
    Route::post('/check-username', [RegLoginController::class, 'checkUsername'])->name('check.username');

    // Change Password
    Route::get('/password/change', [RegLoginController::class, 'showChangePassword'])->name('manage_reg_login.changePassword');
    Route::post('/password/update', [RegLoginController::class, 'updatePassword'])->name('manage_reg_login.updatePassword');

});
