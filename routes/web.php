<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Front\productController as FrontProductController;
use Illuminate\Support\Facades\Route;



Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');


Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');


// Front project

Route::prefix('/')->group(function(){
      Route::get('',[IndexController::class,'index'])->name('home');
      Route::get('login',[IndexController::class,'loginPage'])->name('login');


    //   errors page
      Route::get('404',[IndexController::class,'notFound'])->name('404');
      Route::get('500',[IndexController::class,'errorServer'])->name('500');


    // single page
     Route::get('about',[IndexController::class,'about'])->name('about');

      // product page
      Route::get('products',[FrontProductController::class,'index'])->name('all-products');
      Route::get('/products/{slug}', [FrontProductController::class, 'show'])->name('product-show');
});
