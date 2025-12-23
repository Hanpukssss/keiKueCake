<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\QuickOrderController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('refresh', [AuthController::class, 'refresh']);

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
    });
});

Route::get('public/products', [ProductController::class, 'publicIndex']);
Route::get('public/products/{product:uuid}', [ProductController::class, 'show'])->name('public.products.show');
Route::post('public/quick-orders', [QuickOrderController::class, 'store']);
Route::middleware('auth:api')->post('transactions/public', [TransactionController::class, 'store']);

Route::middleware(['auth:api', 'admin'])->group(function () {
    Route::get('quick-orders', [QuickOrderController::class, 'index']);
    Route::apiResource('products', ProductController::class)->parameters([
        'products' => 'product:uuid',
    ]);

    Route::apiResource('transactions', TransactionController::class)->parameters([
        'transactions' => 'transaction:uuid',
    ]);
});
