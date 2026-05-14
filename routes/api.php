<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\NewsletterController;

Route::middleware('throttle:10,1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('throttle:5,1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('throttle:30,1')->group(function () {
    Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe']);
    Route::post('/contact', [\App\Http\Controllers\API\ContactController::class, 'store']);
});

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

    // Support (Tickets) - Rate limited to prevent spam
    Route::get('/support/tickets', [\App\Http\Controllers\API\SupportController::class, 'getTickets']);
    Route::get('/support/tickets/{id}', [\App\Http\Controllers\API\SupportController::class, 'getTicketDetails']);
    
    Route::middleware('throttle:20,1')->group(function () {
        Route::post('/support/tickets', [\App\Http\Controllers\API\SupportController::class, 'storeTicket']);
        Route::post('/support/tickets/{id}/reply', [\App\Http\Controllers\API\SupportController::class, 'replyToTicket']);
    });

    // Support (Live Chat - Legacy/Simple)
    Route::get('/support/messages', [\App\Http\Controllers\API\SupportController::class, 'index']);
    Route::post('/support/messages', [\App\Http\Controllers\API\SupportController::class, 'store']);

    // Admin Routes
    Route::middleware('admin')->group(function () {
        Route::get('/admin/stats', [\App\Http\Controllers\API\AdminController::class, 'getStats']);
        
        // Products
        Route::post('/products', [ProductController::class, 'store']);
        Route::put('/products/{id}', [ProductController::class, 'update']);
        Route::patch('/products/{id}/trending', [ProductController::class, 'toggleTrending']);
        Route::delete('/products/{id}', [ProductController::class, 'destroy']);
        
        // Categories
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::put('/categories/{id}', [CategoryController::class, 'update']);
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
        
        // Orders
        Route::get('/orders', [OrderController::class, 'index']);
        Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus']);
        
        // Users
        Route::get('/users', [\App\Http\Controllers\API\UserController::class, 'index']); 
        Route::get('/admin/users', [\App\Http\Controllers\API\UserController::class, 'index']);

        // Support (Admin)
        Route::get('/admin/support/stats', [\App\Http\Controllers\API\SupportController::class, 'adminGetStats']);
        Route::get('/admin/support/tickets', [\App\Http\Controllers\API\SupportController::class, 'adminGetTickets']);
        Route::put('/admin/support/tickets/{id}', [\App\Http\Controllers\API\SupportController::class, 'adminUpdateTicket']);
        Route::get('/admin/support/conversations', [\App\Http\Controllers\API\SupportController::class, 'adminConversations']);
        Route::get('/admin/support/messages/{userId}', [\App\Http\Controllers\API\SupportController::class, 'adminMessages']);
        Route::post('/admin/support/messages/{userId}', [\App\Http\Controllers\API\SupportController::class, 'adminReply']);
    });
});
