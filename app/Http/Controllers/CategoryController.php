<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')
            ->latest()
            ->get();

        $metaTitle = 'دسته‌بندی‌ها | ' . config('app.name');
        $metaDescription = 'مشاهده تمام دسته‌بندی‌های لوازم جانبی موبایل';

        return view('categories.index', compact('categories', 'metaTitle', 'metaDescription'));
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)
            ->firstOrFail();

        $products = Product::where('category_id', $category->id)
            ->where('is_active', true)
            ->with(['brand', 'colors', 'sizes'])
            ->latest()
            ->paginate(12);

        $metaTitle = $category->meta_title ?? $category->name . ' | ' . config('app.name');
        $metaDescription = $category->meta_description ?? 'مشاهده محصولات دسته‌بندی ' . $category->name;

        return view('categories.show', compact('category', 'products', 'metaTitle', 'metaDescription'));
    }
}
