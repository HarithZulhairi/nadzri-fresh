<?php

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

Route::get('/add-waste', function () {
    return view('manage_waste.addWaste');
})->name('manage_waste.addWaste');

Route::get('/view-waste', function () {
    return view('manage_waste.viewWaste');
})->name('manage_waste.viewWaste');

Route::get('/edit-waste', function () {
    return view('manage_waste.editWaste');
})->name('manage_waste.editWaste');