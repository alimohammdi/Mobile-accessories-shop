<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory , SoftDeletes;
    protected $guarded = ['id'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }
    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(Size::class);
    }

       public function comments()
    {
         return $this->hasMany(Comment::class);
    }

        public function approvedComments()
    {
        return $this->hasMany(Comment::class)->where('is_approved', true);
    }


    // create slug  for SEO
    protected static function boot()
    {
    parent::boot();
    static::creating(function ($product) {
        if (empty($product->slug)) {
            $product->slug = Str::slug($product->name);
        }
    });
    static::updating(function ($product) {
        if (empty($product->slug)) {
            $product->slug = Str::slug($product->name);
        }
    });
    }
}