<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

Route::middleware('guest')->group(function() {
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    
});

Route::middleware('auth:sanctum')->group(function() {
    Route::delete('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('user-tokens/{id?}', [AuthController::class, 'userTokens'])->name('user.tokens');

    Route::resource('products', ProductController::class)->only('index', 'show');

});