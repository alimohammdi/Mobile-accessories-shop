<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return BrandResource::collection($brands);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $brand = Brand::create($validated);

        return response()->json([
            'status'  => true,
            'message' => 'برند با موفقیت ایجاد شد',
            'data'    => new BrandResource($brand),
        ], 201);
    }

    public function show(Brand $id)
    {
        return response()->json([
            'status' => true,
            'data'   => new BrandResource($id),
        ]);
    }

    public function update(Request $request, Brand $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $id->update($validated);

        return response()->json([
            'status'  => true,
            'message' => 'برند با موفقیت ویرایش شد',
            'data'    => new BrandResource($id),
        ]);
    }

    public function destroy(Brand $id)
    {
        $id->delete();

        return response()->json([
            'status'  => true,
            'message' => 'برند با موفقیت حذف شد',
        ]);
    }
}
