<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Front\IndexController;
use Illuminate\Support\Facades\Route;



Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');


Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');


// Front project

Route::prefix('/')->group(function(){
      Route::get('home',[IndexController::class,'index'])->name('home');
      Route::get('login',[IndexController::class,'loginPage']);
      Route::get('404',[IndexController::class,'notFound']);
      Route::get('500',[IndexController::class,'errorServer']);
});
