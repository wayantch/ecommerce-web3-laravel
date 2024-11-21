<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\DiscountController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/user', [ProfileController::class, 'getUser']);


// Products
Route::resource('/products', ProductController::class);
// Discounts
Route::resource('/discounts', DiscountController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::get('/user', [ProfileController::class, 'getUser']);
});
