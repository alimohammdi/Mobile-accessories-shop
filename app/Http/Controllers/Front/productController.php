<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class productController extends Controller
{
     // app/Http/Controllers/ProductController.php

public function index(Request $request)
{
    $products = Product::query()
        ->with(['category', 'brand'])
        ->when($request->cat, fn($q) => $q->whereHas('category',
            fn($q) => $q->where('slug', $request->cat)))
        ->when($request->brand, fn($q) => $q->whereHas('brand',
            fn($q) => $q->whereIn('slug', (array)$request->brand)))
        ->when($request->min_price, fn($q) => $q->where('price', '>=', $request->min_price))
        ->when($request->max_price, fn($q) => $q->where('price', '<=', $request->max_price))
        ->when($request->rating, fn($q) => $q->where('rating', '>=', $request->rating))
        ->when($request->quick, fn($q) => match($request->quick) {
            'new'        => $q->orderByDesc('created_at'),
            'sale'       => $q->whereNotNull('old_price'),
            'bestseller' => $q->orderByDesc('sales_count'),
            'fast'       => $q->where('fast_delivery', true),
            default      => $q,
        })
        ->when($request->sort, fn($q) => match($request->sort) {
            'price-asc'  => $q->orderBy('price'),
            'price-desc' => $q->orderByDesc('price'),
            'newest'     => $q->orderByDesc('created_at'),
            'popular'    => $q->orderByDesc('sales_count'),
            'rating'     => $q->orderByDesc('rating'),
            default      => $q->orderByDesc('created_at'),
        })
        ->paginate(12)
        ->withQueryString();

    $categories = Category::withCount('products')->get();
    $brands = Brand::withCount('products')->get();
    $totalCount = Product::count();

    return view('front.product.products', compact(
        'products', 'categories', 'brands', 'totalCount'
    ));
}
public function show(Product $product)
{
    return view('front.product.singleProduct', compact('product'));
}
}
