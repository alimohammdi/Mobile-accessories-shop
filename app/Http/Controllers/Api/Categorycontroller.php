<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories);

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Category::create($validated);

        return response()->json([
            'status'  => true,
            'message' => 'دسته‌بندی با موفقیت ایجاد شد',
            'data'    => new CategoryResource($category),
        ], 201);
    }

    public function show(Category $id)
    {
        return response()->json([
            'status' => true,
            'data'   => new CategoryResource($id),
        ]);
    }

    public function update(Request $request, Category $id)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $id->update($validated);

        return response()->json([
            'status'  => true,
            'message' => 'دسته‌بندی با موفقیت ویرایش شد',
            'data'    => new CategoryResource($id),
        ]);
    }

    public function destroy(Category $id)
    {
        $id->delete();

        return response()->json([
            'status'  => true,
            'message' => 'دسته‌بندی با موفقیت حذف شد',
        ]);
    }
}
