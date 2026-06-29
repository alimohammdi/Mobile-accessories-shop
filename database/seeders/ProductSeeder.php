<?php
namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

         // محصولات عادی
    Product::factory(30)->create();

    // محصولات تخفیف‌دار
    Product::factory(20)->onSale()->create();

    // محصولات پرفروش
    Product::factory(10)->bestseller()->create();

    // محصولات جدید
    Product::factory(15)->newArrival()->create();

    // محصولات ناموجود
    Product::factory(5)->outOfStock()->create();
    }
}
