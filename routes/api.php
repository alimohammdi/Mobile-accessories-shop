<?php

use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('/category', CategoryController::class)->parameters(['category' => 'id']);

Route::apiResource('/brand', BrandController::class)->parameters(['brand' => 'id']);

Route::apiResource('/product', ProductController::class)->parameters(['product' => 'id']);
