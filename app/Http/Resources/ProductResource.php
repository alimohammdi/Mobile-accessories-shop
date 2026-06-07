<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'uni_code'    => $this->uni_code,
            'price'       => $this->price,
            'discount'    => $this->discount . '%',
            'final_price' => $this->price - ($this->price * $this->discount / 100),
            'stock'       => $this->stock,
            'description' => $this->description,
            'images'      => [
                $this->image_1 ? asset('storage/' . $this->image_1) : null,
                $this->image_2 ? asset('storage/' . $this->image_2) : null,
                $this->image_3 ? asset('storage/' . $this->image_3) : null,
            ],
            'category'    => new CategoryResource($this->whenLoaded('category')),
            'brand'       => new BrandResource($this->whenLoaded('brand')),
            'is_active'   => $this->is_active,
        ];
    }
}
