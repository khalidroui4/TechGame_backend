<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\NewsletterController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe']);
Route::post('/contact', [\App\Http\Controllers\API\ContactController::class, 'store']);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Profile
    Route::put('/user', [\App\Http\Controllers\API\UserController::class, 'update']);
    Route::put('/user/password', [\App\Http\Controllers\API\UserController::class, 'updatePassword']);
    Route::post('/user/avatar', [\App\Http\Controllers\API\UserController::class, 'uploadAvatar']);

    // Favorites
    Route::get('/favorites', [\App\Http\Controllers\API\FavoriteController::class, 'index']);
    Route::get('/favorites/ids', [\App\Http\Controllers\API\FavoriteController::class, 'ids']);
    Route::post('/favorites/{productId}/toggle', [\App\Http\Controllers\API\FavoriteController::class, 'toggle']);

    // Addresses
    Route::get('/addresses', [\App\Http\Controllers\API\AddressController::class, 'index']);
    Route::post('/addresses', [\App\Http\Controllers\API\AddressController::class, 'store']);
    Route::put('/addresses/{id}', [\App\Http\Controllers\API\AddressController::class, 'update']);
    Route::delete('/addresses/{id}', [\App\Http\Controllers\API\AddressController::class, 'destroy']);

    // Orders (Client)
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders/my', [OrderController::class, 'myOrders']);

    // Admin Routes
    Route::middleware('admin')->group(function () {
        Route::get('/admin/stats', [\App\Http\Controllers\API\AdminController::class, 'getStats']);
        
        Route::post('/products', [ProductController::class, 'store']);
        Route::put('/products/{id}', [ProductController::class, 'update']);
        Route::delete('/products/{id}', [ProductController::class, 'destroy']);
        
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::put('/categories/{id}', [CategoryController::class, 'update']);
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
        
        Route::get('/orders', [OrderController::class, 'index']);
        Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus']);
        
        Route::get('/users', [\App\Http\Controllers\API\UserController::class, 'index']); // This should be /admin/users
        Route::get('/admin/users', [\App\Http\Controllers\API\UserController::class, 'index']);
    });
});
