<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory  , SoftDeletes;

    protected $fillable = [
        'customer_id',
        'total_price',
        'discount',
        'final_price',
        'status',
        'address',
        'postal_code',
        'notes',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}