<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'brand'])->get();
        return ProductResource::collection($products);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'uni_code'    => 'required|string|unique:products',
            'price'       => 'required|numeric',
            'discount'    => 'nullable|numeric|min:0|max:100',
            'stock'       => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'brand_id'    => 'required|exists:brands,id',
            'is_active'   => 'nullable|boolean',
        ]);

        if ($request->hasFile('image_1')) {
            $validated['image_1'] = $request->file('image_1')->store('products', 'public');
        }
        if ($request->hasFile('image_2')) {
            $validated['image_2'] = $request->file('image_2')->store('products', 'public');
        }
        if ($request->hasFile('image_3')) {
            $validated['image_3'] = $request->file('image_3')->store('products', 'public');
        }

        $product = Product::create($validated);

        return response()->json([
            'status'  => true,
            'message' => 'محصول با موفقیت ایجاد شد',
            'data'    => new ProductResource($product->load(['category', 'brand'])),
        ], 201);
    }

    public function show(Product $id)
    {
        return response()->json([
            'status' => true,
            'data'   => new ProductResource($id->load(['category', 'brand'])),
        ]);
    }

    public function update(Request $request, Product $id)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'uni_code'    => 'required|string|unique:products,uni_code,' . $id->id,
            'price'       => 'required|numeric',
            'discount'    => 'nullable|numeric|min:0|max:100',
            'stock'       => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'brand_id'    => 'required|exists:brands,id',
            'is_active'   => 'nullable|boolean',
        ]);

        $id->update($validated);

        return response()->json([
            'status'  => true,
            'message' => 'محصول با موفقیت ویرایش شد',
            'data'    => new ProductResource($id->load(['category', 'brand'])),
        ]);
    }

    public function destroy(Product $id)
    {
        $id->delete();

        return response()->json([
            'status'  => true,
            'message' => 'محصول با موفقیت حذف شد',
        ]);
    }
}
