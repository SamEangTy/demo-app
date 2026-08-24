<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/home'));

Route::get('/home', function () {
    return view('welcome');
});

Route::resource('customers', CustomerController::class);
Route::resource('products', ProductController::class);
