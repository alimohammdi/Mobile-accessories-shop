<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function getTotalPriceAttribute()
    {
        return $this->items()->with('product')->get()->sum(function ($item) {
            $price      = $item->product->price;
            $discount   = $item->product->discount;
            $finalPrice = $price - ($price * $discount / 100);
            return $finalPrice * $item->quantity;
        });
    }
}
