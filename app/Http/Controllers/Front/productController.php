<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class productController extends Controller
{
     public function index (){
        return view('front.product.products');
     }
}
