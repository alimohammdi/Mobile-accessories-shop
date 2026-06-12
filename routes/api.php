<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\TelegramBotController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('/category', CategoryController::class)->parameters(['category' => 'id']);

Route::apiResource('/brand', BrandController::class)->parameters(['brand' => 'id']);

Route::apiResource('/product', ProductController::class)->parameters(['product' => 'id']);
// telegram

Route::post('/telegram/webhook', [TelegramBotController::class, 'handle']);

// Public Routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::apiResource('categories', CategoryController::class)->only(['index', 'show'])->parameters(['category' => 'id']);
Route::apiResource('brands', BrandController::class)->only(['index', 'show'])->parameters(['brand' => 'id']);
Route::apiResource('products', ProductController::class)->only(['index', 'show'])->parameters(['product' => 'id']);

// Protected Routes (نیاز به Token دارن)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('profile', [AuthController::class, 'profile']);

    Route::apiResource('categories', CategoryController::class)->except(['index', 'show'])->parameters(['category' => 'id']);
    Route::apiResource('brands', BrandController::class)->except(['index', 'show'])->parameters(['brand' => 'id']);
    Route::apiResource('products', ProductController::class)->except(['index', 'show'])->parameters(['product' => 'id']);
});
