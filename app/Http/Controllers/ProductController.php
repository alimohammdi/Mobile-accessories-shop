<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['brand', 'category'])
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('products.index', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->with(['brand', 'category', 'colors', 'sizes'])
            ->firstOrFail();

        $metaTitle = $product->meta_title ?? $product->name;
        $metaDescription = $product->meta_description ?? $product->description;
        $ogImage = $product->image_1 ? asset('storage/' . $product->image_1) : '';

        return view('products.show', compact('product', 'metaTitle', 'metaDescription', 'ogImage'));
    }
}
