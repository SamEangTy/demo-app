<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/home'));

Route::get('/home', function () {
    return view('welcome');
});

Route::resource('customers', CustomerController::class);
Route::resource('products', ProductController::class);

Route::get('customers/{customer}/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('customers/{customer}/cart', [CartController::class, 'store'])->name('cart.store');
Route::patch('customers/{customer}/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
Route::delete('customers/{customer}/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
