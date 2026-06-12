<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
      use HasFactory;
    protected $fillable = [
        'product_id',
        'customer_id',
        'comment',
        'rating',
        'is_approved',
        'parent_id',
        'is_admin_reply',
    ];

   protected $casts = [
    'is_approved' => 'boolean',
    'is_admin_reply' => 'boolean',
    'rating' => 'integer',
];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function parent()
    {
    return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function replies()
   {
    return $this->hasMany(Comment::class, 'parent_id');
   }
}
